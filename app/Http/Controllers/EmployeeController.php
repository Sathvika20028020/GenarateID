<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use App\Models\Zone;
use App\Models\Ward;
use App\Models\Designation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $entries = Employee::with('department')->get();
        return view('admin.generate.index', compact('entries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      $departments = Department::where('status', 1)->get();
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
          else if($request->list == 'Designation')
            $list = Designation::where('department_id', $request->id)->get();
          return response()->json(['success' => true, 'list' => $list]);
        }
        $data = $request->except('_token', 'image');
        $data['corporation_id'] = 5;
         if($request->image)
        $data['image'] = $this->saveFile($request->image, 'uploads/employees');
        Employee::create($data);
        \Session::flash('success', 'Data added successfully!');
        return redirect()->route('generate-id.index');
    }

    private function saveFile($file, $store_path){
      try{
        $extension = File::extension($file->getClientOriginalName());
        $filename = rand(10,99).date('YmdHis').rand(10,99).'.'.$extension;
        $file->move(public_path($store_path), $filename);
        return $store_path.'/'.$filename;
      }catch(\Exception $e){
        return $store_path.'/'.$filename;
      }
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $generateId)
    {
        return view('admin.generate.show', compact('generateId'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $generateId)
    {
      $departments = Department::where('status', 1)->get();
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
        $data = $request->except('_token', 'image', '_method');
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
