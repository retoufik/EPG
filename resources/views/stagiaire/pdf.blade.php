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
    <title>Attestation de stage - {{$stagiaire->prenom}}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @font-face {
            font-family: 'DejaVu Sans';
            font-style: normal;
            font-weight: normal;
            src: url("{{ public_path('fonts/DejaVuSans.ttf') }}") format('truetype');
        }
        body {
            font-family: 'DejaVu Sans', sans-serif;
        }
    </style>
    <style>
        @media print {
            @page {
                size: A4;
                margin: 2cm;
            }
            
            body {
                margin: 0;
                padding: 0;
            }
            
            .no-print {
                display: none !important;
            }
            
            .min-h-custom {
                border: none !important;
            }
        }
    </style>
</head>
<body class="bg-white">
    <div class="no-print mt-4 mb-4 text-center">
        <a href="{{ route('stagiaire.index') }}" 
           class="bg-blue-900 text-white px-6 py-2 rounded-lg hover:bg-orange-600 transition duration-300 inline-block">
            <i class="fas fa-download mr-2"></i>
            Retour a acceuil
        </a>
    </div>
    <div class="min-h-custom max-w-4xl mx-auto p-8 border-[3px] border-blue-900">
        <div class="flex justify-between items-center mb-8">
            <img src="{{asset('logo.png')}}" alt="Logo" class="w-32 h-32">
            <div class="text-center">
                <h1 class="text-blue-900 font-bold text-xl uppercase">École Polytechnique des Génies</h1>
            </div>
        </div>

        <h1 class="text-3xl font-bold text-blue-900 mb-8 uppercase text-center">Attestation de Stage</h1>

        <div class="bg-blue-50 p-6 rounded-lg mb-8 text-left">
            <p class="mb-4">Je soussigné(e),le Directeur de l'École Polytechnique des Génies, certifie que :</p>
            
            <div class="grid grid-cols-2 gap-4 mb-4">
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

            <p class="mb-4">a effectué un stage au sein de notre établissement dans le cadre de son projet de fin d'études portant sur :</p>
            <p class="text-orange-600 font-semibold italic">"{{ $type->type ?? '[Sujet du projet]' }}"</p>
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

        <div class="flex justify-between mt-12 mb-8">
            <div class="text-center w-1/3">
                <p class="mb-8 text-blue-900">Le Directeur</p>
                <p class="border-t-2 border-blue-900 pt-6 w-48 mx-auto font-bold">ALAE EDDINE LAZRAK</p>
            </div>
        </div>
        <br>
        <div class="mt-8 text-center border-t-2 border-blue-900 pt-4">
            @php
                try {
                    $qrCode = new QrCode(route('stagiaire.attestation.download', $stagiaire->id));
                    $writer = new PngWriter();
                    $result = $writer->write($qrCode);
                    $dataUri = $result->getDataUri();
                } catch (\Exception $e) {
                    $dataUri = null;
                }
            @endphp
            
            @if($dataUri)
                <div class="inline-block p-4 bg-white rounded-lg border-2 border-blue-900">
                    <img src="{{ $dataUri }}" alt="QR Code" class="w-32 h-32 mx-auto">
                    <p class="text-xs mt-2 text-blue-900">Scan this QR code to verify authenticity</p>
                </div>
            @else
                <p class="text-red-500">QR Code unavailable</p>
            @endif
        </div>
    </div>

    <div class="text-center mt-4 space-x-4 no-print">
    @if($isButtonEnabled)
        <button onclick="printAttestation()"
                class="bg-blue-900 text-white px-6 py-2 rounded-lg hover:bg-orange-600 transition duration-300 inline-block">
            <i class="fas fa-print mr-2"></i>
            Imprimer l'Attestation
        </button>

        <a href="{{ route('stagiaire.attestation.download', $stagiaire) }}" 
           class="bg-blue-900 text-white px-6 py-2 rounded-lg hover:bg-orange-600 transition duration-300 inline-block">
            <i class="fas fa-download mr-2"></i>
            Télécharger l'Attestation
        </a>

        <p class="text-sm text-green-600 mt-2">Documents disponibles depuis le {{ $endDate->locale('fr')->isoFormat('LL') }}</p>
    @else
        <button disabled 
                class="bg-gray-400 text-white px-6 py-2 rounded-lg cursor-not-allowed transition duration-300 inline-block"
                title="Disponible à partir du {{ $endDate->locale('fr')->isoFormat('LL') }}">
            <i class="fas fa-print mr-2"></i>
            Imprimer l'Attestation
        </button>

        <button disabled 
                class="bg-gray-400 text-white px-6 py-2 rounded-lg cursor-not-allowed transition duration-300 inline-block"
                title="Disponible à partir du {{ $endDate->locale('fr')->isoFormat('LL') }}">
            <i class="fas fa-download mr-2"></i>
            Télécharger l'Attestation
        </button>

        <p class="text-sm text-orange-600 mt-2">Les documents seront disponibles à partir du {{ $endDate->locale('fr')->isoFormat('LL') }}</p>
    @endif
</div>

@push('styles')
<style>
    @media print {
        .text-center.mt-4.space-x-4,
        .header-buttons,
        .footer {
            display: none !important;
        }
        .min-h-custom {
            border: none !important;
            padding: 0 !important;
        }
    }
</style>
@endpush

<script>
function printAttestation() {
    const buttons = document.querySelector('.no-print');
    buttons.style.display = 'none';
    
    window.print();
    
    buttons.style.display = 'block';
}
</script>
</body>
</html>