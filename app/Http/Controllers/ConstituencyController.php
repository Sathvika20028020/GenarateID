<?php

namespace App\Http\Controllers;

use App\Models\Constituency;
use App\Models\Zone;
use App\Models\Corporation;
use Illuminate\Http\Request;

class ConstituencyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $entries = Constituency::with('corporation','zone')->latest()->get();
        return view('admin.constituency.index', compact('entries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      $corporations = Corporation::get();
      $zones = Zone::get();
        return view('admin.constituency.create', compact('corporations','zones'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Constituency::create($this->validatedData($request, true));
        \Session::flash('success', 'Constituency added successfully!');
        return redirect()->route('constituency.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Constituency $constituency)
    {
        $constituency->load('corporation','zone');
        return view('admin.constituency.show', compact('constituency'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Constituency $constituency)
    {
      $corporations = Corporation::get();
      $zones = Zone::where('corporation_id', $constituency->corporation_id)->get();
        return view('admin.constituency.edit', compact('constituency', 'corporations', 'zones'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Constituency $constituency)
    {
        $constituency->update($this->validatedData($request, false));
        \Session::flash('success', 'Constituency updated successfully!');
        return redirect()->route('constituency.index');
    }

    public function toggleStatus(Request $request, Constituency $constituency)
    {
        $validated = $request->validate([
            'status' => ['required', 'boolean'],
        ]);

        $constituency->update(['status' => (bool) $validated['status']]);

        return response()->json([
            'success' => true,
            'status' => $constituency->status,
            'message' => $constituency->status ? 'Constituency activated successfully.' : 'Constituency deactivated successfully.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Constituency $constituency)
    {
        if ($constituency->wards()->exists()) {
            return redirect()->route('constituency.index')
                ->with('error', 'Constituency cannot be deleted because it has wards.');
        }

        $constituency->delete();
        \Session::flash('success', 'Constituency deleted successfully!');
        return redirect()->route('constituency.index');
    }

    private function validatedData(Request $request, bool $defaultStatus): array
    {
        $validated = $request->validate([
            'corporation_id' => ['required', 'exists:corporations,id'],
            'zone_id' => ['required', 'exists:zones,id'],
            'name' => ['required', 'string', 'max:255'],
            'name_kn' => ['nullable', 'string', 'max:255'],
            'status' => ['nullable', 'boolean'],
        ]);

        $validated['status'] = $request->has('status') ? $request->boolean('status') : $defaultStatus;

        return $validated;
    }
}
