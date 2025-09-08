<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Riad Authentique</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-brown: #8B4513;
            --secondary-brown: #A0522D;
            --light-brown: #D2B48C;
            --dark-brown: #654321;
            --cream: #FDF5E6;
            --gold: #DAA520;
            --text-dark: #2c1810;
            --text-light: #6b4423;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            color: var(--text-dark);
            line-height: 1.6;
            background-color: var(--cream);
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif;
            font-weight: 600;
        }

        /* Header Styles */
        .header {
            background: linear-gradient(135deg, var(--dark-brown) 0%, var(--primary-brown) 100%);
            color: white;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 4px 20px rgba(139, 69, 19, 0.3);
        }

        .header-top {
            background: rgba(0, 0, 0, 0.2);
            padding: 8px 0;
            font-size: 0.875rem;
        }

        .header-main {
            padding: 1rem 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            color: var(--gold);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nav {
            display: flex;
            list-style: none;
            gap: 2rem;
        }

        .nav a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
            padding: 0.5rem 0;
        }

        .nav a:hover {
            color: var(--gold);
        }

        .nav a::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--gold);
            transition: width 0.3s ease;
        }

        .nav a:hover::after {
            width: 100%;
        }

        .header-actions {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 5px;
            font-weight: 500;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
            cursor: pointer;
            text-align: center;
        }

        .btn-primary {
            background: var(--gold);
            color: var(--dark-brown);
        }

        .btn-primary:hover {
            background: #B8860B;
            transform: translateY(-2px);
        }

        .btn-outline {
            border: 2px solid white;
            color: white;
            background: transparent;
        }

        .btn-outline:hover {
            background: white;
            color: var(--primary-brown);
        }

        /* Main Content */
        .main-content {
            min-height: calc(100vh - 200px);
            padding: 2rem 0;
        }

        /* Footer */
        .footer {
            background: var(--dark-brown);
            color: white;
            padding: 3rem 0 1rem;
            margin-top: 4rem;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .footer-section h3 {
            color: var(--gold);
            margin-bottom: 1rem;
        }

        .footer-section p, .footer-section a {
            color: #ccc;
            text-decoration: none;
            margin-bottom: 0.5rem;
            display: block;
        }

        .footer-section a:hover {
            color: var(--gold);
        }

        .footer-bottom {
            border-top: 1px solid #555;
            padding-top: 1rem;
            text-align: center;
            color: #999;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                gap: 1rem;
            }

            .nav {
                flex-wrap: wrap;
                justify-content: center;
                gap: 1rem;
            }

            .header-actions {
                flex-direction: column;
                width: 100%;
            }

            .container {
                padding: 0 15px;
            }
        }
    </style>
    @yield('styles')
</head>
<body>
    <header class="header">
        <div class="header-top">
            <div class="container">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <i class="fas fa-phone"></i> +212 524 123 456 | 
                        <i class="fas fa-envelope"></i> info@riad-authentique.com
                    </div>
                    <div>
                        <i class="fas fa-map-marker-alt"></i> Marrakech, Médina
                    </div>
                </div>
            </div>
        </div>
        <div class="header-main">
            <div class="container">
                <div class="header-content">
                    <a href="{{ route('home') }}" class="logo">
                        <i class="fas fa-mosque"></i>
                        Riad Authentique
                    </a>
                    <nav>
                        <ul class="nav">
                            <li><a href="{{ route('home') }}">Accueil</a></li>
                            <li><a href="{{ route('chambres.index') }}">Chambres</a></li>
                            <li><a href="{{ route('services.index') }}">Services</a></li>
                            <li><a href="{{ route('contact') }}">Contact</a></li>
                        </ul>
                    </nav>
                    <div class="header-actions">
                        <a href="{{ route('reservations.create') }}" class="btn btn-primary">Réserver</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="main-content">
        @yield('content')
    </main>

    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>Riad Authentique</h3>
                    <p>Découvrez l'hospitalité marocaine authentique dans notre riad traditionnel au cœur de la médina de Marrakech.</p>
                </div>
                <div class="footer-section">
                    <h3>Liens Rapides</h3>
                    <a href="{{ route('home') }}">Accueil</a>
                    <a href="{{ route('chambres.index') }}">Chambres</a>
                    <a href="{{ route('services.index') }}">Services</a>
                    <a href="{{ route('contact') }}">Contact</a>
                </div>
                <div class="footer-section">
                    <h3>Contact</h3>
                    <p><i class="fas fa-map-marker-alt"></i> Derb Sidi Ahmed Soussi, Médina, Marrakech</p>
                    <p><i class="fas fa-phone"></i> +212 524 123 456</p>
                    <p><i class="fas fa-envelope"></i> info@riad-authentique.com</p>
                </div>
                <div class="footer-section">
                    <h3>Suivez-nous</h3>
                    <div style="display: flex; gap: 1rem; font-size: 1.2rem;">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-tripadvisor"></i></a>
                        <a href="#"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2024 Riad Authentique. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    @yield('scripts')
</body>
</html>