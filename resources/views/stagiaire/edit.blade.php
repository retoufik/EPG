@extends('layout.app')
@section('content')
<div class="mx-auto p-4 bg-gray-50 min-h-screen">
    <div class="bg-white rounded-lg shadow-md p-6">
        @auth
        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif
        @if($errors->any())
            <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h1 class="text-3xl font-bold text-orange-700 mb-6 border-b-2 border-blue-500 pb-2">
            Modifier le stagiaire
        </h1>

        <form action="{{ route('stagiaire.update', $stagiaire) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="CIN" class="block text-sm font-medium text-blue-700 mb-2">
                        Carte d'identité <span class="text-red-600">*</span>
                    </label>
                    <input type="text" id="CIN" name="CIN" 
                        value="{{ old('CIN', $stagiaire->CIN) }}"
                        class="w-full p-3 border border-blue-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                        required>
                    @error('CIN')
                        <p class="mt-1 text-sm text-red-600">{{ $errors->first('path') }}</p>
                    @enderror
                </div>

                <!-- Prénom Field -->
                <div>
                    <label for="prenom" class="block text-sm font-medium text-blue-700 mb-2">
                        Prénom <span class="text-red-600">*</span>
                    </label>
                    <input type="text" id="prenom" name="prenom" 
                        value="{{ old('prenom', $stagiaire->prenom) }}"
                        class="w-full p-3 border border-blue-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                        required>
                    @error('prenom')
                        <p class="mt-1 text-sm text-red-600">{{ $errors->first('prenom') }}</p>
                    @enderror
                </div>

                <!-- Nom Field -->
                <div>
                    <label for="nom" class="block text-sm font-medium text-blue-700 mb-2">
                        Nom <span class="text-red-600">*</span>
                    </label>
                    <input type="text" id="nom" name="nom" 
                        value="{{ old('nom', $stagiaire->nom) }}"
                        class="w-full p-3 border border-blue-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                        required>
                    @error('nom')
                        <p class="mt-1 text-sm text-red-600">{{ $errors->first('nom') }}</p>
                    @enderror
                </div>

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-medium text-blue-700 mb-2">
                        Email <span class="text-red-600">*</span>
                    </label>
                    <input type="email" id="email" name="email" 
                        value="{{ old('email', $stagiaire->email) }}"
                        class="w-full p-3 border border-blue-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                        required>
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $errors->first('email') }}</p>
                    @enderror
                </div>

                <!-- Genre Field -->
                <div>
                    <label class="block text-sm font-medium text-blue-700 mb-2">
                        Genre <span class="text-red-600">*</span>
                    </label>
                    <div class="flex gap-4 p-2 border border-blue-300 rounded-lg">
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="radio" name="genre" value="Homme" 
                                {{ old('genre', $stagiaire->genre) == 'Homme' ? 'checked' : '' }} 
                                class="h-4 w-4 text-orange-600 focus:ring-orange-500"
                                required>
                            <span class="text-sm text-gray-700">Homme</span>
                        </label>
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="radio" name="genre" value="Femme" 
                                {{ old('genre', $stagiaire->genre) == 'Femme' ? 'checked' : '' }} 
                                class="h-4 w-4 text-orange-600 focus:ring-orange-500"
                                required>
                            <span class="text-sm text-gray-700">Femme</span>
                        </label>
                    </div>
                    @error('genre')
                        <p class="mt-1 text-sm text-red-600">{{ $errors->first('genre') }}</p>
                    @enderror
                </div>

                <!-- Date de Naissance -->
                <div>
                    <label for="date_naissance" class="block text-sm font-medium text-blue-700 mb-2">
                        Date de Naissance <span class="text-red-600">*</span>
                    </label>
                    <input type="date" id="date_naissance" name="date_naissance" 
                        value="{{ old('date_naissance', $stagiaire->date_naissance ? $stagiaire->date_naissance : '') }}"
                        class="w-full p-3 border border-blue-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                        required>
                    @error('date_naissance')
                        <p class="mt-1 text-sm text-red-600">{{ $errors->first('date_naissance') }}</p>
                    @enderror
                </div>

                <!-- Date Fields -->
                <div class="col-span-full grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="debut" class="block text-sm font-medium text-blue-700 mb-2">
                            Date de début <span class="text-red-600">*</span>
                        </label>
                        <input type="date" id="debut" name="debut" 
                            value="{{ old('debut', $stagiaire->debut ? $stagiaire->debut->format('Y-m-d') : '') }}"
                            class="w-full p-3 border border-blue-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                            required>
                        @error('debut')
                            <p class="mt-1 text-sm text-red-600">{{ $errors->first('debut') }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="fin" class="block text-sm font-medium text-blue-700 mb-2">
                            Date de fin <span class="text-red-600">*</span>
                        </label>
                        <input type="date" id="fin" name="fin" 
                            value="{{ old('fin', $stagiaire->fin->format('Y-m-d')) }}"
                            min="{{ $stagiaire->debut ? $stagiaire->debut->format('Y-m-d') : '' }}"
                            class="w-full p-3 border border-blue-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                            required>
                        @error('fin')
                            <p class="mt-1 text-sm text-red-600">{{ $errors->first('fin') }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Téléphone Field -->
                <div>
                    <label for="tel" class="block text-sm font-medium text-blue-700 mb-2">
                        Téléphone <span class="text-red-600">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-phone text-gray-400"></i>
                        </div>
                        <input type="tel" id="tel" name="tel" 
                            value="{{ old('tel', $stagiaire->tel) }}"
                            pattern="[0-9]{10}"
                            title="Un numéro de téléphone de 10 chiffres"
                            class="w-full pl-10 p-3 border border-blue-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                            required>
                    </div>
                    @error('tel')
                        <p class="mt-1 text-sm text-red-600">{{ $errors->first('tel') }}</p>
                    @enderror
                </div>

                <!-- Type de Stage -->
                <div>
                    <label for="type_stage_id" class="block text-sm font-medium text-blue-700 mb-2">
                        Type de Stage <span class="text-red-600">*</span>
                    </label>
                    <div class="relative">
                        <select id="type_stage_id" name="type_stage_id" 
                            class="w-full p-3 border border-blue-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 appearance-none"
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

                <!-- Détails Field -->
                <div class="col-span-full">
                    <label for="details" class="block text-sm font-medium text-blue-700 mb-2">
                        Détails
                    </label>
                    <textarea id="details" name="details" rows="4"
                        class="w-full p-3 border border-blue-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500">{{ old('details', $stagiaire->details) }}</textarea>
                    @error('details')
                        <p class="mt-1 text-sm text-red-600">{{ $errors->first('details') }}</p>
                    @enderror
                </div>

                <!-- File Upload -->
                <div class="col-span-full">
                    <label for="path" class="block text-sm font-medium text-blue-700 mb-2">
                        Fichier joint
                    </label>
                    <input type="file" id="path" name="path"
                        class="w-full p-3 border border-blue-300 rounded-lg file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    
                    @if($stagiaire->path)
                        <div class="mt-4 p-3 bg-blue-50 rounded-lg">
                            <span class="text-sm text-blue-700">Fichier actuel :</span>
                            <a href="{{ asset('storage/'.$stagiaire->path) }}" target="_blank" 
                               class="text-blue-600 hover:text-blue-800 ml-2 break-all">
                                {{ basename($stagiaire->path) }}
                            </a>
                            <div class="mt-2 flex items-center">
                                <input type="checkbox" id="remove_file" name="remove_file" 
                                    class="h-4 w-4 text-orange-600 focus:ring-orange-500 border-blue-300">
                                <label for="remove_file" class="ml-2 text-sm text-gray-700">Supprimer le fichier actuel</label>
                            </div>
                            <div class="mt-2 flex items-center">
                                <input type="checkbox" id="download_file" name="download_file" 
                                    class="h-4 w-4 text-orange-600 focus:ring-orange-500 border-blue-300">
                                <label for="download_file" class="ml-2 text-sm text-gray-700">Telecharge votre document</label>
                            </div>
                        </div>
                    @endif
                    @error('path')
                        <p class="mt-1 text-sm text-red-600">{{ $errors->first('path') }}</p>
                    @enderror
                </div>
            </div>

            <!-- Form Actions -->
            <div class="mt-8 flex justify-end gap-4">
                <a href="{{ route('stagiaire.index') }}" 
                   class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition-colors shadow-sm hover:shadow-md">
                    Annuler
                </a>
                <button type="submit" 
                        class="bg-orange-600 text-white px-6 py-2 rounded-lg hover:bg-orange-700 transition-colors shadow-sm hover:shadow-md">
                    Mettre à jour
                </button>
            </div>
        </form>
        @else
        <div class="bg-red-100 border border-red-400 text-red-700 p-4 rounded-lg text-center">
            <i class="fas fa-exclamation-triangle mr-2"></i>
            Vous devez être connecté pour accéder à cette page.
            <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 ml-2">Se connecter</a>
        </div>
        @endauth
    </div>
</div>
@endsection