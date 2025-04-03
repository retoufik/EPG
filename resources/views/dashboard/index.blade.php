@extends('layout.app')

@section('title', 'Dashboard')

@section('content')
<div class="bg-white dark:bg-gray-800 rounded-lg shadow-md">
    <div class="p-6">
        <h1 class="text-3xl font-bold text-orange-600 dark:text-orange-500 mb-6 border-b-2 border-blue-500 pb-2">
            Tableau de Bord des Stagiaires
        </h1>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white dark:bg-gray-700 rounded-lg p-6 shadow-md border-l-4 border-blue-500">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 dark:bg-blue-900">
                        <i class='bx bxs-graduation text-2xl text-blue-500'></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-500 dark:text-gray-400">Total Stagiaires</p>
                        <p class="text-2xl font-semibold text-gray-700 dark:text-gray-200">{{ $totalStagiaires }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-700 rounded-lg p-6 shadow-md border-l-4 border-green-500">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 dark:bg-green-900">
                        <i class='bx bxs-user-check text-2xl text-green-500'></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-500 dark:text-gray-400">En Stage</p>
                        <p class="text-2xl font-semibold text-gray-700 dark:text-gray-200">{{ $activeStagiaires }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-700 rounded-lg p-6 shadow-md border-l-4 border-orange-500">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-orange-100 dark:bg-orange-900">
                        <i class='bx bxs-badge-check text-2xl text-orange-500'></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-500 dark:text-gray-400">Stages Terminés</p>
                        <p class="text-2xl font-semibold text-gray-700 dark:text-gray-200">{{ $completedStagiaires }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-700 rounded-lg p-6 shadow-md border-l-4 border-yellow-500">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-yellow-100 dark:bg-yellow-900">
                        <i class='bx bxs-hourglass text-2xl text-yellow-500'></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-500 dark:text-gray-400">À Venir</p>
                        <p class="text-2xl font-semibold text-gray-700 dark:text-gray-200">{{ $pendingStagiaires }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <div class="lg:col-span-2 bg-white dark:bg-gray-700 rounded-lg p-6 shadow-md h-[400px]">
                <h2 class="text-xl font-semibold text-gray-700 dark:text-gray-200 mb-4">Évolution des Inscriptions</h2>
                <canvas id="stagiaireProgressChart"></canvas>
            </div>

            <div class="bg-white dark:bg-gray-700 rounded-lg p-6 shadow-md h-[400px]">
                <h2 class="text-xl font-semibold text-gray-700 dark:text-gray-200 mb-4">État des Stages</h2>
                <canvas id="stagiaireDistributionChart"></canvas>
            </div>
        </div>

        <!-- Recent Stagiaires -->
        <div class="bg-white dark:bg-gray-700 rounded-lg p-6 shadow-md">
            <h2 class="text-xl font-semibold text-gray-700 dark:text-gray-200 mb-4">Stagiaires Récents</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="border-b dark:border-gray-600">
                            <th class="text-left py-3 px-4 text-gray-600 dark:text-gray-400">Nom Complet</th>
                            <th class="text-left py-3 px-4 text-gray-600 dark:text-gray-400">CIN</th>
                            <th class="text-left py-3 px-4 text-gray-600 dark:text-gray-400">État</th>
                            <th class="text-left py-3 px-4 text-gray-600 dark:text-gray-400">Période</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentStagiaires as $stagiaire)
                        <tr class="border-b dark:border-gray-600">
                            <td class="py-3 px-4 text-gray-700 dark:text-gray-300">{{ $stagiaire->nom }} {{ $stagiaire->prenom }}</td>
                            <td class="py-3 px-4 text-gray-700 dark:text-gray-300">{{ $stagiaire->CIN }}</td>
                            <td class="py-3 px-4">
                                <span class="px-2 py-1 rounded-full text-xs 
                                    @if($stagiaire->debut <= now() && $stagiaire->fin >= now()) bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                    @elseif($stagiaire->fin < now()) bg-orange-100 text-orange-800 dark:bg-orange-900 dark:text-orange-200
                                    @else bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                                    @endif">
                                    @if($stagiaire->debut <= now() && $stagiaire->fin >= now())
                                        En Stage
                                    @elseif($stagiaire->fin < now())
                                        Terminé
                                    @else
                                        À Venir
                                    @endif
                                </span>
                            </td>
                            <td class="py-3 px-4 text-gray-500 dark:text-gray-400">
                                {{ $stagiaire->debut->format('d/m/Y') }} - {{ $stagiaire->fin->format('d/m/Y') }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Stagiaire Progress Chart
    const stagiaireProgressCtx = document.getElementById('stagiaireProgressChart').getContext('2d');
    new Chart(stagiaireProgressCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($stagiaireProgressData['labels']) !!},
            datasets: [{
                label: 'Nouveaux Stagiaires',
                data: {!! json_encode($stagiaireProgressData['data']) !!},
                borderColor: '#f97316',
                backgroundColor: 'rgba(249, 115, 22, 0.1)',
                tension: 0.3,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });

    // Stagiaire Distribution Chart
    const stagiaireDistributionCtx = document.getElementById('stagiaireDistributionChart').getContext('2d');
    new Chart(stagiaireDistributionCtx, {
        type: 'doughnut',
        data: {
            labels: ['En Stage', 'Terminé', 'À Venir'],
            datasets: [{
                data: {!! json_encode($stagiaireDistribution) !!},
                backgroundColor: ['#22c55e', '#f97316', '#f59e0b'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            },
            cutout: '70%'
        }
    });
</script>
@endsection 