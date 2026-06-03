<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ward;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $entries = User::where('role', '!=', User::ROLE_ADMIN)->latest()->get();
        return view('admin.user.index', compact('entries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      $wards = Ward::get();
      $departments = Department::where('status', 1)->get();
        return view('admin.user.create', compact('wards','departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->validatedData($request);
        $data['password'] = Hash::make($data['password']);
        $data['role'] = User::ROLE_DEPARTMENT_USER;
        $data['status'] = $request->boolean('status', true);
        User::create($data);
        \Session::flash('success', 'User added successfully!');
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $assignedDepartments = Department::whereIn('id', $user->departmentIds())->get();
        $assignedWards = Ward::with('zone.corporation')
            ->whereIn('id', $user->wardIds())
            ->get();

        return view('admin.user.show', compact('user', 'assignedDepartments', 'assignedWards'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
      $wards = Ward::get();
      $departments = Department::where('status', 1)->get();
        return view('admin.user.edit', compact('user','wards','departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $data = $this->validatedData($request, $user);
        $data['role'] = User::ROLE_DEPARTMENT_USER;
        $data['status'] = $request->boolean('status', true);
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }
        $user->update($data);
        \Session::flash('success', 'User updated successfully!');
        return redirect()->route('user.index');
    }

    public function toggleStatus(Request $request, User $user)
    {
        abort_if($user->isAdmin(), 403);

        $validated = $request->validate([
            'status' => ['required', 'boolean'],
        ]);

        $user->update([
            'status' => (bool) $validated['status'],
        ]);

        return response()->json([
            'success' => true,
            'status' => $user->status,
            'message' => $user->status ? 'User activated successfully.' : 'User deactivated successfully.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }

    private function validatedData(Request $request, ?User $user = null): array
    {
        $userId = $user?->id;

        if (is_array($request->ward_ids)) {
            $request->merge(['ward_ids' => implode(',', $request->ward_ids)]);
        }

        if (is_array($request->department_ids)) {
            $request->merge(['department_ids' => implode(',', $request->department_ids)]);
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $userId],
            'phone' => ['required', 'digits:10', 'unique:users,phone,' . $userId],
            'password' => [$user ? 'nullable' : 'required', 'string', 'min:6'],
            'ward_ids' => ['nullable', 'string'],
            'department_ids' => ['required', 'string'],
            'status' => ['nullable', 'boolean'],
        ]);

        $this->validateCsvIds($validated['ward_ids'] ?? '', Ward::class, 'ward_ids');
        $this->validateCsvIds($validated['department_ids'] ?? '', Department::class, 'department_ids');

        return $validated;
    }

    private function validateCsvIds(string $value, string $modelClass, string $field): void
    {
        if ($value === '') {
            return;
        }

        $ids = array_values(array_filter(array_map('intval', explode(',', $value))));
        $count = $modelClass::whereIn('id', $ids)->count();

        if ($count !== count($ids)) {
            throw ValidationException::withMessages([
                $field => 'Invalid selection provided.',
            ]);
        }
    }
}
