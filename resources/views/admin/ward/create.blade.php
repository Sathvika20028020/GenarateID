@extends('admin.layout.app')
@section('title') Add Ward @endsection
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
                    Add Ward
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
            <form id="wardForm" class="needs-validation" novalidate action="{{ route('ward.store') }}" method="post">
                          @csrf
                <!-- Row 1 -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Ward Name<span class="text-danger">*</span> </label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Ward Name" required>
                        <div class="invalid-feedback">
                            @error('name') {{ $message }} @else Please enter ward name. @enderror
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Ward No<span class="text-danger">*</span> </label>
                        <input type="number" name="number" value="{{ old('number') }}" class="form-control @error('number') is-invalid @enderror" placeholder="Enter Ward Number" required>
                        <div class="invalid-feedback">
                            @error('number') {{ $message }} @else Please enter ward number. @enderror
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Ward Name (Kannada)</label>
                        <input type="text" name="name_kn" value="{{ old('name_kn') }}" class="form-control @error('name_kn') is-invalid @enderror" placeholder="Enter Kannada Ward Name">
                        @error('name_kn')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <!-- Row 2 -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Corporation<span class="text-danger">*</span> </label>
                        <select class="form-select @error('corporation_id') is-invalid @enderror" name="corporation_id" id="corporationSelect" required>
                            <option value="">Select Corporation</option>
                                          @foreach($corporations as $corporation)
                                          <option value="{{$corporation->id}}" {{ old('corporation_id') == $corporation->id ? 'selected' : '' }}>{{$corporation->name}}</option>
                                          @endforeach
                        </select>
                        <div class="invalid-feedback">
                            @error('corporation_id') {{ $message }} @else Please select corporation. @enderror
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Zone<span class="text-danger">*</span> </label>
                        <select class="form-select @error('zone_id') is-invalid @enderror" name="zone_id" id="zoneSelect" required>
                            <option value="">Select Zone</option>
                            @foreach($zones as $zone)
                            <option value="{{ $zone->id }}" data-corporation="{{ $zone->corporation_id }}" {{ old('zone_id') == $zone->id ? 'selected' : '' }}>{{ $zone->name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            @error('zone_id') {{ $message }} @else Please select zone. @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Constituency<span class="text-danger">*</span> </label>
                        <select class="form-select @error('constituency_id') is-invalid @enderror" name="constituency_id" id="consSelect" required>
                            <option value="">Select Constituency</option>
                            @foreach($constituencies as $constituency)
                            <option value="{{ $constituency->id }}" data-zone="{{ $constituency->zone_id }}" {{ old('constituency_id') == $constituency->id ? 'selected' : '' }}>{{ $constituency->name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            @error('constituency_id') {{ $message }} @else Please select constituency. @enderror
                        </div>
                    </div>
                </div>
                <!-- Submit Button -->
                <div class="d-flex justify-content-center mt-3">
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
        //     icon: 'success',
        //     title: 'Success!',
        //     text: 'Ward added successfully.',
        //     confirmButtonColor: '#ff6a88'
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
