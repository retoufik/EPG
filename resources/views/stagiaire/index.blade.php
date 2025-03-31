@extends('layout.app')
@section('title','List des Stagiaires')
@section('content')
<div class="mx-auto p-4 bg-gray-50 dark:bg-gray-900 min-h-screen transition-colors duration-200">
    @auth
    <form method="GET" action="{{ route('stagiaire.index') }}" class="mb-6">
        <div class="flex flex-col sm:flex-row gap-2">
            <input type="text" name="search" placeholder="Rechercher par nom/prénom" 
                   value="{{ request('search') }}"
                   class="flex-1 p-2 border border-blue-300 dark:border-blue-600 dark:bg-gray-700 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400">
            <button type="submit" class="bg-blue-600 dark:bg-blue-700 text-white px-4 py-2 rounded-lg hover:bg-blue-700 dark:hover:bg-blue-600 transition-colors">
                🔍 Rechercher
            </button>
            @if(request('search'))
                <a href="{{ route('stagiaire.index') }}" 
                   class="bg-gray-500 dark:bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-600 dark:hover:bg-gray-700 transition-colors">
                    ↻ Réinitialiser
                </a>
            @endif
        </div>
    </form>

    @if($error)
        <div class="bg-red-100 dark:bg-red-900 border border-red-400 dark:border-red-700 text-red-700 dark:text-red-200 px-4 py-3 rounded mb-4">{{ $error }}</div>
    @endif
    @if (session('success'))
        <div class="bg-green-100 dark:bg-green-900 border border-green-400 dark:border-green-700 text-green-700 dark:text-green-200 px-4 py-3 rounded mb-4">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="bg-red-100 dark:bg-red-900 border border-red-400 dark:border-red-700 text-red-700 dark:text-red-200 px-4 py-3 rounded mb-4">{{ session('error') }}</div>
    @endif

    <div class="flex gap-4 mb-6">
        <a href="{{ route('stagiaire.create') }}" class="bg-blue-600 dark:bg-blue-700 hover:bg-blue-700 dark:hover:bg-blue-600 text-white font-medium py-3 px-6 rounded-lg transition-colors">
            👤 Nouveau Stagiaire
        </a>
    </div>

    <div class="md:hidden space-y-4">
        @foreach ($stag as $stagiaire)
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-4">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h3 class="text-lg font-semibold text-blue-800 dark:text-blue-300">
                            {{ $stagiaire->prenom }} {{ $stagiaire->nom }}
                        </h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $stagiaire->email }}</p>
                    </div>
                    <div class="flex space-x-2">
                        <a href="{{ route('stagiaire.show', $stagiaire) }}" 
                           class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300" 
                           title="Voir">👁️</a>
                        <a href="{{ route('stagiaire.edit', $stagiaire) }}" 
                           class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300" 
                           title="Modifier">✏️</a>
                        <form action="{{ route('stagiaire.destroy', $stagiaire) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="text-red-500 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300" 
                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce stagiaire?')" 
                                    title="Supprimer">
                                🗑️
                            </button>
                        </form>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-2 text-sm">
                    <div>
                        <span class="text-gray-500 dark:text-gray-400">Téléphone:</span>
                        <span class="text-blue-600 dark:text-blue-400">{{ $stagiaire->tel }}</span>
                    </div>
                    <div>
                        <span class="text-gray-500 dark:text-gray-400">Période:</span>
                        <span class="text-blue-700 dark:text-blue-300">
                            {{ $stagiaire->debut->translatedFormat('d/m/Y') }} - {{ $stagiaire->fin->translatedFormat('d/m/Y') }}
                        </span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="hidden md:block border border-blue-200 dark:border-blue-800 rounded-lg overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-blue-700 dark:bg-blue-900 text-white">
                    <tr>
                        <th class="py-3 px-4 text-left whitespace-nowrap">Nom</th>
                        <th class="py-3 px-4 text-left whitespace-nowrap">Prénom</th>
                        <th class="py-3 px-4 text-left whitespace-nowrap">Email</th>
                        <th class="py-3 px-4 text-left whitespace-nowrap">Téléphone</th>
                        <th class="py-3 px-4 text-left whitespace-nowrap">Période</th>
                        <th class="py-3 px-4 text-left whitespace-nowrap">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-blue-100 dark:divide-blue-800 bg-white dark:bg-gray-800">
                    @foreach ($stag as $stagiaire)
                        <tr class="hover:bg-blue-50 dark:hover:bg-blue-900/50 transition-colors">
                            <td class="py-3 px-4 font-medium text-blue-800 dark:text-blue-300 whitespace-nowrap">{{ $stagiaire->nom }}</td>
                            <td class="py-3 px-4 font-medium text-blue-800 dark:text-blue-300 whitespace-nowrap">{{ $stagiaire->prenom }}</td>
                            <td class="py-3 px-4 whitespace-nowrap">
                                <a href="mailto:{{ $stagiaire->email }}" 
                                   class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300">
                                    {{ $stagiaire->email }}
                                </a>
                            </td>
                            <td class="py-3 px-4 text-blue-600 dark:text-blue-400 whitespace-nowrap">{{ $stagiaire->tel }}</td>
                            <td class="py-3 px-4 text-blue-700 dark:text-blue-300 whitespace-nowrap">
                                {{ $stagiaire->debut->translatedFormat('l j F Y') }}<br>
                                <span class="text-sm text-blue-600 dark:text-blue-400">
                                    au {{ $stagiaire->fin->translatedFormat('l j F Y') }}
                                </span>
                            </td>
                            <td class="py-3 px-4 space-x-3 whitespace-nowrap">
                                <a href="{{ route('stagiaire.show', $stagiaire) }}" 
                                   class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300" 
                                   title="Voir">👁️</a>
                                <a href="{{ route('stagiaire.edit', $stagiaire) }}" 
                                   class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300" 
                                   title="Modifier">✏️</a>
                                <form action="{{ route('stagiaire.destroy', $stagiaire) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-red-500 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300" 
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce stagiaire?')" 
                                            title="Supprimer">
                                        🗑️
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6 dark:text-white">
        {{ $stag->links('') }}
    </div>
    @else
    <div class="bg-red-100 dark:bg-red-900 border border-red-400 dark:border-red-700 text-red-700 dark:text-red-200 p-4 rounded-lg text-center">
        <i class="fas fa-exclamation-triangle mr-2"></i>
        Vous devez être connecté pour accéder à cette page.
        <a href="{{ route('login') }}" 
           class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 ml-2">
            Se connecter
        </a>
    </div>
    @endauth
</div>
@endsection