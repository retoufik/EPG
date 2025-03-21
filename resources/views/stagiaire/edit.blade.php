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
                    <label for="CIN" class="block text-sm font-medium text-blue-700 mb-2">Carte d'identitie </label>
                    <input type="text" id="CIN" name="CIN" 
                        value="{{ old('CIN', $stagiaire->CIN) }}"
                        class="w-full p-3 border border-blue-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                        required>
                </div>
            
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
                        <label class="block text-sm font-medium text-blue-700 mb-2">Genre</label>
                    <div class="flex space-x-6">
                        <div class="flex items-center">
                            <input type="radio" 
                                name="genre" 
                                id="genre_homme" 
                                value="Homme"
                                {{ old('genre', $stagiaire->genre) == 'Homme' ? 'checked' : '' }}
                                class="h-4 w-4 text-orange-600 focus:ring-orange-500 border-blue-300"
                                required>
                            <label for="genre_homme" class="ml-2 text-sm text-gray-700">Homme</label>
                        </div>
                    <div class="flex items-center">
                        <input type="radio" 
                            name="genre" 
                            id="genre_femme" 
                            value="Femme"
                            {{ old('genre', $stagiaire->genre) == 'Femme' ? 'checked' : '' }}
                            class="h-4 w-4 text-orange-600 focus:ring-orange-500 border-blue-300"
                            required>
                        <label for="genre_femme" class="ml-2 text-sm text-gray-700">Femme</label>
                    </div>
                </div>
                @error('genre')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
                
                
                <div>
                    <label for="date_naissance" class="block text-sm font-medium text-blue-700 mb-2">Date de Naissance</label>
                    <input type="date" 
                        id="date_naissance" 
                        name="date_naissance" 
                        value="{{ old('date_naissance', optional($stagiaire->date_naissance)->format('Y-m-d')) }}"
                        max="{{ date('Y-m-d') }}"
                        class="w-full p-3 border border-blue-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                        required>
                    @error('date_naissance')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
    
        
                <div class="col-span-full grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
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
                </div>


                <div class="col-span-full flex justify-center mb-6">
                    <div class="w-full md:w-1/2">
                        <label for="tel" class="block text-sm font-medium text-blue-700 mb-2">Téléphone</label>
                        <input type="text" id="tel" name="tel" 
                            value="{{ old('tel', $stagiaire->tel) }}"
                            class="w-full p-3 border border-blue-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                            required>
                    </div>

                    <div>
                    <label for="type_stage" class="block text-sm font-medium text-blue-700 mb-2">Type de Stage</label>
                    <select id="type_stage" name="type_stage" 
                        class="w-full p-3 border border-blue-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                        required>
                        <option value="">Sélectionnez un type de stage</option>
                        <option value="PFE" {{ old('type_stage', $stagiaire->type_stage) == 'PFE' ? 'selected' : '' }}>
                            Stage PFE
                        </option>
                        <option value="PFA" {{ old('type_stage', $stagiaire->type_stage) == 'PFA' ? 'selected' : '' }}>
                            Stage PFA
                        </option>
                        <option value="Observation" {{ old('type_stage', $stagiaire->type_stage) == 'Observation' ? 'selected' : '' }}>
                            Stage d'Observation
                        </option>
                        <option value="Technique" {{ old('type_stage', $stagiaire->type_stage) == 'Technique' ? 'selected' : '' }}>
                            Stage Technique
                        </option>
                        <option value="Professionnel" {{ old('type_stage', $stagiaire->type_stage) == 'Professionnel' ? 'selected' : '' }}>
                            Stage Professionnel
                        </option>
                    </select>
                    @error('type_stage')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
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