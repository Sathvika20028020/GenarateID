<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use App\Models\Department;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $entries = Designation::get();
        return view('admin.designation.index', compact('entries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      $departments = Department::where('status', 1)->get();
        return view('admin.designation.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      $data = $request->only('name', 'department_id');
        Designation::create($data);
        \Session::flash('success', 'Designation added successfully!');
        return redirect()->route('designation.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Designation $designation)
    {
        return view('admin.designation.show', compact('designation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Designation $designation)
    {
      $departments = Department::where('status', 1)->get();
        return view('admin.designation.edit', compact('designation','departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Designation $designation)
    {
      $data = $request->only('department_id', 'name');
      $data['status'] = $request->status ?? 0;
        $designation->update($data);
        \Session::flash('success', 'Designation updated successfully!');
        return redirect()->route('designation.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Designation $designation)
    {
        //
    }
}
