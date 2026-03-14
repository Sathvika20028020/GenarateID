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
.id-card{
background:#f2f2f2;
border-radius:10px;
box-shadow:0 5px 15px rgba(0,0,0,0.2);
overflow:hidden;
}

.id-header{
background:#0d5ea6;
color:white;
text-align:center;
padding:10px;
font-weight:600;
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
        <!-- Corporation -->
        <div class="col-md-4">
            <a href="#" class="btn" style="background-color: #0d5ea6; color: white;">
                <i class="bi bi-download"></i> Download
            </a>
        </div>
    </div>
   
</div>
<div class="container mt-5 mb-4">
<div class="row g-4">

    <!-- Card 1 -->
    <div class="col-md-4">
        <div class="id-card">
            <div class="id-header">Company Name</div>

            <div class="p-3 text-center">
                <img src="{{asset('/theme/images/small-white-logo.png') }}" class="rounded-circle mb-2" width="90">

                <h6 class="text-primary">John Doe</h6>
                <small>Graphic Designer</small>

                <div class="mt-3 text-start">
                    <div><b>ID :</b> EMP101</div>
                    <div><b>DOB :</b> 07-09-2001</div>
                    <div><b>Blood :</b> A+</div>
                    <div><b>Phone :</b> 9876543210</div>
                    <div><b>Email :</b> john@mail.com</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card 2 -->
    <div class="col-md-4">
        <div class="id-card">
            <div class="id-header">Company Name</div>

            <div class="p-3 text-center">
                <img src="{{asset('/theme/images/small-white-logo.png') }}" class="rounded-circle mb-2" width="90">

                <h6 class="text-primary">Sarah</h6>
                <small>Manager</small>

                <div class="mt-3 text-start">
                    <div><b>ID :</b> EMP102</div>
                    <div><b>DOB :</b> 01-02-2000</div>
                    <div><b>Blood :</b> B+</div>
                    <div><b>Phone :</b> 9876543211</div>
                    <div><b>Email :</b> sarah@mail.com</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card 3 -->
    <div class="col-md-4">
        <div class="id-card">
            <div class="id-header">Company Name</div>

            <div class="p-3 text-center">
                <img src="{{asset('/theme/images/small-white-logo.png') }}" class="rounded-circle mb-2" width="90">

                <h6 class="text-primary">David</h6>
                <small>Supervisor</small>

                <div class="mt-3 text-start">
                    <div><b>ID :</b> EMP103</div>
                    <div><b>DOB :</b> 11-03-1999</div>
                    <div><b>Blood :</b> O+</div>
                    <div><b>Phone :</b> 9876543212</div>
                    <div><b>Email :</b> david@mail.com</div>
                </div>
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