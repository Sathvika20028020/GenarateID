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
      $entries = Ward::with('corporation','zone','constituency')->get();
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
            $list = Zone::select('id', 'name')->where('corporation_id', $request->id)->get();
          else if($request->list == 'cons')
            $list = Constituency::select('id', 'name')->where('zone_id', $request->id)->get();
          return response()->json(['success' => true, 'list' => $list]);
        }
        $data = $request->except('_token');
        Ward::create($data);
        return redirect()->route('ward.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ward $ward)
    {
        return view('admin.ward.show', compact('ward'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ward $ward)
    {
      $corporations = Corporation::get();
      $zones = Zone::get();
      $constituencies = Constituency::get();
        return view('admin.ward.edit', compact('ward', 'corporations', 'zones','constituencies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ward $ward)
    {
        $data = $request->except('_token', '_method');
        $ward->update($data);
        return redirect()->route('ward.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ward $ward)
    {
        //
    }
}
