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

    .btn-update {
      background: linear-gradient(to right, #5f5ce6, #6c63ff);
      color: white;
      border: none;
      padding: 10px 30px;
      border-radius: 12px;
      font-weight: 600;
      min-width: 140px;
    }

    .btn-update:hover {
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
                  <h3>Edit Constituency</h3>
              </div>
              <div class="col-12 col-sm-6">
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="index.html">
                              <i data-feather="home"></i></a></li>

                      <li class="breadcrumb-item active">Edit Constituency</li>
                  </ol>
              </div>
          </div>
      </div>
  </div>
  <!-- Container-fluid starts-->
   <div class="container-fluid">
    <div class="form-section">
      

      <form id="editForm" class="needs-validation" novalidate>
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

          <!-- Hidden ID -->
          <input type="hidden" id="recordId" value="1">

          <!-- Update Button -->
          <div class="col-12 text-center mt-4">
            <button type="submit" class="btn btn-update">Update</button>
          </div>

        </div>
      </form>
    </div>
  </div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    
    const existingData = {
      id: 1,
      corporation: "Bruhat Bengaluru Mahanagara Palike",
      zone: "East Zone",
      constituencyEng: "Mahadevapura",
      constituencyKan: "ಮಹದೇವಪುರ"
    };

    // Auto-fill Kannada fields
    function updateCorporationKan() {
      const selected = document.getElementById("corporation");
      const kan = selected.options[selected.selectedIndex]?.getAttribute("data-kan") || "";
      document.getElementById("corporationKan").value = kan;
    }

    function updateZoneKan() {
      const selected = document.getElementById("zone");
      const kan = selected.options[selected.selectedIndex]?.getAttribute("data-kan") || "";
      document.getElementById("zoneKan").value = kan;
    }

    document.getElementById("corporation").addEventListener("change", updateCorporationKan);
    document.getElementById("zone").addEventListener("change", updateZoneKan);

    // Pre-fill edit data
    window.onload = function () {
      document.getElementById("recordId").value = existingData.id;
      document.getElementById("corporation").value = existingData.corporation;
      document.getElementById("zone").value = existingData.zone;
      document.getElementById("constituencyEng").value = existingData.constituencyEng;
      document.getElementById("constituencyKan").value = existingData.constituencyKan;

      updateCorporationKan();
      updateZoneKan();
    };

    // Validation + SweetAlert + Refresh
    (() => {
      'use strict';

      const form = document.getElementById('editForm');

      form.addEventListener('submit', function (event) {
        event.preventDefault();
        event.stopPropagation();

        if (!form.checkValidity()) {
          form.classList.add('was-validated');
          return;
        }

        // Here you can send updated data to backend
        const updatedData = {
          id: document.getElementById("recordId").value,
          corporation: document.getElementById("corporation").value,
          corporationKan: document.getElementById("corporationKan").value,
          zone: document.getElementById("zone").value,
          zoneKan: document.getElementById("zoneKan").value,
          constituencyEng: document.getElementById("constituencyEng").value,
          constituencyKan: document.getElementById("constituencyKan").value
        };

        console.log("Updated Data:", updatedData);

        Swal.fire({
          icon: 'success',
          title: 'Updated Successfully!',
          text: 'Constituency details have been updated.',
          confirmButtonColor: '#6c63ff',
          confirmButtonText: 'OK'
        }).then((result) => {
          if (result.isConfirmed) {
            location.reload(); 
            // OR window.location.href = "list-page.html";
          }
        });
      }, false);
    })();
  </script>
@endsection