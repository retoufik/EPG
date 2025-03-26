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
                extend: {}
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
    </style>
    <script>
        // Check for saved dark mode preference or use system preference
        if (localStorage.getItem('darkMode') === 'true' || 
            (!('darkMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
    </script>
</head>
<body class="bg-gradient-to-br from-blue-50 to-orange-50 dark:from-gray-900 dark:to-gray-800 transition-colors duration-200">
    <!-- Dark Mode Toggle Button -->
    <div class="fixed top-4 right-4 z-50">
        <button id="darkModeToggle" 
                class="bg-white dark:bg-gray-800 p-2 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300">
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
                <div class="flex items-center">
                    <ul class="flex space-x-4">
                        <li>
                            <a href="{{ route('home') }}" class="text-white hover:text-blue-100 transition-colors">
                                <i class="fas fa-home mr-2"></i>Accueil
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('stagiaire.index') }}" 
                               class="text-white hover:bg-orange-700 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200">
                                <i class="fas fa-users mr-2"></i>Liste des stagiaires
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('stagiaire.create') }}" 
                               class="text-white bg-blue-600 hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200">
                                <i class="fas fa-plus-circle mr-2"></i>Ajouter un stagiaire
                            </a>
                        </li>
                    </ul>
                </div>
                
                @auth
                <div class="flex items-center space-x-4">
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
    </nav>

    <main class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Authentication Status Messages -->
            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif
            
            <!-- Error Messages -->
            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white rounded-lg shadow-md p-6">
                <h1 class="text-3xl font-bold text-orange-700 mb-6 border-b-2 border-blue-500 pb-2">
                    @yield('title', 'Gestion des stagiaires')
                </h1>
                @yield('content')
            </div>
        </div>
    </main>

    <!-- Dark Mode Toggle Script -->
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

        // Initialize dark mode on page load
        const isDark = localStorage.getItem('darkMode') === 'true';
        updateDarkMode(isDark);
    </script>
</body>
</html>