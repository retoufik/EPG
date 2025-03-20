<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - EPGCF</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-blue-50 to-orange-50 min-h-screen">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl w-full flex bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- School Information Section -->
            <div class="hidden md:block w-1/2 bg-gradient-to-b from-blue-800 to-orange-600 p-12 text-white">
                <div class="max-w-md mx-auto">
                <div class="flex items-center space-x-4">
                    <img src="{{ asset('logo.png') }}" alt="EPGCF Logo" class="h-24 flex-shrink-0">
                    <h1 class="text-xl font-bold"><br>École Polytechnique des Génies Competence Center Fès</h1>
                </div>
                <br><br>
                    <div class="space-y-6">
                        <div class="flex items-center space-x-4">
                            <i class="fas fa-graduation-cap text-2xl"></i>
                            <div>
                                <h3 class="text-xl font-semibold">Formations d'Excellence</h3>
                                <p class="text-sm opacity-90">Ingénierie, Technologie & Management</p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-4">
                            <i class="fas fa-microscope text-2xl"></i>
                            <div>
                                <h3 class="text-xl font-semibold">Laboratoires Modernes</h3>
                                <p class="text-sm opacity-90">Équipements de dernière génération</p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-4">
                            <i class="fas fa-handshake text-2xl"></i>
                            <div>
                                <h3 class="text-xl font-semibold">Partenariats Industriels</h3>
                                <p class="text-sm opacity-90">Collaboration avec les entreprises leaders</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-12 grid grid-cols-2 gap-4 text-center">
                        <div class="bg-white/10 p-4 rounded-lg">
                            <div class="text-2xl font-bold">200+</div>
                            <div class="text-sm">Étudiants</div>
                        </div>
                        <div class="bg-white/10 p-4 rounded-lg">
                            <div class="text-2xl font-bold">15+</div>
                            <div class="text-sm">Programmes</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Login Form Section -->
            <div class="w-full md:w-1/2 p-12">
                <div class="max-w-md mx-auto">
                    <h2 class="text-3xl font-bold text-blue-800 mb-8">Connexion</h2>
                    
                    <form method="POST" action="{{ route('login.post') }}" class="space-y-6">
                        @csrf

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Adresse Email</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-envelope text-gray-400"></i>
                                </div>
                                <input type="email" name="email" id="email" 
                                       class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 pr-3 py-3 border-gray-300 rounded-md"
                                       required autofocus>
                            </div>
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-gray-400"></i>
                                </div>
                                <input type="password" name="password" id="password" 
                                       class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 pr-3 py-3 border-gray-300 rounded-md"
                                       required>
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input type="checkbox" name="remember" id="remember" 
                                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="remember" class="ml-2 block text-sm text-gray-900">
                                    Se souvenir de moi
                                </label>
                            </div>
                        </div>

                        <button type="submit" 
                                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                            Se connecter
                        </button>

                        @if($errors->any())
                            <div class="mt-4 p-3 bg-red-50 border border-red-200 text-red-700 rounded-md">
                                {{ $errors->first() }}
                            </div>
                        @endif
                    </form>

                    <div class="mt-8 text-center">
                        <p class="text-sm text-gray-600">
                            Contactez l'administration pour 
                            <a href="mailto:support@epgcf.ma" class="text-blue-600 hover:text-blue-800">
                                obtenir un compte
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>