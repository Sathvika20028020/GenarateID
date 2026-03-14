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
                        Genarate ID
                    </h3>
                </div>
                <div class="col-12 col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html">
                                <i data-feather="home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">Department list</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 class="mb-0 add"></h4>
                            <div class="d-flex gap-2">
                                <a href="#" class="btn btn-primary">
                                    <i class="bi bi-plus-circle me-1"></i>
                                    Bulk Download
                                </a>
                                <a href="addgenarateid.html" class="btn btn-primary">
                                    <i class="bi bi-plus-circle me-1"></i>
                                    Add
                                </a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped  text-center align-middle" id="data-source-1"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="width:10%">Sl.No</th>
                                        <th style="width:20%">Name</th>
                                        <th style="width:20%">Phone Number</th>
                                        <th style="width:20%">Designation</th>
                                        <th style="width:20%">Download ID</th>
                                        <th style="width:20%">Status</th>
                                        <th style="width:20%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>01</td>
                                        <td>BSWML</td>

                                        <td>8759373536</td>
                                        <td>Manager</td>
                                        <td class="underline-text">Download ID</td>

                                        <td>
                                            <label class="switch">
                                                <input type="checkbox" checked>
                                                <span class="slider"></span>
                                            </label>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-1">
                                                <a href="editgenarateid.html" class="btn btn-sm btn-primary" title="Edit">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                <a href="viewgenarateid.html" class="btn btn-sm btn-info text-white"
                                                    title="View">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>02</td>
                                        <td>BSWML</td>

                                        <td>8759373536</td>
                                        <td>Manager</td>
                                        <td class="underline-text">Download ID</td>

                                        <td>
                                            <label class="switch">
                                                <input type="checkbox" checked>
                                                <span class="slider"></span>
                                            </label>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-1">
                                                <a href="editgenarateid.html" class="btn btn-sm btn-primary" title="Edit">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                <a href="viewgenarateid.html" class="btn btn-sm btn-info text-white"
                                                    title="View">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection