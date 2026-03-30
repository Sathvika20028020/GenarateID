@extends('admin.layout.app')
@section('title') Edit Ward @endsection
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
                    Edit Ward
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
            <form id="wardForm" class="needs-validation" novalidate action="{{ route('ward.update', $ward->id) }}" method="post">
                          @csrf @method('put')
                <!-- Row 1 -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Ward Name</label>
                        <input type="text" class="form-control" value="{{$ward->name}}" name="name" required>
                        <div class="invalid-feedback">
                            Please enter ward name.
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Ward No</label>
                        <input type="number" class="form-control" value="{{$ward->number}}" name="number" required>
                        <div class="invalid-feedback">
                            Please enter ward number.
                        </div>
                    </div>
                </div>
                <!-- Row 2 -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Corporation</label>
                        <select class="form-select" required name="corporation_id" id="corporationSelect" >
                            <option value="">Select Corporation</option>
                            @foreach($corporations as $corporation)
                            <option value="{{$corporation->id}}" {{$corporation->id == $ward->corporation_id ? 'selected' : ''}}>{{$corporation->name}}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Please select corporation.
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Zone</label>
                        <select class="form-select" required name="zone_id" id="zoneSelect">
                            <option value="">Select Zone</option>
                            @foreach($zones as $zone)
                            <option value="{{$zone->id}}" {{$zone->id == $ward->zone_id ? 'selected' : ''}}>{{$zone->name}}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Please select zone.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Constituency</label>
                        <select class="form-select" required name="constituency_id" id="consSelect">
                            <option value="">Select Constituency</option>
                            @foreach($constituencies as $zone)
                            <option value="{{$zone->id}}" {{$zone->id == $ward->constituency_id ? 'selected' : ''}}>{{$zone->name}}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Please select zone.
                        </div>
                    </div>
                </div>
                <!-- Update Button -->
                <div class="d-flex justify-content-center mt-3">
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
(() => {
    'use strict'

    const form = document.getElementById('wardForm');

    form.addEventListener('submit', function(event) {

      
      if (!form.checkValidity()) {
          event.preventDefault();
            event.stopPropagation();
            form.classList.add('was-validated');
            return;
        }

        // SweetAlert Success Popup
        // Swal.fire({
        //     icon: "success",
        //     title: "Updated!",
        //     text: "Ward updated successfully!",
        //     confirmButtonColor: "#28a745"
        // }).then(() => {
        //     form.reset();
        //     form.classList.remove('was-validated');
        // });

    }, false);

})();
</script>

    <script>
        

        document.getElementById("corporationSelect").addEventListener("change", function () {
            const selectedValue = this.value;
            
            $.ajax({
              method: "POST",
              url: "{{ route('ward.store') }}",
              data: {_token: "{{csrf_token()}}", id: selectedValue, list:'zones'}, 
            })
            .done(function (res) {
              if(res.success){
                var options = '';
                $.each(res.list, function(key, value){
                    options += '<option value="' + value.id + '">' + value.name + '</option>';
                });
                options = '<option value="">Select Zone</option>' + options;
                $('#zoneSelect').html(options);
              }
            })
            .fail(function (err) {
              console.log(err);              
            });
        });

         document.getElementById("zoneSelect").addEventListener("change", function () {
            const selectedValue = this.value;

            $.ajax({
              method: "POST",
              url: "{{ route('ward.store') }}",
              data: {_token: "{{csrf_token()}}", id: selectedValue, list:'cons'}, 
            })
            .done(function (res) {
              if(res.success){
                var options = '';
                $.each(res.list, function(key, value){
                    options += '<option value="' + value.id + '">' + value.name + '</option>';
                });
                options = '<option value="">Choose Constituency</option>' + options;
                $('#consSelect').html(options);
              }
            })
            .fail(function (err) {
              console.log(err);              
            });
        });
    </script>
@endsection