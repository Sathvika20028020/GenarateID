@extends('admin.layout.app')
@section('title') Dashboard @endsection
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
            <div class="row d-flex justify-content-end">
                <div class="col-12 col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a class="home-item" href="">
                                <i data-feather="home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item"> Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid general-widget">
        <div class="row mb-4 align-items-end">
        <!-- Corporation -->
        <div class="col-md-4">
            <!-- <label class="form-label fw-semibold fs-5">Corporation</label> -->
            <select class="form-select filter-select" id="corporationSelect">
                <option value="central" selected>West</option>
            </select>
        </div>
        <!-- Zone -->
        <div class="col-md-4">
            <!-- <label class="form-label fw-semibold fs-5">Zone</label> -->
            <select class="form-select filter-select" id="zoneSelect">
                <option value="all">Select Zone</option>
                <option value="west">West Zone</option>
                <option value="east">East Zone</option>
                <option value="south">South Zone</option>
                <option value="north">North Zone</option>
                <option value="mahadevapura">Mahadevapura</option>
            </select>
        </div>
        <!-- Ward -->
        <div class="col-md-4">
            <!-- <label class="form-label fw-semibold fs-5">Ward</label> -->
            <select class="form-select filter-select" id="wardSelect">
                <option value="all">Select Ward</option>
                <option value="1">Ward 1</option>
                <option value="2">Ward 2</option>
                <option value="3">Ward 3</option>
                <option value="4">Ward 4</option>
                <option value="5">Ward 5</option>
            </select>
        </div>
    </div>
        <div class="row">
            <div class="col-sm-3 col-xl-3 col-lg-3">
                <div class="card o-hidden border">
                    <div class="card-body">
                        <div class="media static-widget">
                            <div class="media-body">
                                <h6 class="font-roboto">Total ID Cards</h6>
                                <h3 class="mb-0 counter">199</h3>
                            </div>
                            <i class="fas fa-school fa-2x" style="color:#ffcd21;"></i>
                        </div>
                        <div class="progress-widget">
                            <div class="progress sm-progress-bar progress-animate">
                                <div class="progress-gradient-secondary" role="progressbar" style="width: 75%"
                                    aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                    <span class="animate-circle"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-xl-3 col-lg-3">
                <div class="card o-hidden border">
                    <div class="card-body">
                        <div class="media static-widget">
                            <div class="media-body">
                                <h6 class="font-roboto">Designation1</h6>
                                <h3 class="mb-0 counter">50</h3>
                            </div>
                            <i class="fas fa-school fa-2x" style="color:#9ace3e;"></i>
                        </div>
                        <div class="progress-widget">
                            <div class="progress sm-progress-bar progress-animate">
                                <div class="progress-gradient-success" role="progressbar" style="width: 60%"
                                    aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                    <span class="animate-circle"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-xl-3 col-lg-3">
                <div class="card o-hidden border">
                    <div class="card-body">
                        <div class="media static-widget">
                            <div class="media-body">
                                <h6 class="font-roboto">Designation2</h6>
                                <h3 class="mb-0 counter">30</h3>
                            </div>
                            <i class="fas fa-school fa-2x" style="color:#7366ff;"></i>
                        </div>
                        <div class="progress-widget">
                            <div class="progress sm-progress-bar progress-animate">
                                <div class="progress-gradient-primary" role="progressbar" style="width: 60%"
                                    aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                    <span class="animate-circle"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-xl-3 col-lg-3">
                <div class="card o-hidden border">
                    <div class="card-body">
                        <div class="media static-widget">
                            <div class="media-body">
                                <h6 class="font-roboto">Designation3</h6>
                                <h3 class="mb-0 counter">25</h3>
                            </div>
                            <i class="fas fa-school fa-2x" style="color:#dc3545;"></i>
                        </div>
                        <div class="progress-widget">
                            <div class="progress sm-progress-bar progress-animate">
                                <div class="progress-gradient-danger" role="progressbar" style="width: 60%"
                                    aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                    <span class="animate-circle"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-xl-3 col-lg-3">
                <div class="card o-hidden border">
                    <div class="card-body">
                        <div class="media static-widget">
                            <div class="media-body">
                                <h6 class="font-roboto">West</h6>
                                <h3 class="mb-0 counter">25</h3>
                            </div>
                            <i class="fas fa-school fa-2x" style="color:#ff7f50;"></i>
                        </div>
                        <div class="progress-widget">
                            <div class="progress sm-progress-bar progress-animate">
                                <div class="progress-gradient-warning" role="progressbar" style="width: 60%"
                                    aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                    <span class="animate-circle"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-xl-3 col-lg-3">
                <div class="card o-hidden border">
                    <div class="card-body">
                        <div class="media static-widget">
                            <div class="media-body">
                                <h6 class="font-roboto">South</h6>
                                <h3 class="mb-0 counter">25</h3>
                            </div>
                            <i class="fas fa-school fa-2x" style="color:#28a745;"></i>
                        </div>
                        <div class="progress-widget">
                            <div class="progress sm-progress-bar progress-animate">
                                <div class="progress-gradient-info" role="progressbar" style="width: 60%"
                                    aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                    <span class="animate-circle"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-xl-3 col-lg-3">
                <div class="card o-hidden border">
                    <div class="card-body">
                        <div class="media static-widget">
                            <div class="media-body">
                                <h6 class="font-roboto">North</h6>
                                <h3 class="mb-0 counter">25</h3>
                            </div>
                            <i class="fas fa-school fa-2x" style="color:#007bff;"></i>
                        </div>
                        <div class="progress-widget">
                            <div class="progress sm-progress-bar progress-animate">
                                <div class="progress-gradient-dark" role="progressbar" style="width: 60%"
                                    aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                    <span class="animate-circle"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            
        </div>

        <!-- Container-fluid Ends-->
    </div>
    <!-- footer start-->
@endsection

@section('script')
@endsection