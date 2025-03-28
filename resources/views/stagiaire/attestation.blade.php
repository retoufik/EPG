<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #000;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo {
            width: 120px;
            margin-bottom: 20px;
        }
        .title {
            font-size: 24px;
            font-weight: bold;
            color: #1e3a8a;
            margin: 20px 0;
        }
        .content {
            margin: 20px 0;
            background: #f8fafc;
            padding: 20px;
            border-radius: 5px;
        }
        .signature {
            display: flex;
            justify-content: space-between;
            margin-top: 50px;
        }
        .qr-code {
            text-align: center;
            margin-top: 30px;
            border-top: 2px solid #1e3a8a;
            padding-top: 20px;
        }
        .qr-code img {
            width: 100px;
            height: 100px;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('images/logo.png') }}" class="logo">
        <h1 class="title">École Polytechnique des Génies</h1>
        <h2>Attestation de Stage</h2>
    </div>

    <div class="content">
        <p>Je soussigné(e), certifie que :</p>
        
        <p><strong>Nom et Prénom:</strong> {{ $stagiaire->nom }} {{ $stagiaire->prenom }}</p>
        <p><strong>CIN:</strong> {{ $stagiaire->CIN }}</p>
        <p><strong>Période:</strong> Du {{ Carbon\Carbon::parse($stagiaire->debut)->format('d/m/Y') }} 
           au {{ Carbon\Carbon::parse($stagiaire->fin)->format('d/m/Y') }}</p>
        
        <p>a effectué un stage au sein de notre établissement portant sur :</p>
        <p><em>"{{ $stagiaire->details }}"</em></p>
    </div>

    <div class="signature">
        <div>
            <p>Le Directeur</p>
            <p>ALAE EDDINE LAZRAK</p>
        </div>
        <div>
            <p>Signature</p>
            <p>_____________</p>
        </div>
    </div>

    <div class="qr-code">
        {!! $qrcode !!}
    </div>
</body>
</html>