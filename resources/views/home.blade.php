@extends('layouts.app')

@section('title', 'Accueil - Riad Baroud')

@section('content')
<!-- Accueil Section (Hero) -->
<section id="accueil" class="hero-section">
    <img src="{{ asset('images/hero.jpg') }}" alt="Hero Riad Baroud" class="hero-image">
    <div class="hero-text">
        <h2>Bienvenue au Riad Baroud</h2>
        <p>Découvrez l'authenticité marocaine</p>
        <a href="{{ route('reservations.create') }}" class="btn-reservation">Réserver maintenant</a>
    </div>
</section>

<!-- Chambres Section -->
<section id="chambres" class="section chambres-section">
    <div class="container">
        <h2 class="section-title">Chambres & suites</h2>
        <div class="rooms-grid">
            @foreach($chambres as $chambre)
                <div class="room-card">
                    <img src="{{ asset('images/' . ($chambre->photos ?? 'chambre-coz.jpeg')) }}" alt="{{ $chambre->nom }}" class="room-image">
                    <h3 class="room-title">{{ $chambre->nom }}</h3>
                    <p class="room-description">{{ Str::limit($chambre->description ?? 'Chambre confortable', 100) }}</p>
                    <p class="room-price">{{ $chambre->prix ?? 0 }} MAD/nuit</p>
                    <a href="{{ route('reservations.create', $chambre->id_chambre) }}" class="btn-reservation room-btn">Réserver</a>
                </div>
            @endforeach
            <!-- Static fallback if no chambres -->
            @if($chambres->isEmpty())
                <div class="room-card">
                    <img src="{{ asset('images/chambre-coz.jpeg') }}" alt="Chambre Coz" class="room-image">
                    <h3 class="room-title">Chambre Coz</h3>
                    <p class="room-description">Chambre double authentique.</p>
                    <p class="room-price">800 MAD/nuit</p>
                    <a href="{{ route('reservations.create') }}" class="btn-reservation room-btn">Réserver</a>
                </div>
                <div class="room-card">
                    <img src="{{ asset('images/chambre-crad.jpeg') }}" alt="Chambre Crad" class="room-image">
                    <h3 class="room-title">Chambre Crad</h3>
                    <p class="room-description">Suite triple luxueuse.</p>
                    <p class="room-price">1200 MAD/nuit</p>
                    <a href="{{ route('reservations.create') }}" class="btn-reservation room-btn">Réserver</a>
                </div>
                <div class="room-card">
                    <img src="{{ asset('images/chambre-smos.jpeg') }}" alt="Chambre Smos" class="room-image">
                    <h3 class="room-title">Chambre Smos</h3>
                    <p class="room-description">Suite Yan élégante.</p>
                    <p class="room-price">1500 MAD/nuit</p>
                    <a href="{{ route('reservations.create') }}" class="btn-reservation room-btn">Réserver</a>
                </div>
                <div class="room-card">
                    <img src="{{ asset('images/suite-yan.jpeg') }}" alt="Suite Yan" class="room-image">
                    <h3 class="room-title suite">Suite Yan</h3>
                    <p class="room-description">Suite premium avec terrasse.</p>
                    <p class="room-price">2000 MAD/nuit</p>
                    <a href="{{ route('reservations.create') }}" class="btn-reservation room-btn">Réserver</a>
                </div>
                <div class="room-card">
                    <img src="{{ asset('images/suite-sin.jpeg') }}" alt="Suite Sin" class="room-image">
                    <h3 class="room-title suite">Suite Sin</h3>
                    <p class="room-description">Suite familiale spacieuse.</p>
                    <p class="room-price">1800 MAD/nuit</p>
                    <a href="{{ route('reservations.create') }}" class="btn-reservation room-btn">Réserver</a>
                </div>
            @endif
        </div>
    </div>
</section>

<!-- Services Section -->
<section id="services" class="section services-section">
    <div class="container">
        <h2 class="section-title">Les services</h2>
        <div class="services-grid">
            <div class="service-card">
                <i class="fas fa-spa service-icon"></i>
                <h3>Spa & Hammam</h3>
                <p>Soins traditionnels marocains.</p>
            </div>
            <div class="service-card">
                <i class="fas fa-utensils service-icon"></i>
                <h3>Cuisine Marocaine</h3>
                <p>Tagines et spécialités locales.</p>
            </div>
            <div class="service-card">
                <i class="fas fa-car service-icon"></i>
                <h3>Transfert Aéroport</h3>
                <p>Navette gratuite.</p>
            </div>
            <!-- Add more services as needed -->
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="section contact-section">
    <div class="container">
        <h2 class="section-title">Contact</h2>
        <form action="{{ route('contact.send') }}" method="POST" class="contact-form">
            @csrf
            <input type="text" name="name" placeholder="Nom" class="form-input" required>
            <input type="email" name="email" placeholder="Email" class="form-input" required>
            <input type="text" name="subject" placeholder="Sujet" class="form-input" required>
            <textarea name="message" placeholder="Message" class="form-textarea" required></textarea>
            <button type="submit" class="btn-reservation">Envoyer</button>
        </form>
    </div>
</section>
@endsection