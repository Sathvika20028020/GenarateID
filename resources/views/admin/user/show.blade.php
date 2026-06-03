@extends('admin.layout.app')
@section('title') View User @endsection
@section('style')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<style>
.dataTables_wrapper table.dataTable thead th,
.dataTables_wrapper table.dataTable thead td {
    border-bottom: 2px solid #efefef;
    border-right: 1px solid #efefef;
}

.table-bordered td,
.table-bordered th {
    border-color: #00000021 !important;
}

.table-sm th,
.table-sm td {
    padding: 9px 19px !important;
}
</style>
@endsection
@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3>
                    View User
                </h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#">
                            <i data-feather="home"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item">view</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid starts-->
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th width="30%">User Name</th>
                        <td>{{ $user->name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $user->email ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td>{{ $user->phone ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Role</th>
                        <td>{{ $user->isAdmin() ? 'Admin' : 'Department User' }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <span class="badge bg-{{ $user->status ? 'success' : 'danger' }}">
                                {{ $user->status ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Departments Assigned</th>
                        <td>
                            @forelse($assignedDepartments as $department)
                                <span class="badge bg-primary me-1 mb-1">{{ $department->name }}</span>
                            @empty
                                -
                            @endforelse
                        </td>
                    </tr>
                    <tr>
                        <th>Wards Assigned</th>
                        <td>
                            @forelse($assignedWards as $ward)
                                <div class="mb-1">
                                    {{ $ward->name ?? '-' }}
                                    @if($ward->number)
                                        - Ward {{ $ward->number }}
                                    @endif
                                    @if($ward->zone?->name)
                                        | Zone: {{ $ward->zone->name }}
                                    @endif
                                    @if($ward->zone?->corporation?->name)
                                        | Corporation: {{ $ward->zone->corporation->name }}
                                    @endif
                                </div>
                            @empty
                                -
                            @endforelse
                        </td>
                    </tr>
                    <tr>
                        <th>Created At</th>
                        <td>{{ $user->created_at ? $user->created_at->format('d/m/Y h:i A') : '-' }}</td>
                    </tr>
                    <tr>
                        <th>Updated At</th>
                        <td>{{ $user->updated_at ? $user->updated_at->format('d/m/Y h:i A') : '-' }}</td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection

@section('script')
@endsection
