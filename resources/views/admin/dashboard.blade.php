@extends('admin.layout.app')
@section('title') Dashboard @endsection
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
    </style>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row d-flex justify-content-end">
                <div class="col-12 col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a class="home-item" href="">
                                <i data-feather="home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item"> Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid general-widget">
        <div class="row mb-4 align-items-end">
            <!-- Corporation -->
            <div class="col-md-4">
                <label class="form-label fw-bold">Corporation</label>
                <select class="form-select filter-select" id="corporationSelect">
                    <option value="">All Corporations</option>
                    @foreach($corporations as $corp)
                        <option value="{{ $corp->id }}">{{ $corp->name }}</option>
                    @endforeach
                </select>
            </div>
            <!-- Zone -->
            <div class="col-md-4">
                <label class="form-label fw-bold">Zone</label>
                <select class="form-select filter-select" id="zoneSelect">
                    <option value="">All Zones</option>
                </select>
            </div>
            <!-- Ward -->
            <div class="col-md-4">
                <label class="form-label fw-bold">Ward</label>
                <select class="form-select filter-select" id="wardSelect">
                    <option value="">All Wards</option>
                </select>
            </div>
        </div>
        <div class="row" id="statsWidgets">
            <!-- Dynamic widget cards will load here via AJAX -->
        </div>
        <!-- Container-fluid Ends-->
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            function loadStats() {
                let corpId = $('#corporationSelect').val();
                let zoneId = $('#zoneSelect').val();
                let wardId = $('#wardSelect').val();

                $('#statsWidgets').html(`
                    <div class="col-12 text-center my-5">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                `);

                $.ajax({
                    url: "{{ route('dashboard') }}",
                    type: 'GET',
                    data: {
                        corporation_id: corpId,
                        zone_id: zoneId,
                        ward_id: wardId
                    },
                    success: function(data) {
                        let html = '';
                        
                        // Total ID Cards Card
                        html += `
                        <div class="col-sm-3 col-xl-3 col-lg-3">
                            <div class="card o-hidden border shadow-sm">
                                <div class="card-body">
                                    <div class="media static-widget">
                                        <div class="media-body">
                                            <h6 class="font-roboto fw-bold text-muted">Total ID Cards</h6>
                                            <h3 class="mb-0 counter fw-bold">${data.total_employees}</h3>
                                        </div>
                                        <div class="align-self-center text-center">
                                            <i class="bi bi-person-badge-fill fs-1 text-primary"></i>
                                        </div>
                                    </div>
                                    <div class="progress-widget">
                                        <div class="progress sm-progress-bar progress-animate">
                                            <div class="progress-gradient-primary" role="progressbar" style="width: 100%"
                                                aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                                <span class="animate-circle"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>`;

                        // Designation Cards
                        let colors = ['#9ace3e', '#7366ff', '#dc3545', '#ff7f50', '#28a745', '#007bff'];
                        let icons = ['bi-person-workspace', 'bi-briefcase-fill', 'bi-person-gear', 'bi-award-fill'];
                        let gradients = ['success', 'primary', 'danger', 'warning', 'info', 'dark'];
                        
                        data.designations.forEach((desig, index) => {
                            let color = colors[index % colors.length];
                            let icon = icons[index % icons.length];
                            let grad = gradients[index % gradients.length];
                            html += `
                            <div class="col-sm-3 col-xl-3 col-lg-3">
                                <div class="card o-hidden border shadow-sm">
                                    <div class="card-body">
                                        <div class="media static-widget">
                                            <div class="media-body">
                                                <h6 class="font-roboto fw-bold text-muted">${desig.name}</h6>
                                                <h3 class="mb-0 counter fw-bold">${desig.count}</h3>
                                            </div>
                                            <div class="align-self-center text-center">
                                                <i class="bi ${icon} fs-1" style="color: ${color};"></i>
                                            </div>
                                        </div>
                                        <div class="progress-widget">
                                            <div class="progress sm-progress-bar progress-animate">
                                                <div class="progress-gradient-${grad}" role="progressbar" style="width: 100%"
                                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                                    <span class="animate-circle"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                        });

                        // Breakdown Section
                        if (data.breakdown && data.breakdown.length > 0) {
                            let heading = data.breakdown_type === 'wards' ? 'Ward-wise Breakdown' : 'Zone-wise Breakdown';
                            html += `
                            <div class="col-12 mt-4 mb-3">
                                <h5 class="fw-bold border-bottom pb-2 text-dark d-flex align-items-center gap-2">
                                    <i class="bi bi-geo-alt-fill text-danger"></i> ${heading}
                                </h5>
                            </div>`;
                            
                            data.breakdown.forEach((item, index) => {
                                let color = colors[(index + 2) % colors.length];
                                let grad = gradients[(index + 2) % gradients.length];
                                html += `
                                <div class="col-sm-3 col-xl-3 col-lg-3">
                                    <div class="card o-hidden border shadow-sm">
                                        <div class="card-body">
                                            <div class="media static-widget">
                                                <div class="media-body">
                                                    <h6 class="font-roboto fw-bold text-muted text-truncate" title="${item.name}">${item.name}</h6>
                                                    <h3 class="mb-0 counter fw-bold">${item.count}</h3>
                                                </div>
                                                <div class="align-self-center text-center">
                                                    <i class="bi bi-map fs-1" style="color: ${color};"></i>
                                                </div>
                                            </div>
                                            <div class="progress-widget">
                                                <div class="progress sm-progress-bar progress-animate">
                                                    <div class="progress-gradient-${grad}" role="progressbar" style="width: 100%"
                                                        aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="animate-circle"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
                            });
                        } else {
                            html += `
                            <div class="col-12 mt-4 text-center">
                                <div class="alert alert-light border text-muted py-4 shadow-sm">
                                    <i class="bi bi-info-circle fs-3 d-block mb-2 text-secondary"></i>
                                    No records found matching the selected filters.
                                </div>
                            </div>`;
                        }

                        $('#statsWidgets').html(html);
                    },
                    error: function() {
                        $('#statsWidgets').html(`
                            <div class="col-12 text-center my-5">
                                <div class="alert alert-danger d-inline-block" role="alert">
                                    Failed to retrieve dashboard statistics. Please try refreshing.
                                </div>
                            </div>
                        `);
                    }
                });
            }

            // Cascade dropdowns
            $('#corporationSelect').change(function() {
                let corpId = $(this).val();
                $('#zoneSelect').html('<option value="">Loading Zones...</option>');
                $('#wardSelect').html('<option value="">All Wards</option>');

                $.ajax({
                    url: "{{ route('dashboard') }}",
                    type: 'GET',
                    data: {
                        get_type: 'zones',
                        corporation_id: corpId
                    },
                    success: function(zones) {
                        let html = '<option value="">All Zones</option>';
                        zones.forEach(zone => {
                            html += `<option value="${zone.id}">${zone.name}</option>`;
                        });
                        $('#zoneSelect').html(html);
                        loadStats();
                    }
                });
            });

            $('#zoneSelect').change(function() {
                let zoneId = $(this).val();
                $('#wardSelect').html('<option value="">Loading Wards...</option>');

                $.ajax({
                    url: "{{ route('dashboard') }}",
                    type: 'GET',
                    data: {
                        get_type: 'wards',
                        zone_id: zoneId
                    },
                    success: function(wards) {
                        let html = '<option value="">All Wards</option>';
                        wards.forEach(ward => {
                            let displayName = ward.name + (ward.number ? ` (Ward ${ward.number})` : '');
                            html += `<option value="${ward.id}">${displayName}</option>`;
                        });
                        $('#wardSelect').html(html);
                        loadStats();
                    }
                });
            });

            $('#wardSelect').change(function() {
                loadStats();
            });

            // Initial load
            // Populates zones first
            $.ajax({
                url: "{{ route('dashboard') }}",
                type: 'GET',
                data: {
                    get_type: 'zones',
                    corporation_id: $('#corporationSelect').val()
                },
                success: function(zones) {
                    let html = '<option value="">All Zones</option>';
                    zones.forEach(zone => {
                        html += `<option value="${zone.id}">${zone.name}</option>`;
                    });
                    $('#zoneSelect').html(html);
                    loadStats();
                }
            });
        });
    </script>
@endsection