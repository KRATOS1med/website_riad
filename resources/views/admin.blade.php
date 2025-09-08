<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin - Riad Baroud</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header>
        <nav>
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            <!-- Ajoutez d'autres liens admin ici -->
        </nav>
    </header>
    <main>
        @yield('content')
    </main>
    <footer>
        <p>Administration &copy; {{ date('Y') }} Riad Baroud</p>
    </footer>
</body>
</html>