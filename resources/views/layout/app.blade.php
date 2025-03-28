<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('images.jpg') }}" type="image/x-icon">
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
        .dark body {
            background: linear-gradient(to bottom right, #1e3a8a, #1e40af);
            color: #fff;
        }
        .dark .bg-white {
            background-color: #1f2937;
            color: #fff;
        }
        .dark .text-gray-600 {
            color: #d1d5db;
        }
        .dark .text-blue-900 {
            color: #60a5fa;
        }
        .dark .text-orange-600 {
            color: #fb923c;
        }
        .dark .text-orange-700 {
            color: #fb923c;
        }
        .dark .bg-orange-600 {
            background-color: #1f2937;
        }
        .dark .border-blue-500 {
            border-color: #60a5fa;
        }
        .dark .bg-blue-600 {
            background-color: #2563eb;
        }
        .dark .bg-blue-900 {
            background-color: #1e3a8a;
        }
        .dark .shadow-md {
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.3);
        }
        .dark .text-green-600 {
            color: #34d399;
        }
        .dark .bg-red-100 {
            background-color: #7f1d1d;
        }
        .dark .border-red-400 {
            border-color: #f87171;
        }
        .dark .text-red-700 {
            color: #fca5a5;
        }

        @media (max-width: 768px) {
            .nav-menu {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.9);
                z-index: 50;
                padding: 2rem;
            }
            .nav-menu.active {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
            }
            .nav-menu a {
                margin: 1rem 0;
                font-size: 1.5rem;
            }
        }

        .transition-all {
            transition: all 0.3s ease-in-out;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .dark .glass-effect {
            background: rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
    </style>
    <script>
        if (localStorage.getItem('darkMode') === 'true' || 
            (!('darkMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
    </script>
</head>
<body class="bg-gradient-to-br from-blue-50 to-orange-50 dark:from-gray-900 dark:to-gray-800 transition-colors duration-200">
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

    <nav class="bg-orange-600 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center md:hidden">
                    <button id="mobile-menu-button" class="text-white hover:text-blue-100 focus:outline-none">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                </div>
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <img src="{{ asset('logo.png') }}" alt="Logo" class="h-8 w-auto">
                    </div>
                    <div class="hidden md:block ml-10">
                        <div class="flex space-x-4">
                            <a href="{{ route('home') }}" class="text-white hover:text-blue-100 transition-colors px-3 py-2 rounded-md text-sm font-medium">
                                <i class="fas fa-home mr-2"></i>Accueil
                            </a>
                            <a href="{{ route('stagiaire.index') }}" 
                               class="text-white hover:bg-orange-700 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200">
                                <i class="fas fa-users mr-2"></i>Liste des stagiaires
                            </a>
                            <a href="{{ route('stagiaire.create') }}" 
                               class="text-white bg-blue-600 hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200">
                                <i class="fas fa-plus-circle mr-2"></i>Ajouter un stagiaire
                            </a>
                        </div>
                    </div>
                </div>
                
                @auth
                <div class="hidden md:flex items-center space-x-4">
                    <span class="text-white">
                        Bienvenue, {{ Auth::user()->name }}
                    </span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" 
                                class="text-white bg-blue-900 hover:bg-blue-800 px-4 py-2 rounded-lg transition-colors">
                            <i class="fas fa-sign-out-alt mr-2"></i>Déconnexion
                        </button>
                    </form>
                </div>
                @endauth
            </div>
        </div>

        <div id="mobile-menu" class="nav-menu md:hidden">
            <div class="flex flex-col items-center space-y-4">
                <a href="{{ route('home') }}" class="text-white text-xl hover:text-blue-100 transition-colors">
                    <i class="fas fa-home mr-2"></i>Accueil
                </a>
                <a href="{{ route('stagiaire.index') }}" class="text-white text-xl hover:text-blue-100 transition-colors">
                    <i class="fas fa-users mr-2"></i>Liste des stagiaires
                </a>
                <a href="{{ route('stagiaire.create') }}" class="text-white text-xl hover:text-blue-100 transition-colors">
                    <i class="fas fa-plus-circle mr-2"></i>Ajouter un stagiaire
                </a>
                @auth
                <div class="mt-4">
                    <span class="text-white text-xl">Bienvenue, {{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="mt-4">
                        @csrf
                        <button type="submit" 
                                class="text-white bg-blue-900 hover:bg-blue-800 px-6 py-3 rounded-lg transition-colors text-xl">
                            <i class="fas fa-sign-out-alt mr-2"></i>Déconnexion
                        </button>
                    </form>
                </div>
                @endauth
            </div>
        </div>
    </nav>

    <main class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="mb-4 p-4 bg-green-100 dark:bg-green-900 border border-green-400 dark:border-green-700 text-green-700 dark:text-green-200 rounded-lg">
                    {{ session('status') }}
                </div>
            @endif
            
            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 dark:bg-red-900 border border-red-400 dark:border-red-700 text-red-700 dark:text-red-200 rounded-lg">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 transition-colors duration-200">
                <h1 class="text-3xl font-bold text-orange-700 dark:text-orange-500 mb-6 border-b-2 border-blue-500 pb-2">
                    @yield('title', 'Gestion des stagiaires')
                </h1>
                @yield('content')
            </div>
        </div>
    </main>

    <script>
        const darkModeToggle = document.getElementById('darkModeToggle');
        
        function updateDarkMode(isDark) {
            if (isDark) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
            localStorage.setItem('darkMode', isDark);
        }
        
        darkModeToggle.addEventListener('click', () => {
            const isDark = !document.documentElement.classList.contains('dark');
            updateDarkMode(isDark);
        });

        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('active');
        });

        document.addEventListener('click', (e) => {
            if (!mobileMenu.contains(e.target) && !mobileMenuButton.contains(e.target)) {
                mobileMenu.classList.remove('active');
            }
        });

        const isDark = localStorage.getItem('darkMode') === 'true';
        updateDarkMode(isDark);
    </script>
</body>
</html>