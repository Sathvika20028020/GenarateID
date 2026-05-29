<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(\Illuminate\Http\Request $request)
    {
        if (auth()->user()?->isDepartmentUser()) {
            return redirect()->route('generate-id.index');
        }

        if ($request->ajax()) {
            if ($request->get('get_type') === 'zones') {
                $corpId = $request->get('corporation_id');
                $zones = \App\Models\Zone::where('status', 1)
                    ->when($corpId, fn($q) => $q->where('corporation_id', $corpId))
                    ->get(['id', 'name', 'name_kn']);
                return response()->json($zones);
            }

            if ($request->get('get_type') === 'wards') {
                $zoneId = $request->get('zone_id');
                $wards = \App\Models\Ward::where('status', 1)
                    ->when($zoneId, fn($q) => $q->where('zone_id', $zoneId))
                    ->get(['id', 'name', 'name_kn', 'number']);
                return response()->json($wards);
            }

            // Statistics Query
            $corpId = $request->get('corporation_id');
            $zoneId = $request->get('zone_id');
            $wardId = $request->get('ward_id');

            $empQuery = \App\Models\Employee::query();
            if ($corpId) {
                $empQuery->where('corporation_id', $corpId);
            }
            if ($zoneId) {
                $empQuery->where('zone_id', $zoneId);
            }
            if ($wardId) {
                $empQuery->where('ward_id', $wardId);
            }

            $totalEmployees = $empQuery->count();

            // Designation-wise counts
            $designationStats = \App\Models\Designation::where('status', 1)
                ->get()
                ->map(function ($designation) use ($corpId, $zoneId, $wardId) {
                    $count = \App\Models\Employee::where('designation_id', $designation->id)
                        ->when($corpId, fn($q) => $q->where('corporation_id', $corpId))
                        ->when($zoneId, fn($q) => $q->where('zone_id', $zoneId))
                        ->when($wardId, fn($q) => $q->where('ward_id', $wardId))
                        ->count();
                    return [
                        'name' => $designation->name,
                        'count' => $count
                    ];
                });

            // Breakdown by Zone/Ward
            $breakdown = [];
            $breakdownType = 'zones';

            if ($zoneId) {
                $breakdownType = 'wards';
                $breakdown = \App\Models\Ward::where('zone_id', $zoneId)
                    ->where('status', 1)
                    ->get()
                    ->map(function ($ward) use ($corpId) {
                        $count = \App\Models\Employee::where('ward_id', $ward->id)
                            ->when($corpId, fn($q) => $q->where('corporation_id', $corpId))
                            ->count();
                        return [
                            'name' => $ward->name . ($ward->number ? ' (Ward ' . $ward->number . ')' : ''),
                            'count' => $count
                        ];
                    })->filter(fn($item) => $item['count'] > 0)->values(); // filter out empty wards to avoid cluttering
            } else {
                $breakdown = \App\Models\Zone::where('status', 1)
                    ->when($corpId, fn($q) => $q->where('corporation_id', $corpId))
                    ->get()
                    ->map(function ($zone) use ($corpId) {
                        $count = \App\Models\Employee::where('zone_id', $zone->id)
                            ->when($corpId, fn($q) => $q->where('corporation_id', $corpId))
                            ->count();
                        return [
                            'name' => $zone->name,
                            'count' => $count
                        ];
                    });
            }

            return response()->json([
                'total_employees' => $totalEmployees,
                'designations' => $designationStats,
                'breakdown_type' => $breakdownType,
                'breakdown' => $breakdown,
            ]);
        }

        $corporations = \App\Models\Corporation::where('status', 1)->get();
        return view('admin.dashboard', compact('corporations'));
    }
}
