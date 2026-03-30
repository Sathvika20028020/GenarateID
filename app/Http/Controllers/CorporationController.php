<?php

namespace App\Http\Controllers;

use App\Models\Corporation;
use Illuminate\Http\Request;

class CorporationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $entries = Corporation::get();
        return view('admin.corporation.index', compact('entries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.corporation.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');
        Corporation::create($data);
        \Session::flash('success', 'Corporation added successfully!');
        return redirect()->route('corporation.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Corporation $corporation)
    {
       return view('admin.corporation.show', compact('corporation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Corporation $corporation)
    {
        return view('admin.corporation.edit', compact('corporation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Corporation $corporation)
    {
        $data = $request->except('_token', '_method');
        $corporation->update($data);
        \Session::flash('success', 'Corporation updated successfully!');
        return redirect()->route('corporation.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Corporation $corporation)
    {
        //
    }
}
