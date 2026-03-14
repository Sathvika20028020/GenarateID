@extends('admin.layout.app')
@section('title') Add Designation @endsection
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

        .switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 26px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 26px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 20px;
            width: 20px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked+.slider {
            background-color: #2196F3;
        }

        input:checked+.slider:before {
            transform: translateX(24px);
        }

        .underline-text {
            text-decoration: none;
            cursor: pointer;
        }

        .underline-text:hover {
            text-decoration: underline;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <h3>
                        Add Designation
                    </h3>
                </div>
                <div class="col-12 col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#">
                                <i data-feather="home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">add</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <form id="DesignationForm" class="needs-validation" novalidate>

                    <div class="row">

                        <!-- Department -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Department<span class="text-danger">*</span> </label>
                            <select class="form-select" required>
                                <option value="">Select Department</option>
                                <option>HR</option>
                                <option>IT</option>
                                <option>Admin</option>
                                <option>Finance</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select department.
                            </div>
                        </div>

                        <!-- Designation Name -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Designation<span class="text-danger">*</span> </label>
                            <input type="text" class="form-control" placeholder="Enter Designation" required>
                            <div class="invalid-feedback">
                                Please enter designation.
                            </div>
                        </div>

                    </div>

                    <!-- Submit Button -->
                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-primary px-4">
                            Submit
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        (() => {
            'use strict';

            const form = document.getElementById('DesignationForm');

            form.addEventListener('submit', function (event) {

                event.preventDefault();

                if (!form.checkValidity()) {
                    event.stopPropagation();
                    form.classList.add('was-validated');
                    return;
                }

                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Designation added successfully',
                    confirmButtonColor: '#ff6a88'
                }).then(() => {
                    form.reset();
                    form.classList.remove('was-validated');
                });

            }, false);

        })();
    </script>
@endsection