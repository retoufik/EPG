<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - EPGCF</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            800: '#075985',
                            900: '#0c4a6e',
                        },
                        secondary: {
                            50: '#fff7ed',
                            100: '#ffedd5',
                            200: '#fed7aa',
                            300: '#fdba74',
                            400: '#fb923c',
                            500: '#f97316',
                            600: '#ea580c',
                            700: '#c2410c',
                            800: '#9a3412',
                            900: '#7c2d12',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .dark .glass-effect {
            background: rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        @media (max-width: 768px) {
            .login-container {
                margin: 1rem;
                padding: 1rem;
            }
            .info-section {
                display: none;
            }
        }
    </style>
    <script>
        if (localStorage.getItem('darkMode') === 'true' || 
            (!('darkMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
    </script>
</head>
<body class="bg-gradient-to-r from-blue-50 to-orange-50 min-h-screen dark:from-gray-900 dark:to-gray-800 transition-colors duration-200">
    <!-- Dark Mode Toggle Button -->
    <div class="fixed top-4 right-4 z-50">
        <button id="darkModeToggle" 
                class="glass-effect p-2 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300">
            <svg id="lightIcon" class="w-6 h-6 text-orange-500 hidden dark:block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
            <svg id="darkIcon" class="w-6 h-6 text-blue-900 block dark:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
            </svg>
        </button>
    </div>

    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl w-full flex bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden">
            <!-- Info Section -->
            <div class="hidden md:block w-1/2 bg-gradient-to-b from-blue-800 to-orange-600 p-12 text-white">
                <div class="max-w-md mx-auto">
                    <div class="flex items-center space-x-4 mb-8">
                        <img src="{{ asset('logo.png') }}" alt="EPGCF Logo" class="h-24 flex-shrink-0">
                        <h1 class="text-xl font-bold">École Polytechnique des Génies<br>Competence Center Fès</h1>
                    </div>
                    
                    <div class="space-y-6">
                        <div class="flex items-center space-x-4 glass-effect p-4 rounded-lg">
                            <i class="fas fa-graduation-cap text-2xl"></i>
                            <div>
                                <h3 class="text-xl font-semibold">Formations d'Excellence</h3>
                                <p class="text-sm opacity-90">Ingénierie, Technologie & Management</p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-4 glass-effect p-4 rounded-lg">
                            <i class="fas fa-microscope text-2xl"></i>
                            <div>
                                <h3 class="text-xl font-semibold">Laboratoires Modernes</h3>
                                <p class="text-sm opacity-90">Équipements de dernière génération</p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-4 glass-effect p-4 rounded-lg">
                            <i class="fas fa-handshake text-2xl"></i>
                            <div>
                                <h3 class="text-xl font-semibold">Partenariats Industriels</h3>
                                <p class="text-sm opacity-90">Collaboration avec les entreprises leaders</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-12 grid grid-cols-2 gap-4 text-center">
                        <div class="glass-effect p-4 rounded-lg">
                            <div class="text-2xl font-bold">200+</div>
                            <div class="text-sm">Étudiants</div>
                        </div>
                        <div class="glass-effect p-4 rounded-lg">
                            <div class="text-2xl font-bold">15+</div>
                            <div class="text-sm">Programmes</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full md:w-1/2 p-8 md:p-12">
                <div class="max-w-md mx-auto">
                    <div class="md:hidden mb-8 text-center">
                        <img src="{{ asset('logo.png') }}" alt="EPGCF Logo" class="h-16 mx-auto mb-4">
                        <h1 class="text-2xl font-bold text-blue-800 dark:text-blue-400">École Polytechnique des Génies</h1>
                    </div>
                    
                    <h2 class="text-3xl font-bold text-blue-800 dark:text-blue-400 mb-8">Connexion</h2>
                    
                    <form method="POST" action="{{ route('login.post') }}" class="space-y-6">
                        @csrf

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Adresse Email</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-envelope text-gray-400"></i>
                                </div>
                                <input type="email" name="email" id="email" 
                                       class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 pr-3 py-3 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md"
                                       required autofocus>
                            </div>
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Mot de passe</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-gray-400"></i>
                                </div>
                                <input type="password" name="password" id="password" 
                                       class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 pr-3 py-3 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md"
                                       required>
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input type="checkbox" name="remember" id="remember" 
                                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 dark:border-gray-600 rounded">
                                <label for="remember" class="ml-2 block text-sm text-gray-900 dark:text-gray-300">
                                    Se souvenir de moi
                                </label>
                            </div>
                        </div>

                        <button type="submit" 
                                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                            Se connecter
                        </button>

                        @if($errors->any())
                            <div class="mt-4 p-3 bg-red-50 dark:bg-red-900 border border-red-200 dark:border-red-700 text-red-700 dark:text-red-200 rounded-md">
                                {{ $errors->first() }}
                            </div>
                        @endif
                    </form>

                    <div class="mt-8 text-center">
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            Contactez l'administration pour 
                            <a href="mailto:support@epgcf.ma" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300">
                                obtenir un compte
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('darkModeToggle').addEventListener('click', function() {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('darkMode', 'false');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('darkMode', 'true');
            }
        });
    </script>
</body>
</html>