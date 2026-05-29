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
      $entries = Corporation::latest()->get();
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
        Corporation::create($this->validatedData($request, true));
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
        $corporation->update($this->validatedData($request, false));
        \Session::flash('success', 'Corporation updated successfully!');
        return redirect()->route('corporation.index');
    }

    public function toggleStatus(Request $request, Corporation $corporation)
    {
        $validated = $request->validate([
            'status' => ['required', 'boolean'],
        ]);

        $corporation->update(['status' => (bool) $validated['status']]);

        return response()->json([
            'success' => true,
            'status' => $corporation->status,
            'message' => $corporation->status ? 'Corporation activated successfully.' : 'Corporation deactivated successfully.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Corporation $corporation)
    {
        if ($corporation->zones()->exists() || $corporation->constituencies()->exists() || $corporation->wards()->exists()) {
            return redirect()->route('corporation.index')
                ->with('error', 'Corporation cannot be deleted because it has zones, constituencies, or wards.');
        }

        $corporation->delete();
        \Session::flash('success', 'Corporation deleted successfully!');
        return redirect()->route('corporation.index');
    }

    private function validatedData(Request $request, bool $defaultStatus): array
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'name_kn' => ['nullable', 'string', 'max:255'],
            'status' => ['nullable', 'boolean'],
        ]);

        $validated['status'] = $request->has('status') ? $request->boolean('status') : $defaultStatus;

        return $validated;
    }
}
