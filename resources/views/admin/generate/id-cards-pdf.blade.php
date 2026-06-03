<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>ID Cards</title>
    @include('admin.generate.partials.id-card-styles')
    <style>
        @page {
            margin: 0;
        }

        body {
            margin: 0;
            padding: 0;
            background: #fff;
            font-family: Arial, sans-serif;
        }

        .cards-grid {
            width: 100%;
        }

        .id-card-page {
            margin: 0;
            padding: 0;
            page-break-inside: avoid;
        }

        .id-card {
            margin: 0 auto;
            box-shadow: none;
            box-sizing: border-box;
        }

        @media print {
            .print-actions {
                display: none;
            }
        }
    </style>
</head>
<body class="{{ !empty($pdfMode) ? 'pdf-mode' : '' }}" @if(!empty($printMode)) onload="window.print()" @endif>
    @if(!empty($printMode))
        <div class="print-actions" style="margin-bottom:16px;text-align:right;">
            <button onclick="window.print()" style="background:#0d5ea6;color:white;border:0;padding:8px 16px;border-radius:6px;">Print / Save PDF</button>
        </div>
    @endif

    <div class="cards-grid">
        @foreach($employees as $employee)
            <div class="id-card-page" @if(!$loop->last) style="page-break-after: always;" @endif>
                @include('admin.generate.partials.id-card', ['employee' => $employee, 'pdfMode' => $pdfMode ?? false])
            </div>
        @endforeach
    </div>
</body>
</html>
