@extends('admin.layout.app')
@section('title') View Zone @endsection
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
                    View Zone
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
            <h4 class="mb-4">Zone Details</h4>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>Zone Name</th>
                            <td>{{$zone->name}}</td>
                        </tr>
                        <tr>
                            <th>Corporation</th>
                            <td>{{$zone->corporation?->name}}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <span class="badge bg-{{$zone->status ? 'success' : 'danger'}}">{{$zone->status ? 'Active' : 'Inactive'}}</span>
                            </td>
                        </tr>
                        <!-- <tr>
                                                    <th>Created Date</th>
                                                    <td>12-Feb-2026</td>
                                                </tr> -->
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection

@section('script')
@endsection