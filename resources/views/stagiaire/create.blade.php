@extends('layout.app')

@section('content')
<div class="mx-auto p-4 bg-gray-50 min-h-screen">
    @auth
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h1 class="text-2xl font-bold text-orange-600 mb-6">Ajouter un Nouveau Stagiaire</h1>

            <form action="{{ route('stagiaire.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Personal Information -->
                    <div class="space-y-4">
                    <div>
                            <label for="CIN" class="block text-sm font-medium text-gray-700">Carte d'identitie *</label>
                            <input type="text" name="CIN" id="CIN" 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500"
                                   value="{{ old('CIN') }}" required>
                            @error('CIN')
                                <p class="mt-1 text-sm text-red-600">{{ $errors->first('cin') }}</p>
                            @enderror
                        </div>    

                        <div>
                            <label for="nom" class="block text-sm font-medium text-gray-700">Nom *</label>
                            <input type="text" name="nom" id="nom" 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500"
                                   value="{{ old('nom') }}" required>
                            @error('nom')
                                <p class="mt-1 text-sm text-red-600">{{ $errors->first('nom') }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="prenom" class="block text-sm font-medium text-gray-700">Prénom *</label>
                            <input type="text" name="prenom" id="prenom" 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500"
                                   value="{{ old('prenom') }}" required>
                            @error('prenom')
                                <p class="mt-1 text-sm text-red-600">{{ $errors->first('prenom') }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email *</label>
                            <input type="email" name="email" id="email" 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500"
                                   value="{{ old('email') }}" required>
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $errors->first('email') }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="tel" class="block text-sm font-medium text-gray-700">Téléphone *</label>
                            <input type="tel" name="tel" id="tel" 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500"
                                   value="{{ old('tel') }}" required>
                            @error('tel')
                                <p class="mt-1 text-sm text-red-600">{{ $errors->first('tel') }}</p>
                            @enderror
                        </div>

                        
                        <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Genre *</label>
                        <div class="flex space-x-4">
                            <div class="flex items-center">
                                <input type="radio" 
                                    name="genre" 
                                    id="genre_homme" 
                                    value="Homme"
                                    class="h-4 w-4 text-orange-600 focus:ring-orange-500 border-gray-300"
                                    {{ old('genre') == 'Homme' ? 'checked' : '' }}
                                    required>
                                <label for="genre_homme" class="ml-2 text-sm text-gray-700">Homme</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" 
                                    name="genre" 
                                    id="genre_femme" 
                                    value="Femme"
                                    class="h-4 w-4 text-orange-600 focus:ring-orange-500 border-gray-300"
                                    {{ old('genre') == 'Femme' ? 'checked' : '' }}
                                    required>
                                <label for="genre_femme" class="ml-2 text-sm text-gray-700">Femme</label>
                            </div>
                        </div>
                        @error('genre')
                            <p class="mt-1 text-sm text-red-600">{{ $errors->first('genre') }}</p>
                        @enderror
                    </div>
                    </div>

                    <!-- Internship Information -->
                    <div class="space-y-4">
                        <div>
                            <label for="date_naissance" class="block text-sm font-medium text-gray-700">Date de Naissance *</label>
                            <input type="date" name="date_naissance" id="date_naissance" 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500"
                                   value="{{ old('date_naissance') }}" required>
                            @error('date_naissance')
                                <p class="mt-1 text-sm text-red-600">{{ $errors->first('date_nassance') }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="debut" class="block text-sm font-medium text-gray-700">Date de début *</label>
                            <input type="date" name="debut" id="debut" 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500"
                                   value="{{ old('debut') }}" required>
                            @error('debut')
                                <p class="mt-1 text-sm text-red-600">{{ $errors->first('debut') }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="fin" class="block text-sm font-medium text-gray-700">Date de fin *</label>
                            <input type="date" name="fin" id="fin" 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500"
                                   value="{{ old('fin') }}" required>
                            @error('fin')
                                <p class="mt-1 text-sm text-red-600">{{ $errors->first('fin') }}</p>
                            @enderror
                        </div>

                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Type de Stage *</label>
                            <div class="mt-1">
                                <select name="type_stage" id="type_stage" 
                                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500"
                                        required>
                                    <option value="Autre" {{ old('type_stage') == 'Autre' ? 'selected' : '' }}>Autre</option>
                                    <option value="PFE" {{ old('type_stage') == 'PFE' ? 'selected' : '' }}>Stage PFE</option>
                                    <option value="PFA" {{ old('type_stage') == 'PFA' ? 'selected' : '' }}>Stage PFA</option>
                                    <option value="Observation" {{ old('type_stage') == 'Observation' ? 'selected' : '' }}>Stage d'Observation</option>
                                    <option value="Professionnel" {{ old('type_stage') == 'Professionnel' ? 'selected' : '' }}>Stage Professionnel</option>
                                    <option value="Technique" {{ old('type_stage') == 'Technique' ? 'selected' : '' }}>Stage Technique</option>
                                </select>
                            </div>
                            @error('type_stage')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- <div>
                            <label for="details" class="block text-sm font-medium text-gray-700">Détails supplémentaires</label>
                            <textarea name="details" id="details" rows="3"
                                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500">{{ old('details') }}</textarea>
                            @error('details')
                                <p class="mt-1 text-sm text-red-600">{{ $errors->first('details') }}</p>
                            @enderror
                        </div> -->

                        <div>
                            <label for="path" class="block text-sm font-medium text-gray-700">Fichier joint *</label>
                            <input type="file" name="path" id="path" 
                                   class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100"
                                   accept=".pdf,.doc,.docx" required>
                            @error('path')
                                <p class="mt-1 text-sm text-red-600">{{ $errors->first('path') }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex justify-end gap-4">
                    <a href="{{ route('stagiaire.index') }}" 
                       class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300 transition-colors">
                        Annuler
                    </a>
                    <button type="submit" 
                            class="bg-orange-600 text-white px-4 py-2 rounded-md hover:bg-orange-700 transition-colors">
                        Enregistrer le Stagiaire
                    </button>
                </div>
            </form>
        </div>
    </div>
    @else {{-- Show unauthorized message for non-authenticated users --}}
    <div class="bg-red-100 border border-red-400 text-red-700 p-4 rounded-lg text-center">
        <i class="fas fa-exclamation-triangle mr-2"></i>
        Vous devez être connecté pour accéder à cette page.
        <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 ml-2">Se connecter</a>
    </div>
    @endauth
</div>
@endsection