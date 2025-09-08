# Services Index View (services/index.blade.php)

@extends('layouts.app')

@section('title', 'Nos Services')

@section('styles')
<style>
    .services-hero {
        background: linear-gradient(rgba(139, 69, 19, 0.6), rgba(101, 67, 33, 0.7)),
                    url('https://images.unsplash.com/photo-1590381105924-c72589b9ef3f?ixlib=rb-4.0.3&auto=format&fit=crop&w=2071&q=80') center/cover;
        height: 50vh;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-align: center;
    }

    .services-hero h1 {
        font-size: 3rem;
        margin-bottom: 1rem;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
    }

    .services-content {
        padding: 4rem 0;
        background: var(--cream);
    }

    .services-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
    }

    .service-card {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        box-shadow: 0 15px 35px rgba(139, 69, 19, 0.1);
        transition: all 0.3s ease;
        text-align: center;
    }

    .service-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 25px 50px rgba(139, 69, 19, 0.2);
    }

    .service-icon {
        font-size: 3rem;
        color: var(--primary-brown);
        margin-bottom: 1rem;
    }

    .service-card h3 {
        color: var(--primary-brown);
        margin-bottom: 1rem;
        font-size: 1.5rem;
    }

    .service-price {
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--gold);
        margin-top: 1rem;
    }
</style>
@endsection

@section('content')
<section class="services-hero">
    <div class="container">
        <h1>Nos Services</h1>
        <p>Découvrez tous les services pour rendre votre séjour inoubliable</p>
    </div>
</section>

<section class="services-content">
    <div class="container">
        <div class="services-grid">
            @foreach($services as $service)
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-spa"></i>
                    </div>
                    <h3>{{ $service->nom }}</h3>
                    <p>{{ $service->description }}</p>
                    <div class="service-price">{{ number_format($service->prix, 0, ',', ' ') }} MAD</div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection

---

# About View (about.blade.php)

@extends('layouts.app')

@section('title', 'À Propos')

@section('content')
<section style="padding: 4rem 0; background: var(--cream);">
    <div class="container">
        <div style="max-width: 800px; margin: 0 auto; text-align: center;">
            <h1 style="color: var(--primary-brown); font-size: 2.5rem; margin-bottom: 2rem;">À Propos de Notre Riad</h1>
            <p style="font-size: 1.2rem; color: var(--text-light); line-height: 1.8;">
                Notre riad authentique vous offre une expérience unique au cœur de la médina de Marrakech. 
                Nous combinons l'hospitalité marocaine traditionnelle avec le confort moderne pour créer 
                des souvenirs inoubliables.
            </p>
        </div>
    </div>
</section>
@endsection

---

# Gallery View (gallery.blade.php)

@extends('layouts.app')

@section('title', 'Galerie')

@section('styles')
<style>
    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1rem;
        padding: 2rem 0;
    }

    .gallery-item {
        aspect-ratio: 4/3;
        overflow: hidden;
        border-radius: 10px;
        box-shadow: 0 10px 30px rgba(139, 69, 19, 0.1);
        transition: transform 0.3s ease;
    }

    .gallery-item:hover {
        transform: scale(1.05);
    }

    .gallery-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>
@endsection

@section('content')
<section style="padding: 4rem 0; background: var(--cream);">
    <div class="container">
        <h1 style="text-align: center; color: var(--primary-brown); margin-bottom: 2rem;">Galerie Photos</h1>
        <div class="gallery-grid">
            @foreach($chambres as $chambre)
                @if($chambre->photos)
                    @foreach(explode(',', $chambre->photos) as $photo)
                        <div class="gallery-item">
                            <img src="{{ asset('storage/' . $photo) }}" alt="{{ $chambre->nom }}">
                        </div>
                    @endforeach
                @endif
            @endforeach
        </div>
    </div>
</section>
@endsection

---

# Contact View (contact.blade.php)

@extends('layouts.app')

@section('title', 'Contact')

