@extends('admin.layout.app')
@section('title') Add User @endsection
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
                    Add User
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
            <form id="userForm" class="needs-validation" novalidate>
                <div class="row g-3">
                    <!-- User Name -->
                    <div class="col-md-6">
                        <label class="form-label fw-bold">User Name<span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" placeholder="Enter User Name" required>
                        <div class="invalid-feedback">
                            Please enter user name.
                        </div>
                    </div>
                    <!-- Email -->
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Email<span class="text-danger">*</span> </label>
                        <input type="email" class="form-control" placeholder="Enter Email" required>
                        <div class="invalid-feedback">
                            Please enter valid email.
                        </div>
                    </div>
                    <!-- Phone -->
                    <div class="col-md-6">
    <label class="form-label fw-bold">Phone<span class="text-danger">*</span> </label>
    <input type="text" 
           class="form-control" 
           placeholder="Enter 10 digit phone number"
           maxlength="10" 
           pattern="\d{10}" 
           inputmode="numeric"
           oninput="this.value = this.value.replace(/[^0-9]/g, '')" 
           required>
    <div class="invalid-feedback">
        Enter valid 10 digit phone number.
    </div>
</div>
                    <!-- Password -->
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Password<span class="text-danger">*</span> </label>
                        <input type="password" class="form-control" placeholder="Enter Password" required>
                        <div class="invalid-feedback">
                            Please enter password.
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Ward Selection<span class="text-danger">*</span> </label>
                        <!-- Badge container -->
                        <div id="wardBadges" class="mb-2"></div>
                        <!-- Dropdown -->
                        <select id="wardSelect" class="form-select">
                            <option value="">Select Ward</option>
                            <option value="Ward 1">Ward 1</option>
                            <option value="Ward 2">Ward 2</option>
                            <option value="Ward 3">Ward 3</option>
                            <option value="Ward 4">Ward 4</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Department Selection<span class="text-danger">*</span> </label>
                        <!-- Badge container -->
                        <div id="departmentBadges" class="mb-2"></div>
                        <!-- Dropdown -->
                        <select id="departmentSelect" class="form-select">
                            <option value="">Select Department</option>
                            <option value="Department 1">Department 1</option>
                            <option value="Department 2">Department 2</option>
                            <option value="Department 3">Department 3</option>
                            <option value="Department 4">Department 4</option>
                        </select>
                    </div>
                </div>
                <!-- Submit Button -->
                <div class="text-center mt-4">
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
/* ---------------- WARD MULTI SELECT ---------------- */

const wardSelect = document.getElementById('wardSelect');
const wardBadges = document.getElementById('wardBadges');

let selectedWards = [];

function renderWardBadges() {

    wardBadges.innerHTML = '';

    Array.from(wardSelect.options).forEach(opt => {
        opt.style.backgroundColor = '';
        opt.style.color = '';
    });

    selectedWards.forEach((ward, index) => {

        const badge = document.createElement('span');
        badge.className = 'badge bg-primary me-1';
        badge.style.cursor = 'pointer';
        badge.innerHTML = `${ward} <span data-index="${index}">&times;</span>`;

        badge.querySelector('span').addEventListener('click', function() {
            const idx = this.getAttribute('data-index');
            selectedWards.splice(idx, 1);
            renderWardBadges();
        });

        wardBadges.appendChild(badge);

        Array.from(wardSelect.options).forEach(opt => {
            if (opt.value === ward) {
                opt.style.backgroundColor = '#6362e7';
                opt.style.color = '#ffffff';
            }
        });

    });
}

wardSelect.addEventListener('change', function() {

    const value = wardSelect.value;

    if (value && !selectedWards.includes(value)) {
        selectedWards.push(value);
        renderWardBadges();
    }

    wardSelect.value = '';

});


/* ---------------- DEPARTMENT MULTI SELECT ---------------- */

const departmentSelect = document.getElementById('departmentSelect');
const departmentBadges = document.getElementById('departmentBadges');

let selectedDepartments = [];

function renderDepartmentBadges() {

    departmentBadges.innerHTML = '';

    Array.from(departmentSelect.options).forEach(opt => {
        opt.style.backgroundColor = '';
        opt.style.color = '';
    });

    selectedDepartments.forEach((dept, index) => {

        const badge = document.createElement('span');
        badge.className = 'badge bg-success me-1';
        badge.style.cursor = 'pointer';
        badge.innerHTML = `${dept} <span data-index="${index}">&times;</span>`;

        badge.querySelector('span').addEventListener('click', function() {
            const idx = this.getAttribute('data-index');
            selectedDepartments.splice(idx, 1);
            renderDepartmentBadges();
        });

        departmentBadges.appendChild(badge);

        Array.from(departmentSelect.options).forEach(opt => {
            if (opt.value === dept) {
                opt.style.backgroundColor = '#198754';
                opt.style.color = '#ffffff';
            }
        });

    });
}

departmentSelect.addEventListener('change', function() {

    const value = departmentSelect.value;

    if (value && !selectedDepartments.includes(value)) {
        selectedDepartments.push(value);
        renderDepartmentBadges();
    }

    departmentSelect.value = '';

});
</script>
<script>
document.addEventListener("DOMContentLoaded", function() {

    const form = document.getElementById("userForm");

    form.addEventListener("submit", function(event) {

        event.preventDefault();
        event.stopPropagation();

        if (!form.checkValidity()) {
            form.classList.add("was-validated");
            return;
        }

        Swal.fire({
            icon: "success",
            title: "Success!",
            text: "User created successfully!",
            confirmButtonColor: "#ff6a88"
        }).then(() => {

            location.reload(); // page refresh after clicking OK

        });

    });

});
</script>
@endsection