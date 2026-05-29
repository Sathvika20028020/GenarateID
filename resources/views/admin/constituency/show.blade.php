@extends('admin.layout.app')
@section('title') Show Constituency @endsection
@section('style')
<style>
    .form-section {
      background: #fff;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.05);
      margin-top: 40px;
    }
</style>
@endsection
@section('content')
  <div class="container-fluid">
      <div class="page-title">
          <div class="row">
              <div class="col-12 col-sm-6">
                  <h3>Show Constituency</h3>
              </div>
              <div class="col-12 col-sm-6">
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i data-feather="home"></i></a></li>
                      <li class="breadcrumb-item active">Show Constituency</li>
                  </ol>
              </div>
          </div>
      </div>
  </div>
  <div class="container-fluid">
    <div class="card card-custom">
      <div class="card-body p-4">
        <div class="table-responsive">
          <table class="table table-bordered align-middle">
            <tbody>
              <tr>
                <th>Corporation Name (English)</th>
                <td>{{ $constituency->corporation?->name ?? '-' }}</td>
              </tr>
              <tr>
                <th>Corporation Name (Kannada)</th>
                <td>{{ $constituency->corporation?->name_kn ?? '-' }}</td>
              </tr>
              <tr>
                <th>Zone Name (English)</th>
                <td>{{ $constituency->zone?->name ?? '-' }}</td>
              </tr>
              <tr>
                <th>Zone Name (Kannada)</th>
                <td>{{ $constituency->zone?->name_kn ?? '-' }}</td>
              </tr>
              <tr>
                <th>Constituency Name (English)</th>
                <td>{{ $constituency->name }}</td>
              </tr>
              <tr>
                <th>Constituency Name (Kannada)</th>
                <td>{{ $constituency->name_kn ?? '-' }}</td>
              </tr>
              <tr>
                <th>Status</th>
                <td><span class="badge bg-{{ $constituency->status ? 'success' : 'danger' }}">{{ $constituency->status ? 'Active' : 'Inactive' }}</span></td>
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
