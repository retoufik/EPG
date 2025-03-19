@php
    use Endroid\QrCode\QrCode;
    use Endroid\QrCode\Writer\PngWriter;
@endphp
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <style>
        @font-face {
            font-family: 'DejaVu Sans';
            font-style: normal;
            font-weight: normal;
            src: url({{ storage_path('fonts/DejaVuSans.ttf') }}) format('truetype');
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            line-height: 1.6;
            margin: 2cm;
            text-align: center;
        }

        .certificate-border {
            border: 3px solid #000;
            padding: 2cm;
            min-height: 21cm;
        }

        .signature-section {
            margin-top: 3cm;
            display: flex;
            justify-content: space-around;
        }

        .qrcode {
            margin-top: 1.5cm;
            text-align: center;
        }
        
        .qrcode img {
            width: 150px;
            height: 150px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="certificate-border">
        <h1>CERTIFICAT DE RECONNAISSANCE</h1>
        
        <div style="margin: 2cm 0;">
            <p>Ce certificat est remis à</p>
            <h2>{{ $stagiaire->prenom }} {{ $stagiaire->nom }}</h2>
            <p>pour ses contributions au séminaire du film étranger présenté par le Cercle cinématographique de Condorcet.</p>
        </div>

        <div class="signature-section">
            <div>
                <p>_________________________</p>
                <p>CLAUDINE ALLARD<br>Chèffe de projet</p>
            </div>
            
            <div>
                <p>_________________________</p>
                <p>LILIANE DUMONT<br>Présidente actuelle</p>
            </div>
        </div>

        <div class="qrcode">
            @php
                try {
                    if (!extension_loaded('gd')) {
                        throw new Exception('Extension GD non installée');
                    }
                    $qrCode = new QrCode(route('stagiaire.pdf', $stagiaire->id));
                    $writer = new PngWriter();
                    $result = $writer->write($qrCode);
                    $dataUri = $result->getDataUri();
                    $generateSuccess = true;
                    $error = null;
                } catch (\Exception $e) {
                    $generateSuccess = false;
                    $error = $e->getMessage();
                }
            @endphp
            
            @if($generateSuccess)
                <img src="{{ $dataUri }}" alt="QR Code de vérification">
                <p>Scannez ce QR Code pour vérifier l'authenticité</p>
            @else
                <p style="color: red;">QR Code non disponible - Erreur: {{ $error }}</p>
            @endif
        </div>
    </div>
    <button onclick="window.print()">Télécharger le certificat</button>
</body>
</html>