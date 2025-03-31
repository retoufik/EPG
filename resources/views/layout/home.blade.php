<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>École Polytechnique des Génies</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
        .float-animation {
            animation: float 3s ease-in-out infinite;
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
        @media (max-width: 768px) {
            .hero-section {
                padding: 2rem 1rem;
            }
            .features-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1rem;
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

    <div class="min-h-screen">
        <div class="relative overflow-hidden hero-section">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="animate-fadeIn text-center">
                    <h1 class="text-4xl md:text-5xl font-bold text-blue-900 dark:text-blue-400 mb-4 animate__animated animate__fadeInDown">
                        École Polytechnique des Génies
                    </h1>
                    <p class="text-xl md:text-2xl text-orange-600 dark:text-orange-400 mb-8 animate__animated animate__fadeInUp">
                        Former les leaders de demain
                    </p>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-xl shadow-lg transform hover:scale-105 transition-transform duration-300 animate__animated animate__fadeInLeft dark:bg-gray-900">
                    <div class="text-blue-900 text-xl font-semibold mb-4 dark:text-blue-400">Services</div>
                    <p class="text-gray-600">
                        <ul class="list-disc list-inside dark:text-white">
                            <li>Développement web</li>
                            <li>Développement mobile</li>
                            <li>Référencement web</li>
                            <li>Création vidéo motion design</li>
                    </p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-lg transform hover:scale-105 transition-transform duration-300 animate__animated animate__fadeInUp dark:bg-gray-900">
                    <div class="text-orange-600 text-xl font-semibold mb-4">Diplôme et Formations</div>
                    <p class="text-gray-600 dark:text-white">
                        Notre établissement propose une gamme complète de formations, du Qualification au Master, 
                        en passant par le Technicien Supérieur et la Licence Professionnelle, ainsi que des programmes 
                        de formation continue adaptés aux besoins du marché.
                    </p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-lg transform hover:scale-105 transition-transform duration-300 animate__animated animate__fadeInRight dark:bg-gray-900">
                    <div class="text-blue-900 text-xl font-semibold mb-4 dark:text-blue-400">Langues</div>
                    <p class="text-gray-600">
                        <ul class="list-disc list-inside dark:text-white">
                            <li>Anglais</li>
                            <li>Français</li>
                            <li>Allemand</li>
                        </ul>
                    </p>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @auth
                    <a href="{{ route('stagiaire.index') }}" 
                       class="group glass-effect p-6 rounded-xl shadow-lg transform hover:scale-105 transition-all duration-300 animate__animated animate__fadeInLeft">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-2xl font-bold text-blue-900 dark:text-blue-400 group-hover:text-orange-600 dark:group-hover:text-orange-400 transition-colors">
                                    Tableau de bord
                                </h3>
                                <p class="text-gray-600 dark:text-gray-300 mt-2">
                                    Accédez à votre espace de gestion des stagiaires
                                </p>
                            </div>
                            <div class="text-4xl text-orange-600 dark:text-orange-400 group-hover:text-blue-900 dark:group-hover:text-blue-400 transition-colors">
                                →
                            </div>
                        </div>
                    </a>
                @else
                    <a href="{{ route('login') }}" 
                       class="group glass-effect p-6 rounded-xl shadow-lg transform hover:scale-105 transition-all duration-300 animate__animated animate__fadeInRight">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-2xl font-bold text-blue-900 dark:text-blue-400 group-hover:text-orange-600 dark:group-hover:text-orange-400 transition-colors">
                                    Connexion
                                </h3>
                                <p class="text-gray-600 dark:text-gray-300 mt-2">
                                    Connectez-vous pour accéder à votre espace
                                </p>
                            </div>
                            <div class="text-4xl text-orange-600 dark:text-orange-400 group-hover:text-blue-900 dark:group-hover:text-blue-400 transition-colors">
                                →
                            </div>
                        </div>
                    </a>
                @endauth
            </div>
        </div>

        <div class="bg-gradient-to-r from-blue-900 to-orange-600 py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-white text-center stats-grid">
                    <div class="float-animation glass-effect p-6 rounded-xl">
                        <div class="text-4xl font-bold mb-2">1000+</div>
                        <div class="text-sm uppercase">Étudiants</div>
                    </div>
                    <div class="float-animation glass-effect p-6 rounded-xl" style="animation-delay: 0.2s">
                        <div class="text-4xl font-bold mb-2">50+</div>
                        <div class="text-sm uppercase">Professeurs</div>
                    </div>
                    <div class="float-animation glass-effect p-6 rounded-xl" style="animation-delay: 0.4s">
                        <div class="text-4xl font-bold mb-2">30+</div>
                        <div class="text-sm uppercase">Programmes</div>
                    </div>
                    <div class="float-animation glass-effect p-6 rounded-xl" style="animation-delay: 0.6s">
                        <div class="text-4xl font-bold mb-2">95%</div>
                        <div class="text-sm uppercase">Taux d'emploi</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 text-center">
            <h2 class="text-3xl font-bold text-blue-900 dark:text-blue-400 mb-8 animate__animated animate__fadeInUp">
                Contactez-nous
            </h2>
            <div class="flex justify-center space-x-8">
                <div class="text-orange-600">
                    <div class="font-semibold">Adresse</div>
                    <p>22, Rue Mohammed Hayani V.N Fés 4éme Etage Imm Hazzaz.</p>
                </div>
                <div class="glass-effect p-6 rounded-xl">
                    <div class="text-blue-900 dark:text-blue-400 font-semibold">Email</div>
                    <p class="text-gray-600 dark:text-gray-300">contact@epg.ma</p>
                </div>
                <div class="text-orange-600">
                    <div class="font-semibold">Fixe</div>
                    <p>+212 535-621-865</p>
                </div>
                <div class="text-orange-600">
                    <div class="font-semibold">Téléphone</div>
                    <p>+212 619-086-666</p>
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