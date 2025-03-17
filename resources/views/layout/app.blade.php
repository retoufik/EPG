<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Gestion des stagiaires</title>
</head>
<body class="bg-blue-50">
    <nav class="bg-orange-600 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <ul class="flex space-x-4">
                        <li>
                            <a href="{{ route('home') }}">
                            <img src="{{ asset('images.png')}}" alt="Logo" class="h-8"></a>
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
                
                <!-- Authentication Links -->
                <div class="flex items-center">
                    @auth
                    <ul class="flex space-x-4">
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" 
                                        class="text-white hover:bg-orange-700 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200">
                                    <i class="fas fa-sign-out-alt mr-2"></i>Déconnexion
                                </button>
                            </form>
                        </li>
                    </ul>
                    @endauth
                </div>
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
</body>
</html>