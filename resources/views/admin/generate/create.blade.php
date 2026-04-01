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
                        Generate ID
                    </h3>
                </div>
                <div class="col-12 col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html">
                                <i data-feather="home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">Add</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container mt-1">
        <div class="card ">
            <div class="card-body">
                <form id="employeeForm" class="needs-validation" novalidate enctype="multipart/form-data"
                    action="{{ route('generate-id.store') }}" method="post">
                    @csrf
                    <div class="row g-3">

                        <!-- Name -->
                        <div class="col-md-6">
                            <label class="form-label">Name<span class="text-danger">*</span> </label>
                            <input type="text" name="name" class="form-control" placeholder="Enter full name" required>
                            <div class="invalid-feedback">
                                Please enter name.
                            </div>
                        </div>

                        <!-- Employee ID -->
                        <div class="col-md-6">
                            <label class="form-label">Employee ID<span class="text-danger">*</span> </label>
                            <input type="text" name="emp_id" class="form-control" placeholder="Enter employee ID" required>
                            <div class="invalid-feedback">
                                Please enter Employee ID.
                            </div>
                        </div>

                        <!-- Department -->
                        <div class="col-md-6">
                            <label class="form-label">Department<span class="text-danger">*</span> </label>
                            <select class="form-select" name="department_id"
                                onchange="getList(this.value, 'Designation', 'designation_id')" required>
                                <option value="">Select Department</option>
                                @foreach($departments as $department)
                                    <option value="{{$department->id}}">{{$department->name}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Please select department.
                            </div>
                        </div>

                        <!-- Designation -->
                        <div class="col-md-6">
                            <label class="form-label">Designation<span class="text-danger">*</span> </label>
                            <select class="form-select" name="designation_id" id="designation_id" required>
                                <option value="">Select Designation</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select designation.
                            </div>
                        </div>

                        <!-- Phone Number -->
                        <div class="col-md-6">
                            <label class="form-label">Phone Number<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Enter 10 digit phone number" maxlength="10"
                                pattern="\d{10}" inputmode="numeric" name="phone"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
                            <div class="invalid-feedback">
                                Enter valid 10 digit phone number.
                            </div>
                        </div>

                        <!-- Photo Upload -->
                        <div class="col-md-6">
                            <label class="form-label">Photo (Max 2MB)<span class="text-danger">*</span></label>
                            <input type="file" class="form-control" accept="image/*" required name="image">
                            <div class="invalid-feedback">
                                Please upload photo (Max 2MB).
                            </div>
                        </div>
                        <!-- Address -->
                        <div class="col-md-12">
                            <label class="form-label">Address<span class="text-danger">*</span></label>
                            <textarea name="address" class="form-control" rows="3" placeholder="Enter address"
                                required></textarea>
                            <div class="invalid-feedback">
                                Please enter address.
                            </div>
                        </div>

                        <!-- Blood Group -->
                        <div class="col-md-6">
                            <label class="form-label">Blood Group<span class="text-danger">*</span></label>
                            <select class="form-select" name="blood_group" required>
                                <option value="">Select Blood Group</option>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select blood group.
                            </div>
                        </div>

                        <!-- Valid Upto -->
                        <div class="col-md-6">
                            <label class="form-label">Valid Upto<span class="text-danger">*</span></label>
                            <input type="date" name="valid_upto" id="valid_upto" class="form-control" required>
                            <div class="invalid-feedback">
                                Please select valid upto date.
                            </div>
                        </div>
                        <!-- Corporation -->
                        <div class="col-md-6">
                            <label class="form-label">Corporation<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="West" readonly>
                        </div>

                        <!-- Zone -->
                        <div class="col-md-6">
                            <label class="form-label">Zone <span class="text-danger">*</span></label>
                            <select class="form-select" name="zone_id" required
                                onchange="getList(this.value, 'Ward', 'ward_id')">
                                <option value="">Select Zone</option>
                                @foreach($zones as $zone)
                                    <option value="{{$zone->id}}">{{$zone->name}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Please select zone.
                            </div>
                        </div>

                        <!-- Ward -->
                        <div class="col-md-6">
                            <label class="form-label">Ward<span class="text-danger">*</span></label>
                            <select class="form-select" name="ward_id" id="ward_id" required>
                                <option value="">Select Ward</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select ward.
                            </div>
                        </div>

                    </div>
                    <!-- Submit Button -->
                    <div class="text-center mt-4">
                        <button class="btn btn-primary px-4" type="submit">Submit</button>
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

    const form = document.getElementById('employeeForm');
    const validUpto = document.getElementById('valid_upto');

    // Set minimum date as today
    const today = new Date();
    const yyyy = today.getFullYear();
    const mm = String(today.getMonth() + 1).padStart(2, '0');
    const dd = String(today.getDate()).padStart(2, '0');
    const todayDate = `${yyyy}-${mm}-${dd}`;

    validUpto.setAttribute('min', todayDate);

    form.addEventListener('submit', function(event) {

        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
            form.classList.add('was-validated');
            return;
        }

        // Extra Valid Upto validation
        if (validUpto.value < todayDate) {
            event.preventDefault();
            event.stopPropagation();
            Swal.fire({
                icon: 'error',
                title: 'Invalid Date',
                text: 'Previous dates are not allowed in Valid Upto.'
            });
            validUpto.classList.add('is-invalid');
            return;
        } else {
            validUpto.classList.remove('is-invalid');
        }

        // File size validation (2MB)
        const fileInput = form.querySelector('input[type="file"]');
        if (fileInput.files.length > 0) {
            const fileSize = fileInput.files[0].size;
            if (fileSize > 2097152) {
                event.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'File Too Large',
                    text: 'Photo must be less than 2MB'
                });
                return;
            }
        }

        form.classList.add('was-validated');

        // Success alert if you want before submit
        // event.preventDefault();
        // Swal.fire({
        //     icon: 'success',
        //     title: 'Success!',
        //     text: 'Employee ID Created Successfully',
        //     confirmButtonColor: '#4c6fff'
        // }).then(() => {
        //     form.submit();
        // });

    }, false);

})();
</script>

    <script>
        function getList(id, type, eid) {
            $.ajax({
                method: "POST",
                url: "{{ route('generate-id.store') }}",
                data: { _token: "{{csrf_token()}}", id: id, list: type },
            })
                .done(function (res) {
                    if (res.success) {
                        var options = '';
                        $.each(res.list, function (key, value) {
                            options += '<option value="' + value.id + '">' + value.name + '</option>';
                        });
                        options = '<option value="">Select ' + type + '</option>' + options;
                        $('#' + eid).html(options);
                    }
                })
                .fail(function (err) {
                    console.log(err);
                });
        }
    </script>
@endsection