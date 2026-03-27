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
      $entries = Constituency::with('corporation','zone')->get();
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
        $data = $request->except('_token');
        Constituency::create($data);
        return redirect()->route('constituency.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Constituency $constituency)
    {
        //
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
        $data = $request->except('_token', '_method');
        $constituency->update($data);
        return redirect()->route('constituency.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Constituency $constituency)
    {
        //
    }
}
