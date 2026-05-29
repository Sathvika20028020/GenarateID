<?php

namespace App\Http\Controllers;

use App\Models\Ward;
use App\Models\Zone;
use App\Models\Corporation;
use App\Models\Constituency;
use Illuminate\Http\Request;

class WardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $entries = Ward::with('corporation','zone','constituency')->latest()->get();
        return view('admin.ward.index', compact('entries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      $corporations = Corporation::get();
      $zones = Zone::get();
      $constituencies = Constituency::get();
        return view('admin.ward.create', compact('corporations','zones','constituencies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->ajax()){
          if($request->list == 'zones')
            $list = Zone::select('id', 'name', 'name_kn')->where('corporation_id', $request->id)->get();
          else if($request->list == 'cons')
            $list = Constituency::select('id', 'name', 'name_kn')->where('zone_id', $request->id)->get();
          return response()->json(['success' => true, 'list' => $list]);
        }
        Ward::create($this->validatedData($request, true));
        \Session::flash('success', 'Ward added successfully!');
        return redirect()->route('ward.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ward $ward)
    {
        $ward->load('corporation','zone','constituency');
        return view('admin.ward.show', compact('ward'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ward $ward)
    {
      $corporations = Corporation::get();
      $zones = Zone::where('corporation_id', $ward->corporation_id)->get();
      $constituencies = Constituency::where('zone_id', $ward->zone_id)->get();
        return view('admin.ward.edit', compact('ward', 'corporations', 'zones','constituencies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ward $ward)
    {
        $ward->update($this->validatedData($request, false));
        \Session::flash('success', 'Ward updated successfully!');
        return redirect()->route('ward.index');
    }

    public function toggleStatus(Request $request, Ward $ward)
    {
        $validated = $request->validate([
            'status' => ['required', 'boolean'],
        ]);

        $ward->update(['status' => (bool) $validated['status']]);

        return response()->json([
            'success' => true,
            'status' => $ward->status,
            'message' => $ward->status ? 'Ward activated successfully.' : 'Ward deactivated successfully.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ward $ward)
    {
        $ward->delete();
        \Session::flash('success', 'Ward deleted successfully!');
        return redirect()->route('ward.index');
    }

    private function validatedData(Request $request, bool $defaultStatus): array
    {
        $validated = $request->validate([
            'corporation_id' => ['required', 'exists:corporations,id'],
            'zone_id' => ['required', 'exists:zones,id'],
            'constituency_id' => ['required', 'exists:constituencies,id'],
            'name' => ['required', 'string', 'max:255'],
            'name_kn' => ['nullable', 'string', 'max:255'],
            'number' => ['required', 'string', 'max:50'],
            'status' => ['nullable', 'boolean'],
        ]);

        $validated['status'] = $request->has('status') ? $request->boolean('status') : $defaultStatus;

        return $validated;
    }
}
