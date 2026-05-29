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
      $entries = Zone::with('corporation')->latest()->get();
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
        Zone::create($this->validatedData($request, true));
        \Session::flash('success', 'Zone added successfully!');
        return redirect()->route('zone.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Zone $zone)
    {
        $zone->load('corporation');
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
        $zone->update($this->validatedData($request, false));
        \Session::flash('success', 'Zone updated successfully!');
        return redirect()->route('zone.index');
    }

    public function toggleStatus(Request $request, Zone $zone)
    {
        $validated = $request->validate([
            'status' => ['required', 'boolean'],
        ]);

        $zone->update(['status' => (bool) $validated['status']]);

        return response()->json([
            'success' => true,
            'status' => $zone->status,
            'message' => $zone->status ? 'Zone activated successfully.' : 'Zone deactivated successfully.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Zone $zone)
    {
        if ($zone->constituencies()->exists() || $zone->wards()->exists()) {
            return redirect()->route('zone.index')
                ->with('error', 'Zone cannot be deleted because it has constituencies or wards.');
        }

        $zone->delete();
        \Session::flash('success', 'Zone deleted successfully!');
        return redirect()->route('zone.index');
    }

    private function validatedData(Request $request, bool $defaultStatus): array
    {
        $validated = $request->validate([
            'corporation_id' => ['required', 'exists:corporations,id'],
            'name' => ['required', 'string', 'max:255'],
            'name_kn' => ['nullable', 'string', 'max:255'],
            'status' => ['nullable', 'boolean'],
        ]);

        $validated['status'] = $request->has('status') ? $request->boolean('status') : $defaultStatus;

        return $validated;
    }
}
