@extends('layout.app')
@section('title', 'Ajouter un Stagiaire')
@section('content')
<div class="mx-auto p-4 bg-white dark:bg-gray-800 min-h-screen transition-colors duration-200">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
        @auth
        <div class="max-w-3xl mx-auto">
            <form action="{{ route('stagiaire.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                                Carte d'identitie *
                            </label>
                            <input type="text" name="CIN" id="CIN" 
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-orange-500 focus:ring-orange-500 dark:focus:ring-orange-400"
                                value="{{ old('CIN') }}" required>
                            @error('CIN')
                                <p class="mt-1 text-sm text-red-600">{{ $errors->first('cin') }}</p>
                            @enderror
                        </div>    

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                                Nom *
                            </label>
                            <input type="text" name="nom" id="nom" 
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-orange-500 focus:ring-orange-500 dark:focus:ring-orange-400"
                                value="{{ old('nom') }}" required>
                            @error('nom')
                                <p class="mt-1 text-sm text-red-600">{{ $errors->first('nom') }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                                Prénom *
                            </label>
                            <input type="text" name="prenom" id="prenom" 
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-orange-500 focus:ring-orange-500 dark:focus:ring-orange-400"
                                value="{{ old('prenom') }}" required>
                            @error('prenom')
                                <p class="mt-1 text-sm text-red-600">{{ $errors->first('prenom') }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                                Email *
                            </label>
                            <input type="email" name="email" id="email" 
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-orange-500 focus:ring-orange-500 dark:focus:ring-orange-400"
                                value="{{ old('email') }}" required>
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $errors->first('email') }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                                Téléphone *
                            </label>
                            <input type="tel" name="tel" id="tel" 
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-orange-500 focus:ring-orange-500 dark:focus:ring-orange-400"
                                value="{{ old('tel') }}" required>
                            @error('tel')
                                <p class="mt-1 text-sm text-red-600">{{ $errors->first('tel') }}</p>
                            @enderror
                        </div>

                        
                        <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Genre *</label>
                        <div class="flex space-x-4">
                            <div class="flex items-center">
                                <input type="radio" 
                                    name="genre" 
                                    id="genre_homme" 
                                    value="Homme"
                                    class="h-4 w-4 text-orange-600 focus:ring-orange-500 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:ring-orange-400"
                                    {{ old('genre') == 'Homme' ? 'checked' : '' }}
                                    required>
                                <label for="genre_homme" class="ml-2 text-sm text-gray-700 dark:text-gray-200">Homme</label>
                            </div>
                            <div class="flex items-center">
                                <input type="radio" 
                                    name="genre" 
                                    id="genre_femme" 
                                    value="Femme"
                                    class="h-4 w-4 text-orange-600 focus:ring-orange-500 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:ring-orange-400"
                                    {{ old('genre') == 'Femme' ? 'checked' : '' }}
                                    required>
                                <label for="genre_femme" class="ml-2 text-sm text-gray-700 dark:text-gray-200">Femme</label>
                            </div>
                        </div>
                        @error('genre')
                            <p class="mt-1 text-sm text-red-600">{{ $errors->first('genre') }}</p>
                        @enderror
                    </div>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                                Date de Naissance *
                            </label>
                            <input type="date" name="date_naissance" id="date_naissance" 
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-orange-500 focus:ring-orange-500 dark:focus:ring-orange-400"
                                value="{{ old('date_naissance') }}" required>
                            @error('date_naissance')
                                <p class="mt-1 text-sm text-red-600">{{ $errors->first('date_nassance') }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                                Date de début *
                            </label>
                            <input type="date" name="debut" id="debut" 
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-orange-500 focus:ring-orange-500 dark:focus:ring-orange-400"
                                value="{{ old('debut') }}" required>
                            @error('debut')
                                <p class="mt-1 text-sm text-red-600">{{ $errors->first('debut') }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                                Date de fin *
                            </label>
                            <input type="date" name="fin" id="fin" 
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-orange-500 focus:ring-orange-500 dark:focus:ring-orange-400"
                                value="{{ old('fin') }}" required>
                            @error('fin')
                                <p class="mt-1 text-sm text-red-600">{{ $errors->first('fin') }}</p>
                            @enderror
                        </div>

                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                                Type de Stage *
                            </label>
                            <div class="mt-1">
                                <select name="type_stage_id" id="type_stage" 
                                        class="block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-orange-500 focus:ring-orange-500 dark:focus:ring-orange-400"
                                        required>
                                    <option value="">Choisir un type de stage</option>
                                    @foreach($types as $type_stage)
                                        <option value="{{ $type_stage->id }}"
                                                {{ old('type_stage_id') == $type_stage->id ? 'selected' : '' }}>
                                            {{ $type_stage->type }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('type_stage_id')
                                <p class="mt-1 text-sm text-red-600">{{ $errors->first('type_stage_id') }}</p>
                            @enderror
                        </div>

                       <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                                Détails supplémentaires
                            </label>
                            <textarea name="details" id="details" rows="3"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-orange-500 focus:ring-orange-500 dark:focus:ring-orange-400">{{ old('details') }}</textarea>
                            @error('details')
                                <p class="mt-1 text-sm text-red-600">{{ $errors->first('details') }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                                Fichier joint *
                            </label>
                            <input type="file" name="path" id="path" 
                                class="mt-1 block w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100 dark:file:bg-orange-900 dark:file:text-orange-200 dark:hover:file:bg-orange-800"
                                accept=".pdf,.doc,.docx" required>
                            @error('path')
                                <p class="mt-1 text-sm text-red-600">{{ $errors->first('path') }}</p>
                            @enderror
                        </div>
                        <div class="mt-6">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">
                                Documents supplémentaires (optionnels)
                            </label>
                            <div id="documents-container">
                                <div class="document-group mb-4">
                                    <div class="flex gap-4">
                                        <input type="text" name="documents[0][name]" 
                                            placeholder="Nom du document (optionnel)"
                                            class="flex-1 rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                                        <input type="file" name="documents[0][file]" 
                                            class="flex-1 text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100 dark:file:bg-orange-900 dark:file:text-orange-200 dark:hover:file:bg-orange-800">
                                        <button type="button" class="remove-document text-red-500 hover:text-red-700">×</button>
                                    </div>
                                </div>
                            </div>
                            <button type="button" id="add-document" 
                                    class="mt-2 text-sm bg-gray-200 dark:bg-gray-700 px-3 py-1 rounded-md">
                                + Ajouter un document
                            </button>
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex justify-end gap-4">
                    <a href="{{ route('stagiaire.index') }}" 
                        class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 px-4 py-2 rounded-md hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors">
                        Annuler
                    </a>
                    <button type="submit" 
                            class="bg-orange-600 text-white px-4 py-2 rounded-md hover:bg-orange-700 transition-colors">
                        Enregistrer le Stagiaire
                    </button>
                </div>
            </form>
        </div>
        @else
        <div class="bg-red-100 dark:bg-red-900 border border-red-400 dark:border-red-700 text-red-700 dark:text-red-200 p-4 rounded-lg text-center">
            <i class="fas fa-exclamation-triangle mr-2"></i>
            Vous devez être connecté pour accéder à cette page.
            <a href="{{ route('login') }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 ml-2">
                Se connecter
            </a>
        </div>
        @endauth
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let docIndex = 1;
            const container = document.getElementById('documents-container');
        
            document.getElementById('add-document').addEventListener('click', function() {
                const newGroup = document.createElement('div');
                newGroup.className = 'document-group mb-4';
                newGroup.innerHTML = `
                    <div class="flex gap-4">
                        <input type="text" name="documents[${docIndex}][name]" 
                            placeholder="Nom du document (optionnel)"
                            class="flex-1 rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                        <input type="file" name="documents[${docIndex}][file]" 
                            class="flex-1 text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100 dark:file:bg-orange-900 dark:file:text-orange-200 dark:hover:file:bg-orange-800">
                        <button type="button" class="remove-document text-red-500 hover:text-red-700">×</button>
                    </div>
                `;
                container.appendChild(newGroup);
                docIndex++;
            });
        
            container.addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-document')) {
                    e.target.closest('.document-group').remove();
                }
            });
        });
        </script>
</div>
@endsection