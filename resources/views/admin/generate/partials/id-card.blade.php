@php
    $isPdfMode = !empty($pdfMode);

    $assetPath = function (string $path) use ($isPdfMode) {
        return $isPdfMode ? public_path($path) : asset($path);
    };

    $photo = $employee->image
        ? ($isPdfMode ? public_path($employee->image) : asset($employee->image))
        : $assetPath('theme/images/leader2.jpg');

    $issuedDate = optional($employee->created_at)->format('d/m/Y') ?? now()->format('d/m/Y');
    $validUpto = $employee->valid_upto ? \Illuminate\Support\Carbon::parse($employee->valid_upto)->format('d/m/Y') : '-';
    $qrData = route('generate-id.show', $employee);
    $qrSvg = QrCode::size(50)->margin(0)->generate($qrData);
    $qrImage = 'data:image/svg+xml;base64,'.base64_encode($qrSvg);
@endphp

<div class="id-card">
    <div class="top-header">
        <img src="{{ $assetPath('theme/images/logoicon2.png') }}" class="logo-left" alt="Logo Left">
        <img src="{{ $assetPath('theme/images/logoicon1.png') }}" class="logo-right" alt="Logo Right">

        <h1>Bengaluru West City Corporation</h1>
        <h2>Greater Bengaluru Authority</h2>
    </div>

    <div class="photo-box">
        <img src="{{ $photo }}" alt="Employee Photo">
    </div>

    <div class="details">
        <div class="detail-row">
            <div class="label">Name :</div>
            <div class="value">{{ $employee->name }}</div>
        </div>

        <div class="detail-row">
            <div class="label">Designation :</div>
            <div class="value">{{ $employee->designation?->name ?? '-' }}</div>
        </div>

        <div class="detail-row">
            <div class="label">Employee No :</div>
            <div class="value">{{ $employee->emp_id ?? '-' }}</div>
        </div>

        <div class="detail-row">
            <div class="label">Blood Group :</div>
            <div class="value">{{ $employee->blood_group ?? '-' }}</div>
        </div>

        <div class="detail-row">
            <div class="label">Phone :</div>
            <div class="value">{{ $employee->phone ?? '-' }}</div>
        </div>

        <div class="detail-row">
            <div class="label">Home Address :</div>
            <div class="value">{{ $employee->address ?? '-' }}</div>
        </div>
    </div>

    <div class="dates">
        <div class="detail-row">
            <div class="label">Date of Issued :</div>
            <div class="value">{{ $issuedDate }}</div>
        </div>

        <div class="detail-row">
            <div class="label">Valid Upto :</div>
            <div class="value">{{ $validUpto }}</div>
        </div>
    </div>

    <div class="bottom-section">
        <div class="qr-box">
            <img src="{{ $qrImage }}" alt="QR Code">
        </div>

        <div class="signature">
            Authorised Signature
        </div>
    </div>
</div>
