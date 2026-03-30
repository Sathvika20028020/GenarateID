@extends('admin.layout.app')
@section('title') Edit User @endsection
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
                    Edit User
                </h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">
                            <i data-feather="home"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item">edit</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid starts-->
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <form id="userForm" class="needs-validation" novalidate action="{{ route('user.update', $user->id) }}" method="post">
                        @csrf @method('put')
                <div class="row g-3">
                    <!-- User Name -->
                    <div class="col-md-6">
                        <label class="form-label">User Name</label>
                        <input type="text" class="form-control" value="{{$user->name}}" name="name" required>
                        <div class="invalid-feedback">Please enter user name.</div>
                    </div>
                    <!-- Email -->
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" required value="{{$user->email}}">
                        <div class="invalid-feedback">Please enter valid email.</div>
                    </div>
                    <!-- Phone -->
                    <div class="col-md-6">
                        <label class="form-label">Phone</label>
                        <input type="text" class="form-control" name="phone" value="{{$user->phone}}" maxlength="10" required>
                        <div class="invalid-feedback">Enter valid 10 digit phone number.</div>
                    </div>
                    <!-- Password -->
                    <div class="col-md-6">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" >
                        <div class="invalid-feedback">Please enter password.</div>
                    </div>
                    <!-- Ward Selection -->
                    <div class="col-md-6">
                        <label class="form-label">Ward Selection</label>
                        <select class="form-select" name="wards[]" multiple required>
                            <option value="">Select Ward</option>
                            @foreach($wards as $ward)
                              <option value="{{$ward->id}}" {{ in_array($ward->id, $user->wards) ? 'selected' : '' }}>{{$ward->name}} - Ward {{$ward->number}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary px-4">
                        Update
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
document.addEventListener("DOMContentLoaded", function() {

    const form = document.getElementById("userForm");

    form.addEventListener("submit", function(event) {

        if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
            form.classList.add("was-validated");
            return;
        }

        // Swal.fire({
        //     icon: "success",
        //     title: "Updated!",
        //     text: "User updated successfully!",
        //     confirmButtonColor: "#28a745"
        // }).then(() => {
        //     form.reset();
        //     form.classList.remove("was-validated");
        // });

    });

});
</script>
@endsection