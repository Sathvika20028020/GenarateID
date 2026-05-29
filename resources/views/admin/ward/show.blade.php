@extends('admin.layout.app')
@section('title') View Ward @endsection
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
                    View Ward
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
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th style="width: 30%;">Ward Name</th>
                            <td>{{ $ward->name }}</td>
                        </tr>
                        <tr>
                            <th>Ward Name (Kannada)</th>
                            <td>{{ $ward->name_kn ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Ward No</th>
                            <td>{{ $ward->number }}</td>
                        </tr>
                        <tr>
                            <th>Zone</th>
                            <td>{{ $ward->zone?->name ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Constituency</th>
                            <td>{{ $ward->constituency?->name ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Corporation</th>
                            <td>{{ $ward->corporation?->name ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td><span class="badge bg-{{ $ward->status ? 'success' : 'danger' }}">{{ $ward->status ? 'Active' : 'Inactive' }}</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection

@section('script')
@endsection
