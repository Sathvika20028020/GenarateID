@extends('admin.layout.app')
@section('title') Create Constituency @endsection
@section('style')
<style>
   .form-section {
      background: #fff;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.05);
      margin-top: 40px;
    }

    .form-label {
      font-weight: 600;
      color: #112c6b;
      margin-bottom: 8px;
    }

    .form-control,
    .form-select {
      height: 46px;
      border-radius: 6px;
    }

    .btn-submit {
      background: linear-gradient(to right, #5f5ce6, #6c63ff);
      color: white;
      border: none;
      padding: 10px 30px;
      border-radius: 12px;
      font-weight: 600;
      min-width: 140px;
    }

    .btn-submit:hover {
      background: linear-gradient(to right, #5148e5, #5d52ff);
      color: white;
    }

    .readonly-box {
      background-color: #e9ecef;
    }
</style>
@endsection
@section('content')
  <div class="container-fluid">
      <div class="page-title">
          <div class="row">
              <div class="col-12 col-sm-6">
                  <h3>Create Constituency</h3>
              </div>
              <div class="col-12 col-sm-6">
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i data-feather="home"></i></a></li>
                      <li class="breadcrumb-item active">Create Constituency</li>
                  </ol>
              </div>
          </div>
      </div>
  </div>
 <div class="container-fluid">
    <div class="form-section">
      <form id="constituencyForm" class="needs-validation" novalidate action="{{ route('constituency.store') }}" method="post">
        @csrf
        <div class="row g-4">
          <div class="col-md-6">
            <label class="form-label">Select Corporation <span class="text-danger">*</span></label>
            <select class="form-select @error('corporation_id') is-invalid @enderror" id="corporationSelect" name="corporation_id" required>
              <option value="">Choose Corporation</option>
              @foreach($corporations as $corporation)
              <option value="{{ $corporation->id }}" data-kan="{{ $corporation->name_kn }}" {{ old('corporation_id') == $corporation->id ? 'selected' : '' }}>{{ $corporation->name }}</option>
              @endforeach
            </select>
            <div class="invalid-feedback">@error('corporation_id') {{ $message }} @else Please select a corporation. @enderror</div>
          </div>

          <div class="col-md-6">
            <label class="form-label">Corporation Name (Kannada)</label>
            <input type="text" class="form-control readonly-box" id="corporationKan" readonly>
          </div>

          <div class="col-md-6">
            <label class="form-label">Select Zone <span class="text-danger">*</span></label>
            <select class="form-select @error('zone_id') is-invalid @enderror" name="zone_id" id="zoneSelect" required>
              <option value="">Choose Zone</option>
              @foreach($zones as $zone)
              <option value="{{ $zone->id }}" data-kan="{{ $zone->name_kn }}" data-corporation="{{ $zone->corporation_id }}" {{ old('zone_id') == $zone->id ? 'selected' : '' }}>{{ $zone->name }}</option>
              @endforeach
            </select>
            <div class="invalid-feedback">@error('zone_id') {{ $message }} @else Please select a zone. @enderror</div>
          </div>

          <div class="col-md-6">
            <label class="form-label">Zone Name (Kannada)</label>
            <input type="text" class="form-control readonly-box" id="zoneKan" readonly>
          </div>

          <div class="col-md-6">
            <label class="form-label">Constituency Name (English) <span class="text-danger">*</span></label>
            <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" id="constituencyEng" placeholder="Enter Constituency Name in English" required>
            <div class="invalid-feedback">@error('name') {{ $message }} @else Please enter constituency name in English. @enderror</div>
          </div>

          <div class="col-md-6">
            <label class="form-label">Constituency Name (Kannada)</label>
            <input type="text" name="name_kn" value="{{ old('name_kn') }}" class="form-control @error('name_kn') is-invalid @enderror" id="constituencyKan" placeholder="Enter Constituency Name in Kannada">
            @error('name_kn')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="col-12 text-center mt-4">
            <button type="submit" class="btn btn-submit">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
@endsection

@section('script')
  <script>
    function syncLocationFields() {
      const corporation = document.getElementById("corporationSelect");
      const zone = document.getElementById("zoneSelect");
      const corporationId = corporation.value;

      document.getElementById("corporationKan").value = corporation.options[corporation.selectedIndex]?.getAttribute("data-kan") || "";

      [...zone.options].forEach((option) => {
        if (!option.value) return;
        option.hidden = corporationId && option.getAttribute("data-corporation") !== corporationId;
      });

      const selectedZone = zone.options[zone.selectedIndex];
      if (selectedZone && selectedZone.hidden) {
        zone.value = "";
      }

      document.getElementById("zoneKan").value = zone.options[zone.selectedIndex]?.getAttribute("data-kan") || "";
    }

    document.getElementById("corporationSelect").addEventListener("change", syncLocationFields);
    document.getElementById("zoneSelect").addEventListener("change", syncLocationFields);
    syncLocationFields();

    (() => {
      'use strict';
      const form = document.getElementById('constituencyForm');
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
          form.classList.add('was-validated');
        }
      }, false);
    })();
  </script>
@endsection
