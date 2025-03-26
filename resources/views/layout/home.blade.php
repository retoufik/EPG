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
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 to-orange-50">
    <div class="min-h-screen">
        <!-- Hero Section -->
        <div class="relative overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="animate-fadeIn text-center">
                    <h1 class="text-4xl font-bold text-blue-900 mb-4 animate__animated animate__fadeInDown">
                        École Polytechnique des Génies
                    </h1>
                    <p class="text-xl text-orange-600 mb-8 animate__animated animate__fadeInUp">
                        Former les leaders de demain
                    </p>
                </div>
            </div>
        </div>

        <!-- Features Grid -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Formation -->
                <div class="bg-white p-6 rounded-xl shadow-lg transform hover:scale-105 transition-transform duration-300 animate__animated animate__fadeInLeft">
                    <div class="text-blue-900 text-xl font-semibold mb-4">Formation</div>
                    <p class="text-gray-600">
                        Des programmes d'études innovants adaptés aux besoins du marché du travail.
                    </p>
                </div>

                <!-- Recherche -->
                <div class="bg-white p-6 rounded-xl shadow-lg transform hover:scale-105 transition-transform duration-300 animate__animated animate__fadeInUp">
                    <div class="text-orange-600 text-xl font-semibold mb-4">Recherche</div>
                    <p class="text-gray-600">
                        Des laboratoires de pointe pour la recherche et l'innovation.
                    </p>
                </div>

                <!-- International -->
                <div class="bg-white p-6 rounded-xl shadow-lg transform hover:scale-105 transition-transform duration-300 animate__animated animate__fadeInRight">
                    <div class="text-blue-900 text-xl font-semibold mb-4">International</div>
                    <p class="text-gray-600">
                        Des partenariats avec des universités du monde entier.
                    </p>
                </div>
            </div>
        </div>

        <!-- Navigation Cards -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @auth
                    <!-- Dashboard Card -->
                    <a href="{{ route('stagiaire.index') }}" 
                       class="group bg-white p-6 rounded-xl shadow-lg transform hover:scale-105 transition-all duration-300 animate__animated animate__fadeInLeft">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-2xl font-bold text-blue-900 group-hover:text-orange-600 transition-colors">
                                    Tableau de bord
                                </h3>
                                <p class="text-gray-600 mt-2">
                                    Accédez à votre espace de gestion des stagiaires
                                </p>
                            </div>
                            <div class="text-4xl text-orange-600 group-hover:text-blue-900 transition-colors">
                                →
                            </div>
                        </div>
                    </a>
                @else
                    <!-- Login Card -->
                    <a href="{{ route('login') }}" 
                       class="group bg-white p-6 rounded-xl shadow-lg transform hover:scale-105 transition-all duration-300 animate__animated animate__fadeInRight">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-2xl font-bold text-blue-900 group-hover:text-orange-600 transition-colors">
                                    Connexion
                                </h3>
                                <p class="text-gray-600 mt-2">
                                    Connectez-vous pour accéder à votre espace
                                </p>
                            </div>
                            <div class="text-4xl text-orange-600 group-hover:text-blue-900 transition-colors">
                                →
                            </div>
                        </div>
                    </a>
                @endauth
            </div>
        </div>

        <!-- Statistics Section -->
        <div class="bg-gradient-to-r from-blue-900 to-orange-600 py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-white text-center">
                    <div class="float-animation">
                        <div class="text-4xl font-bold mb-2">1000+</div>
                        <div class="text-sm uppercase">Étudiants</div>
                    </div>
                    <div class="float-animation" style="animation-delay: 0.2s">
                        <div class="text-4xl font-bold mb-2">50+</div>
                        <div class="text-sm uppercase">Professeurs</div>
                    </div>
                    <div class="float-animation" style="animation-delay: 0.4s">
                        <div class="text-4xl font-bold mb-2">30+</div>
                        <div class="text-sm uppercase">Programmes</div>
                    </div>
                    <div class="float-animation" style="animation-delay: 0.6s">
                        <div class="text-4xl font-bold mb-2">95%</div>
                        <div class="text-sm uppercase">Taux d'emploi</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 text-center">
            <h2 class="text-3xl font-bold text-blue-900 mb-8 animate__animated animate__fadeInUp">
                Contactez-nous
            </h2>
            <div class="flex justify-center space-x-8">
                <div class="text-orange-600">
                    <div class="font-semibold">Adresse</div>
                    <p>123 Avenue Mohammed V, Casablanca</p>
                </div>
                <div class="text-blue-900">
                    <div class="font-semibold">Email</div>
                    <p>contact@epg.ma</p>
                </div>
                <div class="text-orange-600">
                    <div class="font-semibold">Téléphone</div>
                    <p>+212 5XX-XXXXXX</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>