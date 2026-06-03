<?php

namespace App\Http\Controllers;

use App\Models\Corporation;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\Ward;
use App\Models\Zone;
use Illuminate\Database\Eloquent\Builder;
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
        if ($request->ajax()) {
            if ($request->get('get_type') === 'zones') {
                $corpId = $request->get('corporation_id');
                $zones = $this->scopedZoneQuery()
                    ->when($corpId, fn($q) => $q->where('corporation_id', $corpId))
                    ->get(['id', 'name', 'name_kn']);
                return response()->json($zones);
            }

            if ($request->get('get_type') === 'wards') {
                $zoneId = $request->get('zone_id');
                $wards = $this->scopedWardQuery()
                    ->when($zoneId, fn($q) => $q->where('zone_id', $zoneId))
                    ->get(['id', 'name', 'name_kn', 'number']);
                return response()->json($wards);
            }

            // Statistics Query
            $corpId = $request->get('corporation_id');
            $zoneId = $request->get('zone_id');
            $wardId = $request->get('ward_id');

            $empQuery = $this->scopedEmployeeQuery();
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

            $baseEmployeeQuery = $this->scopedEmployeeQuery()
                ->when($corpId, fn($q) => $q->where('corporation_id', $corpId))
                ->when($zoneId, fn($q) => $q->where('zone_id', $zoneId))
                ->when($wardId, fn($q) => $q->where('ward_id', $wardId));

            $departmentIds = auth()->user()?->isDepartmentUser()
                ? auth()->user()->departmentIds()
                : [];

            $designationStats = Designation::where('status', 1)
                ->when(!empty($departmentIds), fn($q) => $q->whereIn('department_id', $departmentIds))
                ->get()
                ->map(function ($designation) use ($baseEmployeeQuery) {
                    $count = (clone $baseEmployeeQuery)
                        ->where('designation_id', $designation->id)
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
                $breakdown = $this->scopedWardQuery()
                    ->where('zone_id', $zoneId)
                    ->get()
                    ->map(function ($ward) use ($corpId, $baseEmployeeQuery) {
                        $count = (clone $baseEmployeeQuery)
                            ->where('ward_id', $ward->id)
                            ->count();
                        return [
                            'name' => $ward->name . ($ward->number ? ' (Ward ' . $ward->number . ')' : ''),
                            'count' => $count
                        ];
                    })->filter(fn($item) => $item['count'] > 0)->values(); // filter out empty wards to avoid cluttering
            } else {
                $breakdown = $this->scopedZoneQuery()
                    ->when($corpId, fn($q) => $q->where('corporation_id', $corpId))
                    ->get()
                    ->map(function ($zone) use ($baseEmployeeQuery) {
                        $count = (clone $baseEmployeeQuery)
                            ->where('zone_id', $zone->id)
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

        $corporations = $this->scopedCorporationQuery()->get();
        return view('admin.dashboard', compact('corporations'));
    }

    private function scopedEmployeeQuery(): Builder
    {
        $query = Employee::query();
        $user = auth()->user();

        if ($user?->isDepartmentUser()) {
            $query->where('created_by', $user->id);
            $query->whereIn('department_id', $user->departmentIds() ?: [0]);

            $wardIds = $user->wardIds();
            if (!empty($wardIds)) {
                $query->whereIn('ward_id', $wardIds);
            }
        }

        return $query;
    }

    private function scopedCorporationQuery(): Builder
    {
        $query = Corporation::where('status', 1);
        $user = auth()->user();

        if ($user?->isDepartmentUser() && !empty($user->wardIds())) {
            $corporationIds = Ward::whereIn('id', $user->wardIds())
                ->where('status', 1)
                ->pluck('corporation_id')
                ->unique()
                ->values();

            $query->whereIn('id', $corporationIds);
        }

        return $query;
    }

    private function scopedZoneQuery(): Builder
    {
        $query = Zone::where('status', 1);
        $user = auth()->user();

        if ($user?->isDepartmentUser() && !empty($user->wardIds())) {
            $query->whereHas('wards', function ($wardQuery) use ($user) {
                $wardQuery->whereIn('id', $user->wardIds())->where('status', 1);
            });
        }

        return $query;
    }

    private function scopedWardQuery(): Builder
    {
        $query = Ward::where('status', 1);
        $user = auth()->user();

        if ($user?->isDepartmentUser() && !empty($user->wardIds())) {
            $query->whereIn('id', $user->wardIds());
        }

        return $query;
    }
}
