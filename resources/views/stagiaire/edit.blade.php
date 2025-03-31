@extends('layout.app')
@section('title', 'Modifier le stagiaire - '. $stagiaire->prenom.' '.$stagiaire->nom)
@section('content')
<div class="mx-auto p-4 bg-gray-50 dark:bg-gray-900 min-h-screen transition-colors duration-200">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
        @auth
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 dark:bg-green-900 border border-green-400 dark:border-green-700 text-green-700 dark:text-green-200 rounded-lg">
                {{ session('success') }}
            </div>
        @endif
        @if($errors->any())
            <div class="mb-6 p-4 bg-red-100 dark:bg-red-900 border border-red-400 dark:border-red-700 text-red-700 dark:text-red-200 rounded-lg">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('stagiaire.update', $stagiaire) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="CIN" class="block text-sm font-medium text-blue-700 dark:text-blue-300 mb-2">
                        Carte d'identité <span class="text-red-600 dark:text-red-400">*</span>
                    </label>
                    <input type="text" id="CIN" name="CIN" 
                        value="{{ old('CIN', $stagiaire->CIN) }}"
                        class="w-full p-3 border border-blue-300 dark:border-blue-700 dark:bg-gray-700 dark:text-white rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                        required>
                    @error('CIN')
                        <p class="mt-1 text-sm text-red-600">{{ $errors->first('path') }}</p>
                    @enderror
                </div>

                <div>
                    <label for="prenom" class="block text-sm font-medium text-blue-700 dark:text-blue-300 mb-2">
                        Prénom <span class="text-red-600 dark:text-red-400">*</span>
                    </label>
                    <input type="text" id="prenom" name="prenom" 
                        value="{{ old('prenom', $stagiaire->prenom) }}"
                        class="w-full p-3 border border-blue-300 dark:border-blue-700 dark:bg-gray-700 dark:text-white rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                        required>
                    @error('prenom')
                        <p class="mt-1 text-sm text-red-600">{{ $errors->first('prenom') }}</p>
                    @enderror
                </div>

                <div>
                    <label for="nom" class="block text-sm font-medium text-blue-700 dark:text-blue-300 mb-2">
                        Nom <span class="text-red-600 dark:text-red-400">*</span>
                    </label>
                    <input type="text" id="nom" name="nom" 
                        value="{{ old('nom', $stagiaire->nom) }}"
                        class="w-full p-3 border border-blue-300 dark:border-blue-700 dark:bg-gray-700 dark:text-white rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                        required>
                    @error('nom')
                        <p class="mt-1 text-sm text-red-600">{{ $errors->first('nom') }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-blue-700 dark:text-blue-300 mb-2">
                        Email <span class="text-red-600 dark:text-red-400">*</span>
                    </label>
                    <input type="email" id="email" name="email" 
                        value="{{ old('email', $stagiaire->email) }}"
                        class="w-full p-3 border border-blue-300 dark:border-blue-700 dark:bg-gray-700 dark:text-white rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                        required>
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $errors->first('email') }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-blue-700 dark:text-blue-300 mb-2">
                        Genre <span class="text-red-600 dark:text-red-400">*</span>
                    </label>
                    <div class="flex gap-4 p-2 border border-blue-300 dark:border-blue-700 dark:bg-gray-700 dark:text-white rounded-lg">
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="radio" name="genre" value="Homme" 
                                {{ old('genre', $stagiaire->genre) == 'Homme' ? 'checked' : '' }} 
                                class="h-4 w-4 text-orange-600 focus:ring-orange-500"
                                required>
                            <span class="text-sm text-gray-700 dark:text-gray-300">Homme</span>
                        </label>
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="radio" name="genre" value="Femme" 
                                {{ old('genre', $stagiaire->genre) == 'Femme' ? 'checked' : '' }} 
                                class="h-4 w-4 text-orange-600 focus:ring-orange-500"
                                required>
                            <span class="text-sm text-gray-700 dark:text-gray-300">Femme</span>
                        </label>
                    </div>
                    @error('genre')
                        <p class="mt-1 text-sm text-red-600">{{ $errors->first('genre') }}</p>
                    @enderror
                </div>

                <div>
                    <label for="date_naissance" class="block text-sm font-medium text-blue-700 dark:text-blue-300 mb-2">
                        Date de Naissance <span class="text-red-600 dark:text-red-400">*</span>
                    </label>
                    <input type="date" id="date_naissance" name="date_naissance" 
                        value="{{ old('date_naissance', $stagiaire->date_naissance ? $stagiaire->date_naissance : '') }}"
                        class="w-full p-3 border border-blue-300 dark:border-blue-700 dark:bg-gray-700 dark:text-white rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                        required>
                    @error('date_naissance')
                        <p class="mt-1 text-sm text-red-600">{{ $errors->first('date_naissance') }}</p>
                    @enderror
                </div>

                <div class="col-span-full grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="debut" class="block text-sm font-medium text-blue-700 dark:text-blue-300 mb-2">
                            Date de début <span class="text-red-600 dark:text-red-400">*</span>
                        </label>
                        <input type="date" id="debut" name="debut" 
                            value="{{ old('debut', $stagiaire->debut ? $stagiaire->debut->format('Y-m-d') : '') }}"
                            class="w-full p-3 border border-blue-300 dark:border-blue-700 dark:bg-gray-700 dark:text-white rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                            required>
                        @error('debut')
                            <p class="mt-1 text-sm text-red-600">{{ $errors->first('debut') }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="fin" class="block text-sm font-medium text-blue-700 dark:text-blue-300 mb-2">
                            Date de fin <span class="text-red-600 dark:text-red-400">*</span>
                        </label>
                        <input type="date" id="fin" name="fin" 
                            value="{{ old('fin', $stagiaire->fin->format('Y-m-d')) }}"
                            min="{{ $stagiaire->debut ? $stagiaire->debut->format('Y-m-d') : '' }}"
                            class="w-full p-3 border border-blue-300 dark:border-blue-700 dark:bg-gray-700 dark:text-white rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                            required>
                        @error('fin')
                            <p class="mt-1 text-sm text-red-600">{{ $errors->first('fin') }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="tel" class="block text-sm font-medium text-blue-700 dark:text-blue-300 mb-2">
                        Téléphone <span class="text-red-600 dark:text-red-400">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-phone text-gray-400"></i>
                        </div>
                        <input type="tel" id="tel" name="tel" 
                            value="{{ old('tel', $stagiaire->tel) }}"
                            pattern="[0-9]{10}"
                            title="Un numéro de téléphone de 10 chiffres"
                            class="w-full pl-10 p-3 border border-blue-300 dark:border-blue-700 dark:bg-gray-700 dark:text-white rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                            required>
                    </div>
                    @error('tel')
                        <p class="mt-1 text-sm text-red-600">{{ $errors->first('tel') }}</p>
                    @enderror
                </div>

                <div>
                    <label for="type_stage_id" class="block text-sm font-medium text-blue-700 dark:text-blue-300 mb-2">
                        Type de Stage <span class="text-red-600 dark:text-red-400">*</span>
                    </label>
                    <div class="relative">
                        <select id="type_stage_id" name="type_stage_id" 
                            class="w-full p-3 border border-blue-300 dark:border-blue-700 dark:bg-gray-700 dark:text-white rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 appearance-none"
                            required>
                            @foreach($types as $type_stage)
                                <option value="{{ $type_stage->id }}"
                                    {{ old('type_stage_id', $stagiaire->type_stage_id) == $type_stage->id ? 'selected' : '' }}>
                                    {{ $type_stage->type }}
                                </option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <i class="fas fa-chevron-down text-gray-400"></i>
                        </div>
                    </div>
                    @error('type_stage_id')
                        <p class="mt-1 text-sm text-red-600">{{ $errors->first('type_stage_id') }}</p>
                    @enderror
                </div>

                <div class="col-span-full">
                    <label for="details" class="block text-sm font-medium text-blue-700 dark:text-blue-300 mb-2">
                        Détails
                    </label>
                    <textarea id="details" name="details" rows="4"
                        class="w-full p-3 border border-blue-300 dark:border-blue-700 dark:bg-gray-700 dark:text-white rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500">{{ old('details', $stagiaire->details) }}</textarea>
                    @error('details')
                        <p class="mt-1 text-sm text-red-600">{{ $errors->first('details') }}</p>
                    @enderror
                </div>

                <div class="col-span-full">
                    <label for="path" class="block text-sm font-medium text-blue-700 dark:text-blue-300 mb-2">
                        Fichier joint
                    </label>
                    <input type="file" id="path" name="path"
                        class="w-full p-3 border border-blue-300 dark:border-blue-700 dark:bg-gray-700 dark:text-white rounded-lg file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 dark:file:bg-blue-900 file:text-blue-700 dark:file:text-blue-300 hover:file:bg-blue-100 dark:hover:file:bg-blue-800">
                    
                    @if($stagiaire->path)
                        <div class="mt-4 p-3 bg-blue-50 dark:bg-blue-900 rounded-lg">
                            <span class="text-sm text-blue-700 dark:text-blue-300">Fichier actuel :</span>
                            <a href="{{ Storage::url($stagiaire->path) }}" target="_blank" 
                               class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 ml-2 break-all">
                                {{ basename($stagiaire->path) }}
                            </a>
                            <div class="mt-2 flex items-center">
                                <input type="checkbox" id="remove_file" name="remove_file" 
                                    class="h-4 w-4 text-orange-600 focus:ring-orange-500 border-blue-300 dark:border-blue-700">
                                <label for="remove_file" class="ml-2 text-sm text-gray-700 dark:text-gray-300">Supprimer le fichier actuel</label>
                            </div>
                            <div class="mt-2 flex items-center">
                                <input type="checkbox" id="download_file" name="download_file" 
                                    class="h-4 w-4 text-orange-600 focus:ring-orange-500 border-blue-300 dark:border-blue-700">
                                <label for="download_file" class="ml-2 text-sm text-gray-700 dark:text-gray-300">Telecharge votre document</label>
                            </div>
                        </div>
                    @endif
                    @error('path')
                        <p class="mt-1 text-sm text-red-600">{{ $errors->first('path') }}</p>
                    @enderror
                </div>
                <div class="col-span-full mt-6">
                    <label class="block text-sm font-medium text-blue-700 dark:text-blue-300 mb-4">
                        Documents supplémentaires
                    </label>
                    <div class="space-y-4 mb-6">
                        @foreach($stagiaire->documents as $document)
                            <div class="document-existing-group flex items-center gap-4 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                <div class="flex-1">
                                    <span class="text-sm text-gray-700 dark:text-gray-300">{{ $document->document_name }}</span>
                                    <a href="{{ Storage::url($document) }}" target="_blank" 
                                       class="ml-2 text-blue-600 dark:text-blue-400 hover:underline text-sm">
                                        (Télécharger)
                                    </a>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" 
                                           name="delete_documents[]" 
                                           value="{{ $document->id }}"
                                           class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300 dark:border-gray-600">
                                    <label class="ml-2 text-sm text-red-600 dark:text-red-400 cursor-pointer">Supprimer</label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                
                    <div id="documents-container" class="space-y-4">
                    </div>
                
                    <button type="button" id="add-document" 
                            class="mt-4 text-sm bg-gray-200 dark:bg-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors">
                        + Ajouter un document
                    </button>
                </div>
            </div>

            <div class="mt-8 flex justify-end gap-4">
                <a href="{{ route('stagiaire.index') }}" 
                   class="bg-gray-500 dark:bg-gray-600 text-white px-6 py-2 rounded-lg hover:bg-gray-600 dark:hover:bg-gray-700 transition-colors shadow-sm hover:shadow-md">
                    Annuler
                </a>
                <button type="submit" 
                        class="bg-orange-600 text-white px-6 py-2 rounded-lg hover:bg-orange-700 transition-colors shadow-sm hover:shadow-md">
                    Mettre à jour
                </button>
            </div>
        </form>
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
</div>
@endsection
@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    let docIndex = 0;
    const container = document.getElementById('documents-container');
    const addButton = document.getElementById('add-document');

    addButton.addEventListener('click', function() {
        const newGroup = document.createElement('div');
        newGroup.className = 'document-group flex items-center gap-4';
        newGroup.innerHTML = `
            <div class="flex-1 flex gap-4">
                <input type="text" 
                    name="new_documents[${docIndex}][name]" 
                    placeholder="Nom du document"
                    class="flex-1 p-2 border border-blue-300 dark:border-blue-700 dark:bg-gray-700 rounded-lg text-sm">

                <input type="file" 
                    name="new_documents[${docIndex}][file]" 
                    class="flex-1 text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 dark:file:bg-blue-900 file:text-blue-700 dark:file:text-blue-300 hover:file:bg-blue-100 dark:hover:file:bg-blue-800">

                <button type="button" 
                        class="remove-document text-red-500 hover:text-red-700 px-2">
                    ×
                </button>
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
@endsection