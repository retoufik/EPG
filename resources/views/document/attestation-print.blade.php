@php
    use Endroid\QrCode\QrCode;
    use Endroid\QrCode\Writer\PngWriter;
    use Carbon\Carbon;
    
    $endDate = Carbon::parse($stagiaire->fin);
    $currentDate = Carbon::now();
    $isButtonEnabled = $currentDate->greaterThanOrEqualTo($endDate);
@endphp
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @font-face {
            font-family: 'DejaVu Sans';
            font-style: normal;
            font-weight: normal;
            src: url('{{ $fontPath }}') format('truetype');
        }
        @page {
            size: 21cm 29.7cm;
            margin: 2cm;
        }
        
        body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 0;
            padding: 0;
            font-size: 12pt;
            line-height: 1.6;
        }
        
        .attestation-container {
            width: 21cm;
            min-height: 29.7cm;
            margin: 0 auto;
            background: white;
            position: relative;
            padding: 2cm;
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 3cm;
        }
        
        .logo {
            width: 120px;
            height: auto;
        }
        
        .title {
            font-size: 24pt;
            font-weight: bold;
            text-align: center;
            color: #1e3a8a;
            margin: 2cm 0;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        
        .content {
            text-align: justify;
            margin: 1cm 0;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1cm;
            margin: 1cm 0;
            padding: 1cm;
            background: #f8fafc;
            border-radius: 0.5cm;
        }
        
        .signature-section {
            display: flex;
            justify-content: space-between;
            margin-top: 3cm;
        }
        
        .signature-box {
            text-align: center;
            width: 33%;
        }
        
        .signature-line {
            width: 80%;
            margin: 1cm auto;
            border-top: 2px solid #1e3a8a;
            padding-top: 0.5cm;
        }
        
        .qr-section {
            text-align: center;
            margin-top: 2cm;
            padding-top: 1cm;
            border-top: 2px solid #1e3a8a;
        }
        
        .qr-code {
            display: inline-block;
            padding: 0.5cm;
            background: white;
            border: 2px solid #1e3a8a;
            border-radius: 0.25cm;
        }
        
        @media print {
            body {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            
            .no-print {
                display: none !important;
            }
        }
    </style>
</head>
<body class="bg-white">
    <div class="attestation-container">
        <div class="header">
            <img src="{{ public_path('images/logo.png') }}" class="logo">
            <h1 class="school-name">École Polytechnique des Génies</h1>
        </div>

        <h1 class="title">Attestation de Stage</h1>

        <div class="info-grid">
            <div>
                <p class="font-semibold">Nom et Prénom:</p>
                <p class="text-blue-900">{{ $stagiaire->nom }} {{ $stagiaire->prenom }}</p>
            </div>
            <div>
                <p class="font-semibold">Carte d'identité:</p>
                <p class="text-blue-900">{{ $stagiaire->CIN }}</p>
            </div>
            <div>
                <p class="font-semibold">Date de début:</p>
                <p class="text-blue-900">{{ Carbon::parse($stagiaire->debut)->locale('fr')->isoFormat('LL') }}</p>
            </div>
            <div>
                <p class="font-semibold">Date de fin:</p>
                <p class="text-blue-900">{{ Carbon::parse($stagiaire->fin)->locale('fr')->isoFormat('LL') }}</p>
            </div>
        </div>

        <div class="content">
            <p class="mb-4">Je soussigné(e),le Directeur de l'École Polytechnique des Génies, certifie que :</p>
            <p class="mb-4">a effectué un stage au sein de notre établissement dans le cadre de son projet de fin d'études portant sur :</p>
            <p class="text-orange-600 font-semibold italic">"{{ $stagiaire->details ?? '[Sujet du projet]' }}"</p>
        </div>

        <p class="mb-8 text-lg">Par la présente, nous attestons que 
            @if($stagiaire->genre == 'Homme')
                Monsieur
            @else
                Madame
            @endif
            <span class="font-bold text-blue-900">{{ $stagiaire->prenom }} {{ $stagiaire->nom }}</span> 
            a fait preuve d'un grand professionnalisme et d'une réelle implication dans les missions qui lui ont été confiées.
        </p>

        <div class="signature-section">
            <div class="signature-box">
                <p class="mb-8 text-blue-900">Le Directeur</p>
                <p class="signature-line">ALAE EDDINE LAZRAK</p>
            </div>
            
            <div class="signature-box">
                <p class="mb-8 text-blue-900">Signature</p>
                <p class="signature-line"></p>
            </div>
        </div>

        <div class="qr-section">
            @if($stagiaire->qrcode)
                <div class="qr-code">
                    <img src="data:image/png;base64,{{ base64_encode($stagiaire->qrcode) }}" alt="QR Code">
                </div>
            @endif
        </div>
    </div>
</body>
</html>