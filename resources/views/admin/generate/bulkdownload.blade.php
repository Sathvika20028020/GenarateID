@extends('admin.layout.app')

@section('title')
    Dashboard
@endsection

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

    /* =========================
        ID CARD DESIGN
    ========================== */

   .id-card {
    width: 100%;
    max-width: 420px;
    height: 650px;   /* FIXED HEIGHT */
    background: #f2f2f2;
    border-radius: 12px;
    padding: 10px;
    position: relative;
    border: 2px solid #111;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    overflow: hidden;
    margin: auto;
}

    .top-header {
        text-align: center;
        position: relative;
        padding-bottom: 0px;
        border-bottom: 2px solid #111;
    }

    .top-header h1 {
        font-size: 12px;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .top-header h2 {
        font-size: 11px;
        font-weight: normal;
        color: #333;
    }

    .logo-left,
    .logo-right {
        width: 40px;
        height: 40px;
        border-radius: 56%;
        position: absolute;
        top: 0;
        object-fit: contain;
        background: white;
        border: 2px solid #ccc;
        padding: 3px;
    }

    .logo-left {
        left: 0;
    }

    .logo-right {
        right: 0;
    }

    .photo-box {
        width: 130px;
        height: 148px;
        margin: 30px auto;
        border: 3px solid #222;
        border-radius: 15px;
        overflow: hidden;
        background: white;
    }

    .photo-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .details {
        margin-top: 10px;
        padding: 0 10px;
    }

    .detail-row {
        display: flex;
        margin-bottom: 12px;
        font-size: 17px;
    }

    .label {
        width: 130px;
        font-weight: bold;
        font-size: 14px;
        color: #333;
    }

    .value {
        flex: 1;
        font-size: 14px;
        color: #333;
    }

    .dates {
        margin-top: 35px;
        padding: 0 10px;
    }

    .dates .detail-row {
        font-size: 16px;
    }

    .bottom-section {
        margin-top: 35px;
        border-top: 2px solid #111;
        /* padding-top: 20px; */
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
    }

    .qr-box img {
        width: 50px;
        height: 50px;
    }

    .signature {
        text-align: center;
        font-size: 14px;
        font-weight: 500;
    }

    @media(max-width:768px){

        .id-card{
            margin-bottom:20px;
        }

        .top-header h1{
            font-size:18px;
        }

        .detail-row{
            font-size:14px;
        }

        .label{
            width:120px;
        }
    }
.details {
    margin-top: 5px;
    padding: 0 10px;
    min-height: 220px;
}

.dates {
    margin-top: 5px;
    padding: 0 10px;
}

.bottom-section {
    position: absolute;
    bottom: 20px;
    left: 20px;
    right: 20px;
    border-top: 2px solid #111;
    padding-top: 15px;
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
}
</style>
@endsection

@section('content')

<div class="container-fluid">

    <!-- PAGE TITLE -->
    <div class="page-title">
        <div class="row d-flex justify-content-end">
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a class="home-item" href="">
                            <i data-feather="home"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        Dashboard
                    </li>
                </ol>
            </div>
        </div>
    </div>

</div>

<!-- FILTER SECTION -->
<div class="container-fluid general-widget">

    <div class="row mb-4 align-items-end">

        <!-- Department -->
        <div class="col-md-4">
            <select class="form-select filter-select" id="zoneSelect">
                <option value="all">Select Department</option>
                <option value="west">West Zone</option>
                <option value="east">East Zone</option>
                <option value="south">South Zone</option>
                <option value="north">North Zone</option>
                <option value="mahadevapura">Mahadevapura</option>
            </select>
        </div>

        <!-- Designation -->
        <div class="col-md-4">
            <select class="form-select filter-select" id="wardSelect">
                <option value="all">Select Designation</option>
                <option value="1">Designation 1</option>
                <option value="2">Designation 2</option>
                <option value="3">Designation 3</option>
                <option value="4">Designation 4</option>
                <option value="5">Designation 5</option>
            </select>
        </div>

        <!-- Download -->
        <div class="col-md-4">
            <a href="#" class="btn" style="background-color:#0d5ea6;color:white;">
                <i class="bi bi-download"></i> Download
            </a>
        </div>

    </div>

</div>

<!-- ID CARD SECTION -->
<div class="container mt-5">

    <div class="row g-4">

        <!-- CARD 1 -->
        <div class="col-lg-4 col-md-6">

            <div class="id-card">

                <div class="top-header">

                    <img src="../theme/images/logoicon2.png"
                         class="logo-left"
                         alt="Logo Left">

                    <img src="../theme/images/logoicon1.png"
                         class="logo-right"
                         alt="Logo Right">

                    <h1>Bengaluru West City Corporation</h1>
                    <h2>Greater Bengaluru Authority</h2>

                </div>

                <div class="photo-box">
                    <img src="../theme/images/leader2.jpg"
                         alt="Employee Photo">
                </div>

                <div class="details">

                    <div class="detail-row">
                        <div class="label">Name :</div>
                        <div class="value">John Doe</div>
                    </div>

                    <div class="detail-row">
                        <div class="label">Designation :</div>
                        <div class="value">Manager</div>
                    </div>

                    <div class="detail-row">
                        <div class="label">Employee No :</div>
                        <div class="value">BWCC1024</div>
                    </div>

                    <div class="detail-row">
                        <div class="label">Blood Group :</div>
                        <div class="value">O+</div>
                    </div>

                    <div class="detail-row">
                        <div class="label">Phone :</div>
                        <div class="value">9876543210</div>
                    </div>

                    <div class="detail-row">
                        <div class="label">Home Address :</div>
                        <div class="value">Bengaluru, Karnataka</div>
                    </div>

                </div>

                <div class="dates">

                    <div class="detail-row">
                        <div class="label">Date of Issued :</div>
                        <div class="value">01/01/2025</div>
                    </div>

                    <div class="detail-row">
                        <div class="label">Valid Upto :</div>
                        <div class="value">31/12/2026</div>
                    </div>

                </div>

                <div class="bottom-section">

                    <div class="qr-box">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=100x100&data=BWCC-ID"
                             alt="QR Code">
                    </div>

                    <div class="signature">
                        Authorised Signature
                    </div>

                </div>

            </div>

        </div>

        <!-- CARD 2 -->
        <div class="col-lg-4 col-md-6">

            <div class="id-card">

                <div class="top-header">

                    <img src="../theme/images/logoicon2.png"
                         class="logo-left"
                         alt="Logo Left">

                    <img src="../theme/images/logoicon1.png"
                         class="logo-right"
                         alt="Logo Right">

                    <h1>Bengaluru West City Corporation</h1>
                    <h2>Greater Bengaluru Authority</h2>

                </div>

                <div class="photo-box">
                    <img src="../theme/images/leader2.jpg"
                         alt="Employee Photo">
                </div>

                <div class="details">

                    <div class="detail-row">
                        <div class="label">Name :</div>
                        <div class="value">Ravi Kumar</div>
                    </div>

                    <div class="detail-row">
                        <div class="label">Designation :</div>
                        <div class="value">Supervisor</div>
                    </div>

                    <div class="detail-row">
                        <div class="label">Employee No :</div>
                        <div class="value">BWCC1055</div>
                    </div>

                    <div class="detail-row">
                        <div class="label">Blood Group :</div>
                        <div class="value">B+</div>
                    </div>

                    <div class="detail-row">
                        <div class="label">Phone :</div>
                        <div class="value">9988776655</div>
                    </div>

                    <div class="detail-row">
                        <div class="label">Home Address :</div>
                        <div class="value">Mysore Road, Bengaluru</div>
                    </div>

                </div>

                <div class="dates">

                    <div class="detail-row">
                        <div class="label">Date of Issued :</div>
                        <div class="value">05/02/2025</div>
                    </div>

                    <div class="detail-row">
                        <div class="label">Valid Upto :</div>
                        <div class="value">05/02/2026</div>
                    </div>

                </div>

                <div class="bottom-section">

                    <div class="qr-box">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=100x100&data=BWCC-ID2"
                             alt="QR Code">
                    </div>

                    <div class="signature">
                        Authorised Signature
                    </div>

                </div>

            </div>

        </div>

        <!-- CARD 3 -->
        <div class="col-lg-4 col-md-6">

            <div class="id-card">

                <div class="top-header">

                    <img src="../theme/images/logoicon2.png"
                         class="logo-left"
                         alt="Logo Left">

                    <img src="../theme/images/logoicon1.png"
                         class="logo-right"
                         alt="Logo Right">

                    <h1>Bengaluru West City Corporation</h1>
                    <h2>Greater Bengaluru Authority</h2>

                </div>

                <div class="photo-box">
                    <img src="../theme/images/leader2.jpg"
                         alt="Employee Photo">
                </div>

                <div class="details">

                    <div class="detail-row">
                        <div class="label fw-bold">Name :</div>
                        <div class="value">Suresh</div>
                    </div>

                    <div class="detail-row">
                        <div class="label fw-bold">Designation :</div>
                        <div class="value">Officer</div>
                    </div>

                    <div class="detail-row">
                        <div class="label">Employee No :</div>
                        <div class="value">BWCC1080</div>
                    </div>

                    <div class="detail-row">
                        <div class="label">Blood Group :</div>
                        <div class="value">A+</div>
                    </div>

                    <div class="detail-row">
                        <div class="label">Phone :</div>
                        <div class="value">8877665544</div>
                    </div>

                    <div class="detail-row">
                        <div class="label">Home Address :</div>
                        <div class="value">Rajajinagar, Bengaluru</div>
                    </div>

                </div>

                <div class="dates">

                    <div class="detail-row">
                        <div class="label">Date of Issued :</div>
                        <div class="value">10/03/2025</div>
                    </div>

                    <div class="detail-row">
                        <div class="label">Valid Upto :</div>
                        <div class="value">10/03/2026</div>
                    </div>

                </div>

                <div class="bottom-section">

                    <div class="qr-box">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=100x100&data=BWCC-ID3"
                             alt="QR Code">
                    </div>

                    <div class="signature">
                        Authorised Signature
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection

@section('script')
@endsection