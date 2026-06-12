@extends('admin.layout.app')
@section('title') Version List @endsection

@section('style')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
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
                    <!-- <h3>
                        Version List
                    </h3> -->
                </div>
                <div class="col-12 col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="">
                                <i data-feather="home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">Version List</li>
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
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 class="mb-0 add"></h4>
                            <div class="d-flex gap-2">
                                <a href="{{ url('version/create') }}" class="btn btn-primary">
                                    <i class="bi bi-plus-circle me-1"></i>
                                    Add Version
                                </a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped text-center align-middle" id="data-source-1"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th>SI No.</th>
                                        <th>Version Name</th>
                                        <th>Version Code</th>
                                        <th>Version Title</th>
                                        <th>Version Description</th>
                                        <th>Version Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                   
                                        <tr>
                                            <td>01</td>
                                            <td>New</td>
                                            <td>v1.0.0</td>
                                            <td>New Version</td>
                                            <td>Version Text</td>
                                            <td>
                                                <label class="switch mb-0">
                                                    <input type="checkbox" class="toggle-status" >
                                                    <span class="slider"></span>
                                                </label>
                                            </td>
                                            <td class="d-flex flex-row align-items-center justify-content-center">
                                                <span class="d-flex flex-row gap-2">
                                                    <a href="" class="btn btn-sm btn-warning">Edit</a>
                                                    <a href="{{ url('version/show') }}" class="btn btn-sm btn-info text-white">View</a>
                                                </span>
                                            </td>
                                        </tr>
                                   
                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggles = document.querySelectorAll('.toggle-status');
        
        toggles.forEach(toggle => {
            toggle.addEventListener('change', function() {
                const versionId = this.dataset.id;
                
                fetch(`/admin/version/${versionId}/toggle-status`, {
                    method: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (!data.success) {
                        this.checked = !this.checked;
                        Swal.fire({
                            icon: 'error',
                            title: 'Update Failed',
                            text: 'Failed to update status.',
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    this.checked = !this.checked;
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred while updating status.',
                    });
                });
            });
        });
    });
</script>
@endsection