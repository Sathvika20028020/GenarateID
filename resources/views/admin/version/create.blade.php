@extends('admin.layout.app')
@section('title') Create Version @endsection

@section('style')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            background-color: #f4f6f9;
        }

        .asset-card {
            color: #fff;
            border-radius: 12px;
            padding: 18px;
            position: relative;
            overflow: hidden;
            transition: 0.3s;
            height: 100%;
            display: flex;
            align-items: center;
        }

        .asset-card:hover {
            transform: translateY(-5px);
        }

        .asset-icon {
            font-size: 32px;
            opacity: 0.9;
        }

        .asset-count {
            font-size: 28px;
            font-weight: 700;
        }

        .asset-text {
            font-size: 14px;
            opacity: 0.9;
        }

        .bg-roads {
            background: linear-gradient(45deg, #2c3e50, #34495e);
        }

        .bg-drains {
            background: linear-gradient(45deg, #2980b9, #3498db);
        }

        .bg-lakes {
            background: linear-gradient(45deg, #1abc9c, #16a085);
        }

        .bg-parks {
            background: linear-gradient(45deg, #27ae60, #2ecc71);
        }

        .bg-toilets {
            background: linear-gradient(45deg, #8e44ad, #9b59b6);
        }

        .bg-skywalk {
            background: linear-gradient(45deg, #d35400, #e67e22);
        }

        .bg-bus {
            background: linear-gradient(45deg, #c0392b, #e74c3c);
        }

        .bg-schools {
            background: linear-gradient(45deg, #f39c12, #f1c40f);
        }

        .bg-playgrounds {
            background: linear-gradient(45deg, #16a085, #1abc9c);
        }

        .bg-parking {
            background: linear-gradient(45deg, #2c3e50, #4ca1af);
        }

        .bg-community {
            background: linear-gradient(45deg, #7f8c8d, #95a5a6);
        }

        .bg-phc {
            background: linear-gradient(45deg, #e74c3c, #ff6b6b);
        }

        .bg-hospital {
            background: linear-gradient(45deg, #c0392b, #e74c3c);
        }

        .bg-crematorium {
            background: linear-gradient(45deg, #6c5ce7, #a29bfe);
        }

        .bg-office {
            background: linear-gradient(45deg, #34495e, #2c3e50);
        }

        .filter-select {
            border-radius: 10px;
            padding: 10px;
            font-weight: 500;
        }

        .filter-select:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 6px rgba(13, 110, 253, 0.25);
        }

        select[name="type"] {
            -webkit-appearance: menulist;
            -moz-appearance: menulist;
            appearance: menulist;
            background-image: none;
        }

        select[name="type"]::-webkit-scrollbar {
            width: 8px;
        }

        select[name="type"]::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }

        select[name="type"]::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 4px;
        }

        .status-badge {
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
        }

        .status-active {
            background-color: #28a745;
            color: #fff;
        }

        .status-inactive {
            background-color: #dc3545;
            color: #fff;
        }

        .action-btn {
            border: none;
            background: transparent;
            font-size: 1.2rem;
            margin: 0 3px;
            cursor: pointer;
        }

        .action-btn.view {
            color: #0d6efd;
        }

        .action-btn.edit {
            color: #198754;
        }

        .action-btn:hover {
            opacity: 0.7;
        }

        .value {
            font-size: 30px;
            font-weight: 600;
            margin-left: 15px;
        }

        .add-issue-container {
            text-align: right;
            margin-bottom: 15px;
            margin-right: 23px;
        }

        .issue {
            padding: 10px;
            font-size: 30px;
            margin-left: 5px;
            margin-top: 5px;
        }

        .btn-add {
            background-color: #6c63ff;
            color: white;
            font-weight: 500;
            margin-right: 20px;
        }

        .btn-add:hover {
            background-color: #5848d9;
            color: white;
        }

        .card1 {
            text-align: center;
            padding: 14px;
        }

        .card1 h5 {
            font-size: 22px !important;
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
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <h3>
                        Create Version
                    </h3>
                </div>
                <div class="col-12 col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="">
                                <i data-feather="home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">Create</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">

                        <form action="" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                            @csrf
                            <div class="d-flex row m-0">
                                <div class="col-lg-4 col-md-6 col-12 mb-3">
                                    <label class="form-label mb-0"> Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" value=""
                                        placeholder="Enter version name" required minlength="2" maxlength="100"
                                        oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')">
                                    <div class="invalid-feedback">
                                        Please enter a valid version name (2-100 characters).
                                    </div>

                                </div>
                                <div class="col-lg-4 col-md-6 col-12 mb-3">
                                    <label class="form-label mb-0"> Code <span class="text-danger">*</span></label>
                                    <input type="text" name="code" class="form-control" value=""
                                        placeholder="Enter version code" required minlength="2" maxlength="100">
                                    <div class="invalid-feedback">
                                        Please enter a valid version code (2-100 characters).
                                    </div>

                                </div>
                                <div class="col-lg-4 col-md-6 col-12 mb-3">
                                    <label class="form-label mb-0"> Title <span class="text-danger">*</span></label>
                                    <input type="text" name="title" class="form-control" value=""
                                        placeholder="Enter version title" required minlength="2" maxlength="100"
                                        oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')">
                                    <div class="invalid-feedback">
                                        Please enter a valid version title (2-100 characters).
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-12 mb-3">
                                    <label class="form-label mb-0">Version Type <span class="text-danger">*</span></label>
                                    <select name="type" class="form-control" required>
                                        <option value="">Select version type</option>
                                        <option value="new">New</option>
                                        <option value="fix">Fix</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a valid version type.
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-12 mb-3">
                                    <label class="form-label mb-0">Date <span class="text-danger">*</span></label>
                                    <input type="date" name="date" class="form-control" value=""
                                        placeholder="Enter version date" required>
                                    <div class="invalid-feedback">
                                        Please enter a valid version date.
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-12 mb-3">
                                    <label class="form-label mb-0">Upload Pdf <span class="text-danger">*</span></label>
                                    <input type="file" name="pdf" class="form-control" 
                                        accept=".pdf,application/pdf" required
                                        data-max-size="2097152">
                                    <div class="invalid-feedback">
                                        Please upload a valid PDF file (Max 2MB).
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-12 mb-3">
                                    <label class="form-label mb-0">Description <span class="text-danger">*</span></label>
                                    <textarea name="description" class="form-control" rows="3"
                                        placeholder="Enter version description" required minlength="2" maxlength="500"></textarea>
                                    <div class="invalid-feedback">
                                        Please enter a valid version description (2-500 characters).
                                    </div>
                                </div>
                                
                            </div>

                            <div class="col-12 text-center mt-3">
                                <button type="submit" class="btn btn-primary" id="submitBtn">
                                    <span id="btnText">Submit</span>
                                    <span id="btnLoader" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        (function () {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms).forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    event.preventDefault()
                    event.stopPropagation()

                    if (form.checkValidity()) {
                        // Show loader
                        const submitBtn = document.getElementById('submitBtn')
                        const btnText = document.getElementById('btnText')
                        const btnLoader = document.getElementById('btnLoader')
                        
                        submitBtn.disabled = true
                        btnText.textContent = 'Submitting...'
                        btnLoader.classList.remove('d-none')

                        // Actual form submission
                        form.submit()
                    }

                    form.classList.add('was-validated')
                }, false)

                // Add real-time validation
                var inputs = form.querySelectorAll('input, textarea, select')
                Array.prototype.slice.call(inputs).forEach(function (input) {
                    input.addEventListener('input', function () {
                        if (input.checkValidity()) {
                            input.classList.remove('is-invalid')
                            input.classList.add('is-valid')
                        } else {
                            input.classList.remove('is-valid')
                            input.classList.add('is-invalid')
                        }
                    })

                    input.addEventListener('blur', function () {
                        if (input.value) {
                            if (input.checkValidity()) {
                                input.classList.remove('is-invalid')
                                input.classList.add('is-valid')
                            } else {
                                input.classList.remove('is-valid')
                                input.classList.add('is-invalid')
                            }
                        }
                    })
                })

                // File size validation for PDF
                var pdfInput = form.querySelector('input[name="pdf"]')
                if (pdfInput) {
                    pdfInput.addEventListener('change', function () {
                        var file = this.files[0]
                        var maxSize = 2097152 // 2MB in bytes
                        
                        if (file) {
                            if (file.size > maxSize) {
                                this.classList.add('is-invalid')
                                this.classList.remove('is-valid')
                                this.setCustomValidity('File size must be less than 2MB.')
                            } else if (file.type !== 'application/pdf') {
                                this.classList.add('is-invalid')
                                this.classList.remove('is-valid')
                                this.setCustomValidity('Please upload a valid PDF file.')
                            } else {
                                this.classList.remove('is-invalid')
                                this.classList.add('is-valid')
                                this.setCustomValidity('')
                            }
                        }
                    })
                }

                // Reset validation states on form reset
                form.addEventListener('reset', function () {
                    form.classList.remove('was-validated')
                    var inputs = form.querySelectorAll('input, textarea, select')
                    Array.prototype.slice.call(inputs).forEach(function (input) {
                        input.classList.remove('is-valid', 'is-invalid')
                    })
                })
            })
        })()
    </script>
@endsection