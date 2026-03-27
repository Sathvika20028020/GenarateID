@extends('admin.layouts.app')
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
      <form id="constituencyForm" class="needs-validation" novalidate>
        <div class="row g-4">

          <!-- Select Corporation -->
          <div class="col-md-6">
            <label class="form-label">Select Corporation</label>
            <select class="form-select" id="corporation" required>
              <option value="">Choose Corporation</option>
              <option value="Bangalore Development Authority" data-kan="ಬೆಂಗಳೂರು ಅಭಿವೃದ್ಧಿ ಪ್ರಾಧಿಕಾರ">
                Bangalore Development Authority
              </option>
              <option value="Bruhat Bengaluru Mahanagara Palike" data-kan="ಬೃಹತ್ ಬೆಂಗಳೂರು ಮಹಾನಗರ ಪಾಲಿಕೆ">
                Bruhat Bengaluru Mahanagara Palike
              </option>
              <option value="Karnataka Urban Water Supply" data-kan="ಕರ್ನಾಟಕ ನಗರ ಜಲ ಸರಬರಾಜು">
                Karnataka Urban Water Supply
              </option>
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
            <select class="form-select" id="zone" required>
              <option value="">Choose Zone</option>
              <option value="South Zone" data-kan="ದಕ್ಷಿಣ ವಲಯ">South Zone</option>
              <option value="East Zone" data-kan="ಪೂರ್ವ ವಲಯ">East Zone</option>
              <option value="West Zone" data-kan="ಪಶ್ಚಿಮ ವಲಯ">West Zone</option>
              <option value="North Zone" data-kan="ಉತ್ತರ ವಲಯ">North Zone</option>
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
            <input type="text" class="form-control" id="constituencyEng" placeholder="Enter Constituency Name in English" required>
            <div class="invalid-feedback">Please enter constituency name in English.</div>
          </div>

          <!-- Constituency Kannada -->
          <div class="col-md-6">
            <label class="form-label">Constituency Name (Kannada)</label>
            <input type="text" class="form-control" id="constituencyKan" placeholder="Enter Constituency Name in Kannada" required>
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
    document.getElementById("corporation").addEventListener("change", function () {
      const selected = this.options[this.selectedIndex];
      document.getElementById("corporationKan").value = selected.getAttribute("data-kan") || "";
    });

    document.getElementById("zone").addEventListener("change", function () {
      const selected = this.options[this.selectedIndex];
      document.getElementById("zoneKan").value = selected.getAttribute("data-kan") || "";
    });

    // Bootstrap validation + SweetAlert + Refresh
    (() => {
      'use strict';

      const form = document.getElementById('constituencyForm');

      form.addEventListener('submit', function (event) {
        event.preventDefault();
        event.stopPropagation();

        if (!form.checkValidity()) {
          form.classList.add('was-validated');
          return;
        }

        // Success alert
        Swal.fire({
          icon: 'success',
          title: 'Submitted Successfully!',
          text: 'Your constituency details have been saved.',
          confirmButtonColor: '#6c63ff',
          confirmButtonText: 'OK'
        }).then((result) => {
          if (result.isConfirmed) {
            // Refresh page after OK
            location.reload();
          }
        });
      }, false);
    })();
  </script>
@endsection