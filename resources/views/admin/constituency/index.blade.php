@extends('admin.layout.app')

@section('style')
<style>
.page-wrapper.compact-wrapper .page-body-wrapper div.sidebar-wrapper .sidebar-main .simplebar-offset {
    height: auto !important;
}

.footer {
    margin-left: 0px !important;
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
                <h3 style="color: #1e2f65;font-family: sans-serif;">Constituency List</h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"> <i data-feather="home"></i></a>
                    </li>

                    <li class="breadcrumb-item active">Constituency List</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="mb-0 add"></h4>
                        <button class="btn btn-primary">
                            <a href="{{ route('constituency.create') }}" style="color: white;">
                                <i class="bi bi-plus-circle me-1"></i>
                                Add
                            </a>
                        </button>
                    </div>

                    <div class="table-responsive">
                        <table class="display" id="data-source-1" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sl.No</th>
                                    <th>Corporation (Eng)</th>
                                    <th>Corporation (Kan)</th>
                                    <th>Zone (Eng)</th>
                                    <th>Zone (Kan)</th>
                                    <th>Constituency (Eng)</th>
                                    <th>Constituency (Kan)</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach($entries as $entry)
                                <tr>
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td>{{$entry->corporation?->name}}</td>
                                    <td>{{$entry->corporation?->name_kn}}</td>
                                    <td>{{$entry->zone?->name}}</td>
                                    <td>{{$entry->zone?->name_kn}}</td>
                                    <td>{{$entry->name}}</td>
                                    <td>{{$entry->name_kn}}</td>
                                    <td class="text-center">
                                        <span class="badge bg-{{ $entry->status ? 'success' : 'danger' }}">{{ $entry->status ? 'Active' : 'Inactive' }}</span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('constituency.edit', $entry->id) }}" class="btn btn-sm btn-warning me-1 px-2">Edit</a>
                                        <a href="" class="btn btn-sm btn-danger px-2">Delete</a>
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
<script>
function openViewPage(button) {
    let row = button.closest("tr");

    let Venue = row.querySelector(".Venue").innerText;

    const url = `view.html?Venue=${encodeURIComponent(Venue)}`;

    window.location.href = url;
}

function openEditPage(button) {
    let row = button.closest("tr");

    let Venue = row.querySelector(".Venue").innerText;

    const url = `edit.html?Venue=${encodeURIComponent(Venue)}`;

    window.location.href = url;
}
</script>
@endsection