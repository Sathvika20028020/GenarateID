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
      $zones = Zone::where('status', 1)->where('corporation_id', 5)->get();
        return view('admin.generate.create', compact('departments','zones'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->ajax()){
          if($request->list == 'Ward')
            $list = Ward::where('zone_id', $request->id)->get();
          else if($request->list == 'Designation') {
            abort_unless($this->canUseDepartment((int) $request->id), 403);
            $list = Designation::where('department_id', $request->id)->get();
          }
          return response()->json(['success' => true, 'list' => $list]);
        }
        $data = $this->validatedData($request);
        $data['corporation_id'] = 5;
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
        $departmentIds = auth()->user()->departmentIds();
        $query->whereIn('department_id', $departmentIds ?: [0]);
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
      if (auth()->user()?->isDepartmentUser() && ! $this->canUseDepartment((int) $employee->department_id)) {
        abort(403);
      }
    }

    private function validatedData(Request $request): array
    {
      $departmentIds = $this->scopedDepartmentQuery()->pluck('id')->all();

      return $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'emp_id' => ['required', 'string', 'max:255'],
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
        'zone_id' => ['required', 'exists:zones,id'],
        'ward_id' => ['required', 'exists:wards,id'],
        'status' => ['nullable', 'boolean'],
      ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $generateId)
    {
        $this->authorizeEmployee($generateId);
        $generateId->load('department', 'designation', 'ward.zone.corporation');
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
      $zones = Zone::where('status', 1)->where('corporation_id', 5)->get();
      $wards = Ward::where('zone_id', $generateId->zone_id)->get();
        return view('admin.generate.edit', compact('generateId','departments','zones','designations','wards'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $generateId)
    {
        $this->authorizeEmployee($generateId);
        $data = $this->validatedData($request);
        if($request->image)
          $data['image'] = $this->saveFile($request->image, 'uploads/employees');
        $generateId->update($data);
        \Session::flash('success', 'Data updated successfully!');
        return redirect()->route('generate-id.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $generateId)
    {
        //
    }
}
