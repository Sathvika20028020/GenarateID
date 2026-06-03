<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use App\Models\Zone;
use App\Models\Ward;
use App\Models\Designation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
use ZipArchive;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $entries = $this->scopedEmployeeQuery()
            ->with('department', 'designation', 'ward.zone.corporation')
            ->latest()
            ->get();
        return view('admin.generate.index', compact('entries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      $departments = $this->scopedDepartmentQuery()->where('status', 1)->get();
      $zones = $this->scopedZoneQuery()->get();
        return view('admin.generate.create', compact('departments','zones'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->ajax()){
          if($request->list == 'Ward') {
            $list = $this->scopedWardQuery((int) $request->id)->get();
          }
          else if($request->list == 'Designation') {
            abort_unless($this->canUseDepartment((int) $request->id), 403);
            $list = Designation::where('department_id', $request->id)->get();
          }
          return response()->json(['success' => true, 'list' => $list]);
        }
        $data = $this->validatedData($request);
        $ward = Ward::findOrFail($data['ward_id']);
        $data['corporation_id'] = $ward->corporation_id;
        $data['zone_id'] = $ward->zone_id;
        $data['created_by'] = auth()->id();
        if($request->image)
          $data['image'] = $this->saveFile($request->image, 'uploads/employees');
        Employee::create($data);
        \Session::flash('success', 'Data added successfully!');
        return redirect()->route('generate-id.index');
    }

    public function bulkDownloadPage(Request $request)
    {
      $departments = $this->scopedDepartmentQuery()->where('status', 1)->get();
      $designations = Designation::whereIn('department_id', $departments->pluck('id'))->where('status', 1)->get();
      $employees = $this->filteredEmployeeQuery($request)
        ->with('department', 'designation', 'ward.zone.corporation')
        ->latest()
        ->get();

      return view('admin.generate.bulkdownload', compact('departments', 'designations', 'employees'));
    }

    public function download(Employee $generateId)
    {
      $this->authorizeEmployee($generateId);
      $generateId->load('department', 'designation', 'ward.zone.corporation');

      return $this->renderIdCards(collect([$generateId]), $generateId->emp_id . '-id-card.pdf');
    }

    public function bulkDownload(Request $request)
    {
      $employees = $this->filteredEmployeeQuery($request)
        ->with('department', 'designation', 'ward.zone.corporation')
        ->latest()
        ->get();

      abort_if($employees->isEmpty(), 404, 'No ID cards found for selected filters.');

      return $this->renderIdCardsZip($employees);
    }

    private function saveFile($file, $store_path){
      $extension = File::extension($file->getClientOriginalName());
      $filename = rand(10,99).date('YmdHis').rand(10,99).'.'.$extension;
      $file->move(public_path($store_path), $filename);
      return $store_path.'/'.$filename;
    }

    private function scopedEmployeeQuery()
    {
      $query = Employee::query();

      if (auth()->user()?->isDepartmentUser()) {
        $query->where('created_by', auth()->id());

        $departmentIds = auth()->user()->departmentIds();
        $query->whereIn('department_id', $departmentIds ?: [0]);

        $wardIds = auth()->user()->wardIds();
        if (!empty($wardIds)) {
            $query->whereIn('ward_id', $wardIds);
        }
      }

      return $query;
    }

    private function scopedDepartmentQuery()
    {
      $query = Department::query();

      if (auth()->user()?->isDepartmentUser()) {
        $departmentIds = auth()->user()->departmentIds();
        $query->whereIn('id', $departmentIds ?: [0]);
      }

      return $query;
    }

    private function scopedZoneQuery()
    {
      $query = Zone::where('status', 1);
      $wardIds = auth()->user()?->wardIds() ?? [];

      if (auth()->user()?->isDepartmentUser() && !empty($wardIds)) {
        return $query->whereHas('wards', function ($q) use ($wardIds) {
          $q->whereIn('id', $wardIds)->where('status', 1);
        });
      }

      return $query->where('corporation_id', 5);
    }

    private function scopedWardQuery(?int $zoneId = null)
    {
      $query = Ward::where('status', 1);
      $wardIds = auth()->user()?->wardIds() ?? [];

      if ($zoneId) {
        $query->where('zone_id', $zoneId);
      }

      if (auth()->user()?->isDepartmentUser() && !empty($wardIds)) {
        $query->whereIn('id', $wardIds);
      } else {
        $query->where('corporation_id', 5);
      }

      return $query;
    }

    private function filteredEmployeeQuery(Request $request)
    {
      return $this->scopedEmployeeQuery()
        ->when($request->filled('department_id'), function ($query) use ($request) {
          abort_unless($this->canUseDepartment((int) $request->department_id), 403);
          $query->where('department_id', $request->department_id);
        })
        ->when($request->filled('designation_id'), fn ($query) => $query->where('designation_id', $request->designation_id));
    }

    private function renderIdCards($employees, string $filename)
    {
      if (class_exists(\Barryvdh\DomPDF\Facade\Pdf::class)) {
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.generate.id-cards-pdf', [
          'employees' => $employees,
          'pdfMode' => true,
        ])->setPaper([0, 0, 330, 510]);

        return $pdf->download($filename);
      }

      return view('admin.generate.id-cards-pdf', [
        'employees' => $employees,
        'pdfMode' => false,
        'printMode' => true,
      ]);
    }

    private function renderIdCardsZip($employees)
    {
      abort_unless(class_exists(ZipArchive::class), 500, 'PHP ZipArchive extension is not enabled.');

      $zipDirectory = storage_path('app/temp');
      File::ensureDirectoryExists($zipDirectory);

      $zipPath = $zipDirectory.'/id-cards-'.now()->format('YmdHis').'.zip';
      $zip = new ZipArchive();

      abort_unless($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true, 500, 'Unable to create ID card ZIP.');

      foreach ($employees as $employee) {
        $baseName = $this->idCardFileName($employee);

        if (class_exists(\Barryvdh\DomPDF\Facade\Pdf::class)) {
          $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.generate.id-cards-pdf', [
            'employees' => collect([$employee]),
            'pdfMode' => true,
          ])->setPaper([0, 0, 330, 510]);

          $zip->addFromString($baseName.'.pdf', $pdf->output());
          continue;
        }

        $html = view('admin.generate.id-cards-pdf', [
          'employees' => collect([$employee]),
          'pdfMode' => false,
          'printMode' => false,
        ])->render();

        $zip->addFromString($baseName.'.html', $html);
      }

      $zip->close();

      return response()->download($zipPath, 'id-cards.zip')->deleteFileAfterSend(true);
    }

    private function idCardFileName(Employee $employee): string
    {
      $name = $employee->emp_id ?: $employee->name ?: 'employee-'.$employee->id;
      $name = preg_replace('/[^A-Za-z0-9_-]+/', '-', $name);

      return trim($name, '-') ?: 'employee-'.$employee->id;
    }

    private function canUseDepartment(int $departmentId): bool
    {
      return auth()->user()?->isAdmin() || in_array($departmentId, auth()->user()?->departmentIds() ?? [], true);
    }

    private function authorizeEmployee(Employee $employee): void
    {
      if (auth()->user()?->isDepartmentUser()) {
        if (!$this->canUseDepartment((int) $employee->department_id)) {
            abort(403);
        }
        $wardIds = auth()->user()->wardIds();
        if (!empty($wardIds) && !in_array((int) $employee->ward_id, $wardIds, true)) {
            abort(403);
        }
      }
    }

    private function validatedData(Request $request): array
    {
      $departmentIds = $this->scopedDepartmentQuery()->pluck('id')->all();
      $zoneIds = $this->scopedZoneQuery()->pluck('id')->all();
      $wardIds = $this->scopedWardQuery($request->integer('zone_id'))->pluck('id')->all();
      $user = auth()->user();

      return $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'emp_id' => ['required', 'alpha_num', 'max:255'],
        'department_id' => ['required', Rule::in($departmentIds)],
        'designation_id' => [
          'required',
          Rule::exists('designations', 'id')->where('department_id', $request->department_id),
        ],
        'phone' => ['required', 'digits:10'],
        'address' => ['required', 'string', 'max:1000'],
        'blood_group' => ['required', 'string', 'max:5'],
        'valid_upto' => ['required', 'date'],
        'image' => ['nullable', 'image', 'max:2048'],
        'zone_id' => ['required', Rule::in($zoneIds)],
        'ward_id' => [
          'required',
          Rule::in($wardIds),
          function ($attribute, $value, $fail) use ($user) {
              if ($user && $user->isDepartmentUser()) {
                  $wardIds = $user->wardIds();
                  if (!empty($wardIds) && !in_array((int)$value, $wardIds, true)) {
                      $fail('The selected ward is not assigned to you.');
                  }
              }
          }
        ],
        'status' => ['nullable', 'boolean'],
      ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $generateId)
    {
        $this->authorizeEmployee($generateId);
        $generateId->load('department', 'designation', 'ward.zone.corporation', 'creator');
        return view('admin.generate.show', compact('generateId'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $generateId)
    {
      $this->authorizeEmployee($generateId);
      $departments = $this->scopedDepartmentQuery()->where('status', 1)->get();
      $designations = Designation::where('department_id', $generateId->department_id)->get();
      $zones = $this->scopedZoneQuery()->get();
      $wards = $this->scopedWardQuery($generateId->zone_id)->get();

      return view('admin.generate.edit', compact('generateId','departments','zones','designations','wards'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $generateId)
    {
        $this->authorizeEmployee($generateId);
        $data = $this->validatedData($request);
        $ward = Ward::findOrFail($data['ward_id']);
        $data['corporation_id'] = $ward->corporation_id;
        $data['zone_id'] = $ward->zone_id;
        if($request->image)
          $data['image'] = $this->saveFile($request->image, 'uploads/employees');
        $generateId->update($data);
        \Session::flash('success', 'Data updated successfully!');
        return redirect()->route('generate-id.index');
    }

    public function toggleStatus(Request $request, Employee $generateId)
    {
        $this->authorizeEmployee($generateId);

        $validated = $request->validate([
            'status' => ['required', 'boolean'],
        ]);

        $generateId->update(['status' => (bool) $validated['status']]);

        return response()->json([
            'success' => true,
            'status' => $generateId->status,
            'message' => $generateId->status ? 'Employee activated successfully.' : 'Employee deactivated successfully.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $generateId)
    {
        //
    }
}
