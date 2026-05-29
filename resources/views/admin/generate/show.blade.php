@extends('admin.layout.app')
@section('title') Generate ID @endsection
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
                    Generate ID view
                </h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.html">
                            <i data-feather="home"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item">View</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid starts-->
<div class="container mt-1">
    <div class="card">
        <div class="card-body">
            <div class="text-end mb-3">
                <a href="{{ route('generate-id.download', $generateId) }}" class="btn btn-primary">
                    <i class="bi bi-file-earmark-arrow-down me-1"></i> Download ID Card
                </a>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <tbody>
                        <!-- Photo Row -->
                        <tr>
                            <th style="width:30%">Photo</th>
                            <td>
                                <img src="{{asset($generateId->image) }}" alt="Employee Photo"
                                    class="img-thumbnail" width="120">
                            </td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td>{{$generateId->name}}</td>
                        </tr>
                        <tr>
                            <th>Employee ID</th>
                            <td>{{$generateId->emp_id}}</td>
                        </tr>
                        <tr>
                            <th>Designation</th>
                            <td>{{$generateId->designation?->name}}</td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>{{$generateId->phone}}</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>{{$generateId->address}}</td>
                        </tr>
                        <tr>
                            <th>Blood Group</th>
                            <td>{{$generateId->blood_group}}</td>
                        </tr>
                        <tr>
                            <th>Valid Upto</th>
                            <td>{{ $generateId->valid_upto ? \Illuminate\Support\Carbon::parse($generateId->valid_upto)->format('d/m/Y') : '-' }}</td>
                        </tr>
                        <tr>
                            <th>Department</th>
                            <td>{{$generateId->department?->name}}</td>
                        </tr>
                        <tr>
                            <th>Corporation</th>
                            <td>{{$generateId->ward?->zone?->corporation?->name ?? $generateId->corporation?->name}}</td>
                        </tr>
                        <tr>
                            <th>Zone</th>
                            <td>{{$generateId->ward?->zone?->name ?? $generateId->zone?->name}}</td>
                        </tr>
                        <tr>
                            <th>Ward</th>
                            <td>{{$generateId->ward?->name}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
