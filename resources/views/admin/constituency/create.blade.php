@extends('admin.layout.app')
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
@section('content')
  <div class="container-fluid">
      <div class="page-title">
          <div class="row">
              <div class="col-12 col-sm-6">
                  <h3>Create Constituency</h3>
              </div>
              <div class="col-12 col-sm-6">
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="index.html">
                              <i data-feather="home"></i></a></li>

                      <li class="breadcrumb-item active">Create Constituency</li>
                  </ol>
              </div>
          </div>
      </div>
  </div>
  <!-- Container-fluid starts-->
 <div class="container-fluid">
    <div class="form-section">
      <form id="constituencyForm" class="needs-validation" novalidate action="{{ route('constituency.store') }}" method="post">
                          @csrf
        <div class="row g-4">

          <!-- Select Corporation -->
          <div class="col-md-6">
            <label class="form-label">Select Corporation</label>
            <select class="form-select" id="corporationSelect" name="corporation_id" required>
              <option value="">Choose Corporation</option>
              @foreach($corporations as $corporation)
              <option value="{{$corporation->id}}" data-kan="{{$corporation->name_kn}}">{{$corporation->name}}</option>
              @endforeach
            </select>
            <div class="invalid-feedback">Please select a corporation.</div>
          </div>

          <!-- Corporation Kannada -->
          <div class="col-md-6">
            <label class="form-label">Corporation Name (Kannada)</label>
            <input type="text" class="form-control readonly-box" id="corporationKan" readonly>
          </div>

          <!-- Select Zone -->
          <div class="col-md-6">
            <label class="form-label">Select Zone</label>
            <select class="form-select" name="zone_id" id="zoneSelect" required>
              <option value="">Choose Zone</option>
            </select>
            <div class="invalid-feedback">Please select a zone.</div>
          </div>

          <!-- Zone Kannada -->
          <div class="col-md-6">
            <label class="form-label">Zone Name (Kannada)</label>
            <input type="text" class="form-control readonly-box" id="zoneKan" readonly>
          </div>

          <!-- Constituency English -->
          <div class="col-md-6">
            <label class="form-label">Constituency Name (English)</label>
            <input type="text" name="name" class="form-control" id="constituencyEng" placeholder="Enter Constituency Name in English" required>
            <div class="invalid-feedback">Please enter constituency name in English.</div>
          </div>

          <!-- Constituency Kannada -->
          <div class="col-md-6">
            <label class="form-label">Constituency Name (Kannada)</label>
            <input type="text" name="name_kn" class="form-control" id="constituencyKan" placeholder="Enter Constituency Name in Kannada" required>
            <div class="invalid-feedback">Please enter constituency name in Kannada.</div>
          </div>

          <!-- Submit -->
          <div class="col-12 text-center mt-4">
            <button type="submit" class="btn btn-submit">Submit</button>
          </div>

        </div>
      </form>
    </div>
  </div>
@endsection

@section('script')
  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    // Auto-fill Kannada fields
    document.getElementById("corporationSelect").addEventListener("change", function () {
      const selected = this.options[this.selectedIndex];
      document.getElementById("corporationKan").value = selected.getAttribute("data-kan") || "";
      const selectedValue = this.value;
      $.ajax({
        method: "POST",
        url: "{{ route('ward.store') }}",
        data: {_token: "{{csrf_token()}}", id: selectedValue, list: 'zones'}, 
      })
      .done(function (res) {
        if(res.success){
          var options = '';
          $.each(res.list, function(key, value){
              options += '<option value="' + value.id + '" data-kan="' + (value.name_kn??'') + '">' + value.name + '</option>';
          });
          options = '<option value="">Choose Zone</option>' + options;
          
          $('#zoneSelect').html(options);
        }
      })
      .fail(function (err) {
        console.log(err);              
      });
    });

    document.getElementById("zoneSelect").addEventListener("change", function () {
      const selected = this.options[this.selectedIndex];
      document.getElementById("zoneKan").value = selected.getAttribute("data-kan") || "";
    });

    // Bootstrap validation + SweetAlert + Refresh
    (() => {
      'use strict';

      const form = document.getElementById('constituencyForm');

      form.addEventListener('submit', function (event) {

        if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
          form.classList.add('was-validated');
          return;
        }else form.submit(); vdrdv

        // Success alert
        // Swal.fire({vchtdrrdrdgr cvdrerde´˳
        //   icon: 'success',
        //   title: 'Submitted Successfully!',
        //   text: 'Your constituency details have been saved.',
        //   confirmButtonColor: '#6c63ff',
        //   confirmButtonText: 'OK'
        // }).then((result) => {
        //   if (result.isConfirmed) {
        //     // Refresh page after OK
        //     location.reload();
        //   }
        // });
      }, false);
    })();
  </script>

  <script>

         const zoneMap = {
            @foreach($zones as $zone)
              "{{$zone->id}}": "{{$zone->name_kn}}",
            @endforeach
        };

        document.getElementById("zoneSelect").addEventListener("change", function () {
            const selectedValue = this.value;
            const kannadaInput = document.getElementById("Zone_name_kn");

            if (zoneMap[selectedValue]) {
                kannadaInput.value = zoneMap[selectedValue];
            } else {
                kannadaInput.value = "";
            }
        });
    </script>
@endsection