@section('styles')
<style>
    .contact-content {
        padding: 4rem 0;
        background: var(--cream);
    }

    .contact-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 3rem;
        max-width: 1000px;
        margin: 0 auto;
    }

    .contact-form {
        background: white;
        padding: 2rem;
        border-radius: 15px;
        box-shadow: 0 15px 35px rgba(139, 69, 19, 0.1);
    }

    .contact-info {
        background: var(--primary-brown);
        color: white;
        padding: 2rem;
        border-radius: 15px;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 600;
        color: var(--text-dark);
    }

    .form-control {
        width: 100%;
        padding: 0.75rem;
        border: 2px solid #e0e0e0;
        border-radius: 5px;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--primary-brown);
        box-shadow: 0 0 0 3px rgba(139, 69, 19, 0.1);
    }

    textarea.form-control {
        min-height: 120px;
        resize: vertical;
    }
</style>
@endsection

@section('content')
<section class="contact-content">
    <div class="container">
        <h1 style="text-align: center; color: var(--primary-brown); margin-bottom: 3rem;">Contactez-Nous</h1>
        
        <div class="contact-grid">
            <div class="contact-form">
                <h3 style="color: var(--primary-brown); margin-bottom: 1.5rem;">Envoyez-nous un Message</h3>
                
                <form action="{{ route('contact.send') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nom">Nom *</label>
                        <input type="text" id="nom" name="nom" class="form-control" required value="{{ old('nom') }}">
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email *</label>
                        <input type="email" id="email" name="email" class="form-control" required value="{{ old('email') }}">
                    </div>
                    
                    <div class="form-group">
                        <label for="sujet">Sujet *</label>
                        <input type="text" id="sujet" name="sujet" class="form-control" required value="{{ old('sujet') }}">
                    </div>
                    
                    <div class="form-group">
                        <label for="message">Message *</label>
                        <textarea id="message" name="message" class="form-control" required>{{ old('message') }}</textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-primary" style="width: 100%;">
                        <i class="fas fa-paper-plane"></i> Envoyer le Message
                    </button>
                </form>
            </div>
            
            <div class="contact-info">
                <h3 style="color: var(--gold); margin-bottom: 1.5rem;">Informations de Contact</h3>
                
                <div style="margin-bottom: 2rem;">
                    <h4><i class="fas fa-map-marker-alt"></i> Adresse</h4>
                    <p>Derb Sidi Ahmed Soussi<br>Médina, Marrakech<br>Maroc</p>
                </div>
                
                <div style="margin-bottom: 2rem;">
                    <h4><i class="fas fa-phone"></i> Téléphone</h4>
                    <p>+212 524 123 456<br>+212 661 123 456 (WhatsApp)</p>
                </div>
                
                <div style="margin-bottom: 2rem;">
                    <h4><i class="fas fa-envelope"></i> Email</h4>
                    <p>info@riad-authentique.com<br>reservation@riad-authentique.com</p>
                </div>
                
                <div>
                    <h4><i class="fas fa-clock"></i> Horaires</h4>
                    <p>Réception ouverte 24h/24<br>Service client: 8h - 22h</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

---

# Client Login View (auth/client-login.blade.php)

@extends('layouts.app')

@section('title', 'Connexion Client')

@section('styles')
<style>
    .auth-content {
        padding: 4rem 0;
        background: var(--cream);
        min-height: 70vh;
        display: flex;
        align-items: center;
    }

    .auth-card {
        max-width: 400px;
        margin: 0 auto;
        background: white;
        border-radius: 15px;
        box-shadow: 0 20px 40px rgba(139, 69, 19, 0.1);
        overflow: hidden;
    }

    .auth-header {
        background: linear-gradient(135deg, var(--primary-brown) 0%, var(--secondary-brown) 100%);
        color: white;
        padding: 2rem;
        text-align: center;
    }

    .auth-content-inner {
        padding: 2rem;
    }
</style>
@endsection

@section('content')
<section class="auth-content">
    <div class="container">
        <div class="auth-card">
            <div class="auth-header">
                <h2>Connexion Client</h2>
                <p>Accédez à votre espace personnel</p>
            </div>
            
            <div class="auth-content-inner">
                <form action="{{ route('client.login.post') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Mot de passe</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>
                    
                    <button type="submit" class="btn btn-primary" style="width: 100%; margin-bottom: 1rem;">
                        Se Connecter
                    </button>
                    
                    <div style="text-align: center;">
                        <p>Pas encore de compte ? <a href="{{ route('client.register') }}">S'inscrire</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection