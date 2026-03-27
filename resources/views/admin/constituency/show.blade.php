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
                  <h3>Show Constituency</h3>
              </div>
              <div class="col-12 col-sm-6">
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="index.html">
                              <i data-feather="home"></i></a></li>

                      <li class="breadcrumb-item active">Show Constituency</li>
                  </ol>
              </div>
          </div>
      </div>
  </div>
  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="card card-custom">
     

      <div class="card-body p-4">
        <div class="table-responsive">
          <table class="table table-bordered align-middle">
            <tbody>
              <tr>
                <th>Corporation Name (English)</th>
                <td>Bruhat Bengaluru Mahanagara Palike</td>
              </tr>
              <tr>
                <th>Corporation Name (Kannada)</th>
                <td>ಬೃಹತ್ ಬೆಂಗಳೂರು ಮಹಾನಗರ ಪಾಲಿಕೆ</td>
              </tr>
              <tr>
                <th>Zone Name (English)</th>
                <td>East Zone</td>
              </tr>
              <tr>
                <th>Zone Name (Kannada)</th>
                <td>ಪೂರ್ವ ವಲಯ</td>
              </tr>
              <tr>
                <th>Constituency Name (English)</th>
                <td>Mahadevapura</td>
              </tr>
              <tr>
                <th>Constituency Name (Kannada)</th>
                <td>ಮಹದೇವಪುರ</td>
              </tr>
              <tr>
                <th>Status</th>
                <td><span class="badge bg-success">Active</span></td>
              </tr>
            </tbody>
          </table>
        </div>

        
      </div>
    </div>
  </div>
@endsection

@section('script')

@endsection