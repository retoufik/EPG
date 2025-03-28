<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>École Polytechnique des Génies</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
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
</head>
<body class="bg-gradient-to-br from-blue-50 to-orange-50 dark:from-gray-900 dark:to-gray-800 transition-colors duration-200">
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
                <!-- Service -->
                <div class="bg-white p-6 rounded-xl shadow-lg transform hover:scale-105 transition-transform duration-300 animate__animated animate__fadeInLeft">
                    <div class="text-blue-900 text-xl font-semibold mb-4">Services</div>
                    <p class="text-gray-600">
                        <ul class="list-disc list-inside">
                            <li>Développement web</li>
                            <li>Développement mobile</li>
                            <li>Référencement web</li>
                            <li>Création vidéo motion design</li>
                    </p>
                </div>

                <!-- Diplome et formation -->
                <div class="bg-white p-6 rounded-xl shadow-lg transform hover:scale-105 transition-transform duration-300 animate__animated animate__fadeInUp">
                    <div class="text-orange-600 text-xl font-semibold mb-4">Diplôme et Formations</div>
                    <p class="text-gray-600">
                        Notre établissement propose une gamme complète de formations, du Qualification au Master, 
                        en passant par le Technicien Supérieur et la Licence Professionnelle, ainsi que des programmes 
                        de formation continue adaptés aux besoins du marché.
                    </p>
                </div>

                <!-- Langues -->
                <div class="bg-white p-6 rounded-xl shadow-lg transform hover:scale-105 transition-transform duration-300 animate__animated animate__fadeInRight">
                    <div class="text-blue-900 text-xl font-semibold mb-4">Langues</div>
                    <p class="text-gray-600">
                        <ul class="list-disc list-inside">
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
</body>
</html>