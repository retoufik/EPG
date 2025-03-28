@extends('layout.app')
@section('content')
<div class="mx-auto p-4 bg-gray-50 min-h-screen">
    @auth    
    <div class="max-w-5xl mx-auto">
        <div class="flex justify-between items-center mb-8 no-print">
            <h1 class="text-3xl font-bold text-orange-700">Détails du Stagiaire</h1>
            <div class="flex gap-4">
                <a href="{{ route('stagiaire.attestation.download', $stagiaire) }}" 
                   class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors">
                    <i class="fas fa-file-pdf mr-2"></i>Télécharger PDF
                </a>
                <button onclick="window.print()" 
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                    <i class="fas fa-print mr-2"></i>Imprimer
                </button>
            </div>
        </div>

        <div class="printable-section">
            <div class="bg-white rounded-lg p-6 mb-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div>
                            <label class="text-sm font-medium text-blue-700">Nom complet</label>
                            <p class="mt-1 text-lg font-semibold text-orange-600">
                                {{ $stagiaire->prenom }} {{ $stagiaire->nom }}
                            </p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-blue-700">Email</label>
                            <p class="mt-1 text-blue-600">
                                {{ $stagiaire->email }}
                            </p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-blue-700">Téléphone</label>
                            <p class="mt-1 text-blue-600">
                                {{ $stagiaire->tel }}
                            </p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="text-sm font-medium text-blue-700">Période de stage</label>
                            <p class="mt-1 text-blue-600">
                                {{ $stagiaire->debut->format('d/m/Y') }}<br>
                                <span class="text-sm">au {{ $stagiaire->fin->format('d/m/Y') }}</span>
                            </p>
                        </div>
                        @if($stagiaire->path)
                        <div>
                            <label class="text-sm font-medium text-blue-700">Fichier joint</label>
                            <p class="mt-1 text-blue-600">
                                {{ basename($stagiaire->path) }}
                            </p>
                        </div>
                        @endif
                    </div>
                </div>

                @if($stagiaire->details)
                <div class="mt-6 pt-4 border-t border-gray-200">
                    <label class="text-sm font-medium text-blue-700">Détails supplémentaires</label>
                    <p class="mt-2 text-gray-700 whitespace-pre-line">{{ $stagiaire->details }}</p>
                </div>
                @endif
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-lg p-6 no-print">
            <h2 class="text-xl font-semibold text-orange-700 mb-6">Documents Associés</h2>

            <form action="{{ route('stagiaire.documents.store', $stagiaire) }}" method="POST" enctype="multipart/form-data" 
                  class="bg-blue-50 rounded-lg p-4 mb-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <input type="text" name="document_name" 
                               class="w-full p-2 border border-blue-300 rounded-lg" 
                               placeholder="Nom du document" required>
                    </div>
                    <div>
                        <input type="file" name="document" 
                               class="w-full p-2 border border-blue-300 rounded-lg file:mr-4 file:py-1 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-700"
                               required>
                    </div>
                    <div>
                        <button type="submit" 
                                class="w-full bg-blue-600 text-white p-2 rounded-lg hover:bg-blue-700 transition-colors">
                            Ajouter Document
                        </button>
                    </div>
                </div>
            </form>

            <div class="space-y-4">
                @foreach($stagiaire->documents as $document)
                <div class="flex items-center justify-between bg-gray-50 p-4 rounded-lg">
                    <div class="flex items-center space-x-4">
                        <i class="fas fa-file-alt text-blue-600"></i>
                        <div>
                            <span class="font-medium text-blue-700">{{ $document->document_name }}</span>
                            <span class="text-sm text-gray-500 ml-2">
                                {{ \Carbon\Carbon::parse($document->created_at)->format('d/m/Y H:i') }}
                            </span>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="{{ asset('storage/'.$document->file_path) }}" target="_blank" 
                           class="text-blue-600 hover:text-blue-800" title="Télécharger">
                            <i class="fas fa-download"></i>
                        </a>
                        <form action="{{ route('documents.destroy', $document) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="text-red-500 hover:text-red-700"
                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce document?')"
                                    title="Supprimer">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @else 
    <div class="bg-red-100 border border-red-400 text-red-700 p-4 rounded-lg text-center">
        <i class="fas fa-exclamation-triangle mr-2"></i>
        Vous devez être connecté pour accéder à cette page.
        <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 ml-2">Se connecter</a>
    </div>
    @endauth
</div>

<style>
@media print {
    @page {
        margin: 0;
    }
    
    body {
        background: white !important;
        font-size: 12pt;
        padding: 20px !important;
    }
    
    .no-print, .no-print * {
        display: none !important;
    }
    
    .printable-section {
        box-shadow: none !important;
        border: none !important;
        padding: 0 !important;
        margin: 0 !important;
        page-break-inside: avoid;
    }
    
    .text-orange-600 {
        color: #000 !important;
    }
    
    .text-blue-700 {
        color: #000 !important;
    }
    
    a {
        text-decoration: none !important;
        color: #000 !important;
    }
}
</style>
@endsection