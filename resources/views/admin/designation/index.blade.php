@extends('admin.layout.app')
@section('title') List Designations @endsection
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
    vertical-align: middle;
}

.switch input {
    opacity: 0;
    width: 0;
    height: 0;
    position: absolute;
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

input:focus+.slider {
    box-shadow: 0 0 1px #2196F3;
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
                    List Designations
                </h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#">
                            <i data-feather="home"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item">list</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid starts-->
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="mb-0 add"></h4>
                        <div class="d-flex gap-2">

                            <a href="{{ route('designation.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus-circle me-1"></i>
                                Add
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped  text-center align-middle" id="data-source-1"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th style="width:10%">Sl.No</th>
                                    <th style="width:20%">Designation</th>
                                    <th style="width:20%">Department</th>
                                    <th style="width:20%">Status</th>
                                    <th style="width:20%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach($entries as $entry)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$entry->name}}</td>
                                    <td>Corporation</td>

                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" {{$entry->status ? 'checked' : ''}}>
                                            <span class="slider"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="{{ route('designation.edit', $entry->id) }}" class="btn btn-sm btn-primary" title="Edit">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <a href="{{ route('designation.show', $entry->id) }}" class="btn btn-sm btn-info text-white"
                                                title="View">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
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
  @if(session()->has('success'))
        Swal.fire({
            icon: "success",
            title: "Success!",
            text: "{{session('success')}}",
            confirmButtonColor: "#ff6a88"
        });
    @endif
 </script>
@endsection