<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Riad Baroud - Laravel')</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> <!-- Compiled CSS -->
    <style>
        /* Fallback Inline Styles (Remove after npm run build works) */
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #f7f7f7; margin: 0; padding: 0; line-height: 1.6; color: #333; }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }
        .navbar { background: #ff6b35; color: white; padding: 15px 0; box-shadow: 0 2px 10px rgba(0,0,0,0.1); position: sticky; top: 0; z-index: 100; }
        .nav-content { display: flex; justify-content: space-between; align-items: center; }
        .logo { height: 50px; width: auto; }
        .nav-menu { list-style: none; display: flex; gap: 30px; margin: 0; padding: 0; }
        .nav-link { color: white; text-decoration: none; font-weight: 500; transition: color 0.3s; }
        .nav-link:hover { color: #daa520; }
        .btn-reservation { background: white; color: #ff6b35 !important; padding: 10px 20px; border-radius: 25px; font-weight: bold; text-decoration: none; transition: background 0.3s; }
        .btn-reservation:hover { background: #f0f0f0; }
        .hero-section { position: relative; margin-bottom: 40px; height: 400px; overflow: hidden; }
        .hero-image { width: 100%; height: 100%; object-fit: cover; }
        .hero-text { position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background: rgba(0,0,0,0.5); padding: 20px 40px; border-radius: 10px; color: white; text-align: center; }
        .hero-text h2 { font-size: 2.5rem; margin: 0 0 10px 0; font-family: 'Playfair Display', serif; }
        .section { padding: 60px 0; }
        .section-title { font-size: 2.5rem; color: #ff6b35; text-align: center; margin-bottom: 40px; font-family: 'Playfair Display', serif; }
        .rooms-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 30px; justify-content: center; }
        .room-card { background: white; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); padding: 20px; text-align: center; transition: transform 0.3s; }
        .room-card:hover { transform: translateY(-5px); }
        .room-image { width: 100%; height: 200px; object-fit: cover; border-radius: 8px; margin-bottom: 15px; }
        .room-title { font-size: 1.3rem; color: #ff6b35; margin-bottom: 10px; }
        .room-description { color: #666; margin-bottom: 15px; }
        .room-price { font-size: 1.2rem; font-weight: bold; color: #daa520; margin-bottom: 15px; }
        .services-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 30px; justify-content: center; }
        .service-card { background: white; border-radius: 12px; padding: 30px; text-align: center; box-shadow: 0 4px 12px rgba(0,0,0,0.1); transition: transform 0.3s; }
        .service-card:hover { transform: translateY(-5px); }
        .service-icon { font-size: 3rem; color: #ff6b35; margin-bottom: 15px; }
        .contact-form { max-width: 500px; margin: 0 auto; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
        .form-input, .form-textarea { width: 100%; padding: 12px; margin-bottom: 15px; border: 1px solid #ddd; border-radius: 6px; font-size: 1rem; }
        .form-textarea { height: 120px; resize: vertical; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 15px; }
        .footer { background: #ff6b35; color: white; text-align: center; padding: 20px 0; margin-top: 40px; }
        @media (max-width: 768px) { .nav-menu { display: none; } .form-row { grid-template-columns: 1fr; } .rooms-grid, .services-grid { grid-template-columns: 1fr; } .hero-text h2 { font-size: 2rem; } }
    </style>
    @yield('styles')
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="container">
            <div class="nav-content">
                <a href="/" class="logo-link">
                    <img src="{{ asset('images/Logo.jpg') }}" alt="Riad Baroud" class="logo">
                </a>
                <ul class="nav-menu">
                    <li><a href="#accueil" class="nav-link scroll-smooth">Accueil</a></li>
                    <li><a href="#chambres" class="nav-link scroll-smooth">Chambres & suites</a></li>
                    <li><a href="#services" class="nav-link scroll-smooth">Les services</a></li>
                    <li><a href="#contact" class="nav-link scroll-smooth">Contact</a></li>
                </ul>
                <a href="{{ route('reservations.create') }}" class="btn-reservation">Réservation</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2025 Riad Baroud. All rights reserved.</p>
        </div>
    </footer>

    @yield('scripts')
    <!-- Smooth Scroll Script -->
    <script>
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>
</body>
</html>