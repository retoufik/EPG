<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <style>
        /* Add font-face for PDF rendering */
        @font-face {
            font-family: 'DejaVu Sans';
            font-style: normal;
            font-weight: normal;
            src: url({{ storage_path('fonts/DejaVuSans.ttf') }}) format('truetype');
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            line-height: 1.6;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 20px;
        }
        
        .section {
            margin-bottom: 25px;
        }
        
        .label {
            font-weight: bold;
            color: #1e40af;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Fiche Stagiaire - {{ $stagiaire->prenom }} {{ $stagiaire->nom }}</h1>
        <p>Généré le {{ now()->format('d/m/Y H:i') }}</p>
    </div>

    <div class="section">
        <h2>Informations de base</h2>
        <p><span class="label">Email:</span> {{ $stagiaire->email }}</p>
        <p><span class="label">Téléphone:</span> {{ $stagiaire->tel }}</p>
        <p><span class="label">Période de stage:</span> 
            {{ $frenchDate($stagiaire->debut) }} - {{ $frenchDate($stagiaire->fin) }}
        </p>
    </div>

    @if($stagiaire->details)
    <div class="section">
        <h2>Détails supplémentaires</h2>
        <p>{{ $stagiaire->details }}</p>
    </div>
    @endif

    @if($stagiaire->documents->count() > 0)
    <div class="section">
        <h2>Documents associés</h2>
        <ul>
            @foreach($stagiaire->documents as $document)
            <li>
                {{ $document->document_name }} ({{ $frenchDate($document->created_at) }})
            </li>
            @endforeach
        </ul>
    </div>
    @endif
</body>
</html>