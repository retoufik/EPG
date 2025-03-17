@extends('layout.app')
@section('content')
<div class="mx-auto p-4 bg-gray-50 min-h-screen">
    <div class="bg-white rounded-lg shadow-md p-6">
        @auth
        <h1 class="text-3xl font-bold text-orange-700 mb-6 border-b-2 border-blue-500 pb-2">
            Modifier le stagiaire
        </h1>

        <form action="{{ route('stagiaire.update', $stagiaire) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="prenom" class="block text-sm font-medium text-blue-700 mb-2">Prénom</label>
                    <input type="text" id="prenom" name="prenom" 
                        value="{{ old('prenom', $stagiaire->prenom) }}"
                        class="w-full p-3 border border-blue-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                        required>
                </div>
                
                <div>
                    <label for="nom" class="block text-sm font-medium text-blue-700 mb-2">Nom</label>
                    <input type="text" id="nom" name="nom" 
                        value="{{ old('nom', $stagiaire->nom) }}"
                        class="w-full p-3 border border-blue-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                        required>
                </div>
                
                <div>
                    <label for="email" class="block text-sm font-medium text-blue-700 mb-2">Email</label>
                    <input type="email" id="email" name="email" 
                        value="{{ old('email', $stagiaire->email) }}"
                        class="w-full p-3 border border-blue-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                        required>
                </div>
                
                <div>
                    <label for="tel" class="block text-sm font-medium text-blue-700 mb-2">Téléphone</label>
                    <input type="text" id="tel" name="tel" 
                        value="{{ old('tel', $stagiaire->tel) }}"
                        class="w-full p-3 border border-blue-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                        required>
                </div>
                
                <div>
                    <label for="debut" class="block text-sm font-medium text-blue-700 mb-2">Date de début</label>
                    <input type="date" id="debut" name="debut" 
                        value="{{ old('debut', $stagiaire->debut ? $stagiaire->debut->format('Y-m-d') : '') }}"
                        class="w-full p-3 border border-blue-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                        required>
                </div>
                
                <div>
                    <label for="fin" class="block text-sm font-medium text-blue-700 mb-2">Date de fin</label>
                    <input type="date" id="fin" name="fin" 
                        value="{{ old('fin', $stagiaire->fin->format('Y-m-d')) }}"
                        class="w-full p-3 border border-blue-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                        required>
                </div>
                
                <div class="col-span-full">
                    <label for="details" class="block text-sm font-medium text-blue-700 mb-2">Détails</label>
                    <textarea id="details" name="details" rows="4"
                        class="w-full p-3 border border-blue-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500">{{ old('details', $stagiaire->details) }}</textarea>
                </div>
                
                <div class="col-span-full">
                    <label for="path" class="block text-sm font-medium text-blue-700 mb-2">Fichier joint</label>
                    <input type="file" id="path" name="path"
                        class="w-full p-3 border border-blue-300 rounded-lg file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    
                    @if($stagiaire->path)
                        <div class="mt-4 p-3 bg-blue-50 rounded-lg">
                            <span class="text-sm text-blue-700">Fichier actuel :</span>
                            <a href="{{ asset('storage/'.$stagiaire->path) }}" target="_blank" 
                               class="text-blue-600 hover:text-blue-800 ml-2 break-all">
                                {{ basename($stagiaire->path) }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <div class="mt-8 flex justify-end gap-4">
                <a href="{{ route('stagiaire.index') }}" 
                   class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition-colors">
                    Annuler
                </a>
                <button type="submit" 
                        class="bg-orange-600 text-white px-6 py-2 rounded-lg hover:bg-orange-700 transition-colors">
                    Mettre à jour
                </button>
            </div>
        </form>
        @else {{-- Show unauthorized message for non-authenticated users --}}
    <div class="bg-red-100 border border-red-400 text-red-700 p-4 rounded-lg text-center">
        <i class="fas fa-exclamation-triangle mr-2"></i>
        Vous devez être connecté pour accéder à cette page.
        <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 ml-2">Se connecter</a>
    </div>
    @endauth
    </div>
</div>
@endsection