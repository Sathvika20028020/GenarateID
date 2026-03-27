<?php

namespace App\Http\Controllers;

use App\Models\Zone;
use App\Models\Corporation;
use Illuminate\Http\Request;

class ZoneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $entries = Zone::with('corporation')->get();
        return view('admin.zone.index', compact('entries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      $corporations = Corporation::get();
        return view('admin.zone.create', compact('corporations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');
        Zone::create($data);
        return redirect()->route('zone.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Zone $zone)
    {
        return view('admin.zone.show', compact('zone'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Zone $zone)
    {
      $corporations = Corporation::get();
        return view('admin.zone.edit', compact('zone', 'corporations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Zone $zone)
    {
        $data = $request->except('_token', '_method');
        $zone->update($data);
        return redirect()->route('zone.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Zone $zone)
    {
        //
    }
}
