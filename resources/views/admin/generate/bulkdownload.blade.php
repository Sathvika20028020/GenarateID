@extends('admin.layout.app')

@section('title') Bulk Download @endsection

@section('style')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
@include('admin.generate.partials.id-card-styles')
<style>
    .filter-select {
        height: 42px;
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
