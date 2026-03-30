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
    input:checked + .slider {
      background-color: #2196F3;
    }
    input:checked + .slider:before {
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
                     Generate ID Edit
                </h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.html">
                            <i data-feather="home"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item">Edit</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid starts-->
<div class="container mt-1">
    <div class="card">

        <div class="card-body">
            <form id="employeeForm" class="needs-validation" novalidate enctype="multipart/form-data" action="{{ route('generate-id.update', $generateId) }}" method="post">
                    @csrf @method('put')
                <!-- Hidden ID (for update purpose) -->
                <div class="row g-3">
                    <!-- Name -->
                    <div class="col-md-6">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" value="{{$generateId->name}}" required>
                        <div class="invalid-feedback">
                            Please enter name.
                        </div>
                    </div>
                    <!-- Employee ID -->
                    <div class="col-md-6">
                        <label class="form-label">Employee ID</label>
                        <input type="text" class="form-control" name="emp_id" value="{{$generateId->emp_id}}" required>
                        <div class="invalid-feedback">
                            Please enter Employee ID.
                        </div>
                    </div>
                    <!-- Designation -->
                    <div class="col-md-6">
                        <label class="form-label">Designation</label>
                        <select class="form-select" name="designation_id" id="designation_id" required>
                            <option value="">Select Designation</option>
                            @foreach($designations as $designation)
                            <option value="{{$designation->id}}" {{$generateId->designation_id == $designation->id ? 'selected' :''}}>{{$designation->name}}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Please select designation.
                        </div>
                    </div>
                    <!-- Photo Upload (Optional in Edit) -->
                    <div class="col-md-6">
                        <label class="form-label">Change Photo (Max 2MB)</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                        <small class="text-muted">Leave blank if you don’t want to change photo.</small>
                    </div>
                    <!-- Phone Number -->
                    <div class="col-md-6">
                        <label class="form-label">Phone Number</label>
                        <input type="text" name="phone" value="{{$generateId->phone}}" class="form-control" value="9876543210" maxlength="10" pattern="\d{10}"
                            inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
                        <div class="invalid-feedback">
                            Enter valid 10 digit phone number.
                        </div>
                    </div>
                    <!-- Department -->
                    <div class="col-md-6">
                        <label class="form-label">Department</label>
                        <select class="form-select" name="department_id" required onchange="getList(this.value, 'Designation', 'designation_id')">
                            <option value="">Select Department</option>
                            @foreach($departments as $department)
                            <option value="{{$department->id}}" {{$generateId->department_id == $department->id ? 'selected' :''}}>{{$department->name}}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Please select department.
                        </div>
                    </div>
                    <!-- Corporation -->
                    <div class="col-md-6">
                        <label class="form-label">Corporation</label>
                        <input type="text" class="form-control" value="West" readonly>
                        <div class="invalid-feedback">
                            Please select corporation.
                        </div>
                    </div>
                    <!-- Zone -->
                    <div class="col-md-6">
                        <label class="form-label">Zone</label>
                        <select class="form-select" name="zone_id" required onchange="getList(this.value, 'Ward', 'ward_id')">
                            <option value="">Select Zone</option>
                            @foreach($zones as $zone)
                            <option value="{{$zone->id}}" {{$generateId->zone_id == $zone->id ? 'selected' :''}}>{{$zone->name}}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Please select zone.
                        </div>
                    </div>
                    <!-- Ward -->
                    <div class="col-md-6">
                        <label class="form-label">Ward</label>
                        <select class="form-select" name="ward_id" id="ward_id" required>
                            <option value="">Select Ward</option>
                            @foreach($wards as $ward)
                            <option value="{{$ward->id}}" {{$generateId->ward_id == $ward->id ? 'selected' :''}}>{{$ward->name}}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Please select ward.
                        </div>
                    </div>
                </div>
                <!-- Update Button -->
                <div class="text-center mt-4">
                    <button class="btn btn-primary px-4" type="submit">Update</button>
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

  form.addEventListener('submit', function (event) {

    

    if (!form.checkValidity()) {
      event.preventDefault();
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
    // Swal.fire({
    // icon: 'success',
    // title: 'Updated!',
    // text: 'Employee details updated successfully',
    // confirmButtonColor: '#28a745'
    // }).then(() => {
    //     form.reset();
    //     form.classList.remove('was-validated');
    // });

  }, false);

})();
    </script>


<script>
  function getList(id, type, eid){
    $.ajax({
      method: "POST",
      url: "{{ route('generate-id.store') }}",
      data: {_token: "{{csrf_token()}}", id: id, list:type}, 
    })
    .done(function (res) {
      if(res.success){
        var options = '';
        $.each(res.list, function(key, value){
            options += '<option value="' + value.id + '">' + value.name + '</option>';
        });
        options = '<option value="">Select '+type+'</option>' + options;
        $('#'+eid).html(options);
      }
    })
    .fail(function (err) {
      console.log(err);              
    });
  }
</script>
@endsection