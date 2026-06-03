@extends('admin.layout.app')

@section('title') Bulk Download @endsection

@section('style')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
@include('admin.generate.partials.id-card-styles')
<style>
    .filter-select {
        height: 42px;
    }

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

    /* =========================
        ID CARD DESIGN
    ========================== */

   .id-card {
    width: 100%;
    max-width: 420px;
    height: 650px;   /* FIXED HEIGHT */
    background: #f2f2f2;
    border-radius: 12px;
    padding: 10px;
    position: relative;
    border: 2px solid #111;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    overflow: hidden;
    margin: auto;
}

    .top-header {
        text-align: center;
        position: relative;
        padding-bottom: 0px;
        border-bottom: 2px solid #111;
    }

    .top-header h1 {
        font-size: 12px;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .top-header h2 {
        font-size: 11px;
        font-weight: normal;
        color: #333;
    }

    .logo-left,
    .logo-right {
        width: 40px;
        height: 40px;
        border-radius: 56%;
        position: absolute;
        top: 0;
        object-fit: contain;
        background: white;
        border: 2px solid #ccc;
        padding: 3px;
    }

    .logo-left {
        left: 0;
    }

    .logo-right {
        right: 0;
    }

    .photo-box {
        width: 130px;
        height: 148px;
        margin: 30px auto;
        border: 3px solid #222;
        border-radius: 15px;
        overflow: hidden;
        background: white;
    }

    .photo-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .details {
        margin-top: 10px;
        padding: 0 10px;
    }

    .detail-row {
        display: flex;
        margin-bottom: 12px;
        font-size: 17px;
    }

    .label {
        width: 130px;
        font-weight: bold;
        font-size: 14px;
        color: #333;
    }

    .value {
        flex: 1;
        font-size: 14px;
        color: #333;
    }

    .dates {
        margin-top: 35px;
        padding: 0 10px;
    }

    .dates .detail-row {
        font-size: 16px;
    }

    .bottom-section {
        margin-top: 35px;
        border-top: 2px solid #111;
        /* padding-top: 20px; */
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
    }

    .qr-box img {
        width: 50px;
        height: 50px;
    }

    .signature {
        text-align: center;
        font-size: 14px;
        font-weight: 500;
    }

    @media(max-width:768px){

        .id-card{
            margin-bottom:20px;
        }

        .top-header h1{
            font-size:18px;
        }

        .detail-row{
            font-size:14px;
        }

        .label{
            width:120px;
        }
    }
.details {
    margin-top: 5px;
    padding: 0 10px;
    min-height: 220px;
}

.dates {
    margin-top: 5px;
    padding: 0 10px;
}

.bottom-section {
    position: absolute;
    bottom: 20px;
    left: 20px;
    right: 20px;
    border-top: 2px solid #111;
    padding-top: 15px;
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
}
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3>Bulk Download ID Cards</h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a class="home-item" href="{{ route('dashboard') }}">
                            <i data-feather="home"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item">Bulk Download</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid general-widget">
    <form method="get" action="{{ route('bulkdownload') }}" class="row mb-4 align-items-end">
        <div class="col-md-4">
            <label class="form-label">Department</label>
            <select class="form-select filter-select" name="department_id" id="departmentSelect">
                <option value="">All Departments</option>
                @foreach($departments as $department)
                    <option value="{{ $department->id }}" @selected(request('department_id') == $department->id)>
                        {{ $department->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4">
            <label class="form-label">Designation</label>
            <select class="form-select filter-select" name="designation_id" id="designationSelect">
                <option value="">All Designations</option>
                @foreach($designations as $designation)
                    <option value="{{ $designation->id }}" data-department="{{ $designation->department_id }}" @selected(request('designation_id') == $designation->id)>
                        {{ $designation->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4 d-flex gap-2">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-funnel"></i> Filter
            </button>
            <a href="{{ route('generate-id.bulk-download', request()->only('department_id', 'designation_id')) }}" class="btn" style="background-color:#0d5ea6;color:white;">
                <i class="bi bi-download"></i> Download
            </a>
        </div>
    </form>
</div>

<div class="container mt-5">
    @if($employees->isEmpty())
        <div class="alert alert-info">No ID cards found for the selected filters.</div>
    @else
        <div class="row g-4">
            @foreach($employees as $employee)
                <div class="col-lg-4 col-md-6">
                    @include('admin.generate.partials.id-card', ['employee' => $employee])
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection

@section('script')
<script>
document.getElementById('departmentSelect').addEventListener('change', function () {
    const departmentId = this.value;
    const designationSelect = document.getElementById('designationSelect');

    Array.from(designationSelect.options).forEach(function (option) {
        if (!option.value) {
            return;
        }

        option.hidden = departmentId && option.dataset.department !== departmentId;
    });

    const selected = designationSelect.options[designationSelect.selectedIndex];
    if (selected && selected.hidden) {
        designationSelect.value = '';
    }
});

document.getElementById('departmentSelect').dispatchEvent(new Event('change'));
</script>
@endsection
