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
                        <input type="password" class="form-control" name="password">
                        <div class="invalid-feedback">Please enter password.</div>
                    </div>
                    <!-- Ward Selection -->
                    <div class="col-md-6">
                        <label class="form-label">Ward Selection</label>
                        <select class="form-select" id="wardSelect">
                            <option value="">Select Ward</option>
                            @foreach($wards as $ward)
                              <option value="{{$ward->id}}" {{$ward->id}}>{{$ward->name}} - Ward {{$ward->number}}</option>
                            @endforeach
                        </select>
                        <div id="wardBadges" class="mt-2"></div>
                        <input type="hidden" id="ward_ids" name="ward_ids[]" value="{{implode(',', $user->wardIds())}}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Department Selection</label>
                        <select class="form-select" id="departmentSelect" required>
                            <option value="">Select Department</option>
                            @foreach($departments as $department)
                              <option value="{{$department->id}}" {{$department->id}}>{{$department->name}}</option>
                            @endforeach
                        </select>
                        <div id="departmentBadges" class="mt-2"></div>
                        <input type="hidden" id="department_ids" name="department_ids[]" value="{{implode(',', $user->departmentIds())}}">
                        <div class="invalid-feedback">Please select at least one department.</div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Status</label>
                        <br>
                        <label class="switch">
                            <input type="checkbox" name="status" value="1" {{ $user->status ? 'checked' : '' }}>
                            <span class="slider"></span>
                        </label>
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

<script>
/* ---------------- WARD MULTI SELECT ---------------- */

const wardSelect = document.getElementById('wardSelect');
const wardBadges = document.getElementById('wardBadges');

let selectedWards = [];

// Initialize selected wards from hidden input
function initializeWards() {
    const wardIdsInput = document.getElementById('ward_ids').value;
    if (wardIdsInput) {
        const wardIds = wardIdsInput.split(',').filter(id => id);
        wardIds.forEach(id => {
            const option = wardSelect.querySelector(`option[value="${id}"]`);
            if (option) {
                selectedWards.push({ value: id, text: option.text });
            }
        });
        renderWardBadges();
    }
}

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

        badge.innerHTML = `${ward.text} <span data-index="${index}">&times;</span>`;

        badge.querySelector('span').addEventListener('click', function() {
            const idx = this.getAttribute('data-index');
            selectedWards.splice(idx, 1);
            renderWardBadges();
        });

        wardBadges.appendChild(badge);

        Array.from(wardSelect.options).forEach(opt => {
            if (opt.value === ward.value) {
                opt.style.backgroundColor = '#6362e7';
                opt.style.color = '#ffffff';
            }
        });

    });

    document.getElementById('ward_ids').value =
        selectedWards.map(w => w.value).join(',');
}

wardSelect.addEventListener('change', function() {

    const value = wardSelect.value;
    const text = wardSelect.selectedOptions[0].text;

    if (value && !selectedWards.some(w => w.value === value)) {
        selectedWards.push({ value, text });
        renderWardBadges();
    }

    wardSelect.value = '';
});

initializeWards();


/* ---------------- DEPARTMENT MULTI SELECT ---------------- */

const departmentSelect = document.getElementById('departmentSelect');
const departmentBadges = document.getElementById('departmentBadges');

let selectedDepartments = [];

// Initialize selected departments from hidden input
function initializeDepartments() {
    const deptIdsInput = document.getElementById('department_ids').value;
    if (deptIdsInput) {
        const deptIds = deptIdsInput.split(',').filter(id => id);
        deptIds.forEach(id => {
            const option = departmentSelect.querySelector(`option[value="${id}"]`);
            if (option) {
                selectedDepartments.push({ value: id, text: option.text });
            }
        });
        renderDepartmentBadges();
    }
}

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

        badge.innerHTML = `${dept.text} <span data-index="${index}">&times;</span>`;

        badge.querySelector('span').addEventListener('click', function() {
            const idx = this.getAttribute('data-index');
            selectedDepartments.splice(idx, 1);
            renderDepartmentBadges();
        });

        departmentBadges.appendChild(badge);

        Array.from(departmentSelect.options).forEach(opt => {
            if (opt.value === dept.value) {
                opt.style.backgroundColor = '#198754';
                opt.style.color = '#ffffff';
            }
        });

    });

    document.getElementById('department_ids').value =
        selectedDepartments.map(d => d.value).join(',');
}

departmentSelect.addEventListener('change', function() {

    const value = departmentSelect.value;
    const text = departmentSelect.selectedOptions[0].text;

    if (value && !selectedDepartments.some(d => d.value === value)) {
        selectedDepartments.push({ value, text });
        renderDepartmentBadges();
    }

    departmentSelect.value = '';
});

initializeDepartments();
</script>
@endsection
