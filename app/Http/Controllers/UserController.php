<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $entries = User::where('role', '!=', 1)->get();
        return view('admin.user.index', compact('entries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      $wards = Ward::get();
        return view('admin.user.create', compact('wards'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->except('_token','password','wards');
        $data['ward_ids'] = implode(',',$request->wards);
        $data['password'] = Hash::make($request->password);
        $data['role'] = 2;
        User::create($data);
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
      $wards = Ward::get();
        return view('admin.user.edit', compact('user','wards'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $data = $request->except('_token','_method','password','wards');
        $data['ward_ids'] = implode(',',$request->wards);
        $data['role'] = 2;
        if($request->password)
        $data['password'] = Hash::make($request->password);
        $user->update($data);
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
