@extends('layout.app')
@section('title', 'Import Data')
@section('content')
<div class="bg-white dark:bg-gray-800 rounded-lg shadow-md">
    <div class="p-6">
        <div class="flex justify-between items-center mb-6 border-b-2 border-blue-500 pb-2">
            <div class="flex space-x-4">
                <a href="{{ route('import.export', ['type' => 'excel']) }}" 
                   class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 active:bg-green-700 focus:outline-none focus:border-green-700 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150">
                    <i class='bx bx-spreadsheet mr-2'></i> Exporter Excel
                </a>
                <a href="{{ route('import.export', ['type' => 'pdf']) }}"
                   class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:border-red-700 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150">
                    <i class='bx bxs-file-pdf mr-2'></i> Exporter PDF
                </a>
            </div>
        </div>

        <div class="mb-8">
            <div class="bg-white dark:bg-gray-700 rounded-lg p-6 shadow-md">
                <h2 class="text-xl font-semibold text-gray-700 dark:text-gray-200 mb-4">Importer un Fichier Excel</h2>
                
                @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                    {{ session('success') }}
                </div>
                @endif

                @if(session('error'))
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                    {{ session('error') }}
                </div>
                @endif

                <form action="{{ route('import.process') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Fichier Excel (.xlsx, .xls)
                        </label>
                        <input type="file" name="file" accept=".xlsx,.xls" required
                            class="block w-full text-sm text-gray-500 dark:text-gray-300
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-md file:border-0
                            file:text-sm file:font-semibold
                            file:bg-orange-50 file:text-orange-600
                            hover:file:bg-orange-100
                            dark:file:bg-orange-900 dark:file:text-orange-400">
                        @error('file')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="bg-gray-50 dark:bg-gray-600 p-4 rounded-lg">
                        <h3 class="text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Format du Fichier Excel:</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-300">Les colonnes doivent être dans cet ordre:</p>
                        <ol class="list-decimal list-inside text-sm text-gray-600 dark:text-gray-300 mt-2 space-y-1">
                            <li>Prénom (requis)</li>
                            <li>Nom (requis)</li>
                            <li>CIN (requis)</li>
                            <li>Email (requis)</li>
                            <li>Téléphone (requis)</li>
                            <li>Type de Stage</li>
                            <li>Date de Début</li>
                            <li>Date de Fin</li>
                            <li>Date de Naissance</li>
                            <li>Genre</li>
                            <li>Détails</li>
                        </ol>
                    </div>

                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-orange-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-orange-500 active:bg-orange-700 focus:outline-none focus:border-orange-700 focus:ring ring-orange-300 disabled:opacity-25 transition ease-in-out duration-150">
                        <i class='bx bx-upload mr-2'></i> Importer
                    </button>
                </form>
            </div>
        </div>

        <div>
            <h2 class="text-xl font-semibold text-gray-700 dark:text-gray-200 mb-4">Historique des Imports</h2>
            <div class="bg-white dark:bg-gray-700 rounded-lg shadow-md overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                        <thead class="bg-gray-50 dark:bg-gray-800">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Fichier</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Total</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Réussis</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Échoués</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Date</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-700 divide-y divide-gray-200 dark:divide-gray-600">
                            @forelse($importHistory as $history)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">
                                    {{ $history->filename }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">
                                    {{ $history->total_records }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs rounded-full 
                                        {{ $history->successful_records > 0 ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200' }}">
                                        {{ $history->successful_records }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs rounded-full 
                                        {{ $history->failed_records > 0 ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' : 'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200' }}">
                                        {{ $history->failed_records }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                    {{ $history->created_at->format('d/m/Y H:i') }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                    Aucun historique d'import
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 