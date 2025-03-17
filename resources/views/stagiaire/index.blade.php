@extends('layout.app')
@section('content')
<div class="mx-auto p-4 bg-gray-50 min-h-screen">
    @auth {{-- Only show content to authenticated users --}}
    <form method="GET" action="{{ route('stagiaire.index') }}" class="mb-6">
        <div class="flex gap-2">
            <input type="text" name="search" placeholder="Rechercher par nom/prénom" 
                   value="{{ request('search') }}"
                   class="flex-1 p-2 border border-blue-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                🔍 Rechercher
            </button>
            @if(request('search'))
                <a href="{{ route('stagiaire.index') }}" 
                   class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors">
                    ↻ Réinitialiser
                </a>
            @endif
        </div>
    </form>

    {{-- Alert Messages --}}
    @if($error)
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">{{ $error }}</div>
    @endif
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">{{ session('error') }}</div>
    @endif

    <div class="flex gap-4 mb-6">
        <a href="{{ route('stagiaire.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-lg transition-colors">
            👤 Nouveau Stagiaire
        </a>
    </div>

    <div class="border border-blue-200 rounded-lg overflow-hidden shadow-sm">
        <table class="min-w-full">
            <thead class="bg-blue-700 text-white">
                <tr>
                    <th class="py-3 px-4 text-left">Nom</th>
                    <th class="py-3 px-4 text-left">Prénom</th>
                    <th class="py-3 px-4 text-left">Email</th>
                    <th class="py-3 px-4 text-left">Téléphone</th>
                    <th class="py-3 px-4 text-left">Période</th>
                    <th class="py-3 px-4 text-left">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-blue-100">
                @foreach ($stag as $stagiaire)
                    <tr class="hover:bg-blue-50 transition-colors">
                        <td class="py-3 px-4 font-medium text-blue-800">{{ $stagiaire->nom }}</td>
                        <td class="py-3 px-4 font-medium text-blue-800">{{ $stagiaire->prenom }}</td>
                        <td class="py-3 px-4 text-blue-600 hover:text-blue-800">
                            <a href="mailto:{{ $stagiaire->email }}">{{ $stagiaire->email }}</a>
                        </td>
                        <td class="py-3 px-4 text-blue-600">{{ $stagiaire->tel }}</td>
                        <td class="py-3 px-4 text-blue-700">
                            {{ $stagiaire->debut->translatedFormat('l j F Y') }}<br>
                            <span class="text-sm text-blue-600">
                                au {{ $stagiaire->fin->translatedFormat('l j F Y') }}
                            </span>
                        </td>
                        <td class="py-3 px-4 space-x-3">
                            <a href="{{ route('stagiaire.show', $stagiaire) }}" class="text-blue-600 hover:text-blue-800" title="Voir">
                                👁️
                            </a>
                            <a href="{{ route('stagiaire.edit', $stagiaire) }}" class="text-blue-600 hover:text-blue-800" title="Modifier">
                                ✏️
                            </a>
                            <form action="{{ route('stagiaire.destroy', $stagiaire) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700" 
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

    <div class="mt-6">
        {{ $stag->links('pagination::tailwind') }}
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