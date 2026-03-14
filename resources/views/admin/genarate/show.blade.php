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
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <tbody>
                        <!-- Photo Row -->
                        <tr>
                            <th style="width:30%">Photo</th>
                            <td>
                                <img src="{{asset('/theme/images/logo-icon.png') }}" alt="Employee Photo"
                                    class="img-thumbnail" width="120">
                            </td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td>John Kumar</td>
                        </tr>
                        <tr>
                            <th>Employee ID</th>
                            <td>EMP001</td>
                        </tr>
                        <tr>
                            <th>Designation</th>
                            <td>Manager</td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>9876543210</td>
                        </tr>
                        <tr>
                            <th>Department</th>
                            <td>HR</td>
                        </tr>
                        <tr>
                            <th>Corporation</th>
                            <td>Corporation 1</td>
                        </tr>
                        <tr>
                            <th>Zone</th>
                            <td>Zone 1</td>
                        </tr>
                        <tr>
                            <th>Ward</th>
                            <td>Ward 1</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
(() => {
    'use strict';

    const form = document.getElementById('employeeForm');

    form.addEventListener('submit', function(event) {

        event.preventDefault();

        if (!form.checkValidity()) {
            event.stopPropagation();
            form.classList.add('was-validated');
            return;
        }

        // File size validation (2MB)
        const fileInput = form.querySelector('input[type="file"]');
        if (fileInput.files.length > 0) {
            const fileSize = fileInput.files[0].size;
            if (fileSize > 2097152) {
                Swal.fire({
                    icon: 'error',
                    title: 'File Too Large',
                    text: 'Photo must be less than 2MB'
                });
                return;
            }
        }

        // SweetAlert Success Popup
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: 'Employee ID Created Successfully',
            confirmButtonColor: '#ff6a88'
        }).then(() => {
            form.reset();
            form.classList.remove('was-validated');
        });

    }, false);

})();
</script>
@endsection