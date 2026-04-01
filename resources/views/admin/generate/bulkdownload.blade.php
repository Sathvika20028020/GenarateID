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

        .id-card {
            background: #f2f2f2;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .id-header {
            background: #0d5ea6;
            color: white;
            text-align: center;
            padding: 10px;
            font-weight: 600;
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

            <!-- Zone -->
            <div class="col-md-4">
                <!-- <label class="form-label fw-semibold fs-5">Zone</label> -->
                <select class="form-select filter-select" id="zoneSelect">
                    <option value="all">Select Department</option>
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
                    <option value="all">Select Designation</option>
                    <option value="1">Designation 1</option>
                    <option value="2">Designation 2</option>
                    <option value="3">Designation 3</option>
                    <option value="4">Designation 4</option>
                    <option value="5">Designation 5</option>
                </select>
            </div>
            <!-- Corporation -->
            <div class="col-md-4">
                <a href="#" class="btn" style="background-color: #0d5ea6; color: white;">
                    <i class="bi bi-download"></i> Download
                </a>
            </div>
        </div>

    </div>
    <div class="container mt-5">
        <div class="row text-center">

            <div class="col-md-4 mb-3">
                <img src="{{asset('/theme/images/genarate.jpeg')}}" class="img-fluid rounded">
            </div>

            <div class="col-md-4 mb-3">
                <img src="{{asset('/theme/images/genarate.jpeg')}}" class="img-fluid rounded">
            </div>

            <div class="col-md-4 mb-3">
                <img src="{{asset('/theme/images/genarate.jpeg')}}" class="img-fluid rounded">
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