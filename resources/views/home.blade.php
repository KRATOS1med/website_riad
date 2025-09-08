@extends('layouts.app')

@section('title', 'Accueil')

@section('styles')
<style>
    /* Hero Section */
    .hero {
        background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)),
                    url('https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3') center/cover;
        height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: white;
    }

    .hero-content h1 {
        font-size: 4rem;
        margin-bottom: 1rem;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }

    .hero-content p {
        font-size: 1.5rem;
        margin-bottom: 2rem;
        max-width: 600px;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
    }

    .hero-buttons {
        display: flex;
        gap: 1rem;
        justify-content: center;
        flex-wrap: wrap;
    }

    /* Sections */
    .section {
        padding: 4rem 0;
    }

    .section-title {
        text-align: center;
        font-size: 3rem;
        color: var(--primary-brown);
        margin-bottom: 3rem;
    }

    .section-subtitle {
        text-align: center;
        font-size: 1.2rem;
        color: var(--text-light);
        margin-bottom: 3rem;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }

    /* Cards */
    .cards-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        margin-top: 2rem;
    }

    .card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(139, 69, 19, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(139, 69, 19, 0.2);
    }

    .card-image {
        height: 250px;
        background-size: cover;
        background-position: center;
        position: relative;
    }

    .card-price {
        position: absolute;
        top: 15px;
        right: 15px;
        background: var(--gold);
        color: var(--dark-brown);
        padding: 0.5rem 1rem;
        border-radius: 25px;
        font-weight: bold;
        font-size: 1.1rem;
    }

    .card-content {
        padding: 1.5rem;
    }

    .card-title {
        font-size: 1.5rem;
        color: var(--primary-brown);
        margin-bottom: 0.5rem;
    }

    .card-description {
        color: var(--text-light);
        margin-bottom: 1rem;
        line-height: 1.6;
    }

    .card-features {
        display: flex;
        gap: 1rem;
        margin-bottom: 1rem;
        font-size: 0.9rem;
        color: var(--text-light);
    }

    .card-features span {
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }

    /* Services Grid */
    .services-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2rem;
        margin-top: 2rem;
    }

    .service-card {
        text-align: center;
        padding: 2rem;
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(139, 69, 19, 0.1);
        transition: transform 0.3s ease;
    }

    .service-card:hover {
        transform: translateY(-5px);
    }

    .service-icon {
        font-size: 3rem;
        color: var(--gold);
        margin-bottom: 1rem;
    }

    .service-title {
        font-size: 1.3rem;
        color: var(--primary-brown);
        margin-bottom: 1rem;
    }

    /* CTA Section */
    .cta-section {
        background: linear-gradient(135deg, var(--primary-brown), var(--secondary-brown));
        color: white;
        text-align: center;
        padding: 4rem 0;
    }

    .cta-section h2 {
        font-size: 2.5rem;
        margin-bottom: 1rem;
    }

    .cta-section p {
        font-size: 1.2rem;
        margin-bottom: 2rem;
        opacity: 0.9;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .hero-content h1 {
            font-size: 2.5rem;
        }
        
        .hero-content p {
            font-size: 1.2rem;
        }
        
        .hero-buttons {
            flex-direction: column;
            align-items: center;
        }
        
        .cards-grid {
            grid-template-columns: 1fr;
        }
        
        .services-grid {
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        }
    }
</style>
@endsection

@section('content')
<!-- Hero Section -->
<section class="hero">
    <div class="hero-content">
        <h1>Bienvenue au Riad Authentique</h1>
        <p>Découvrez l'hospitalité marocaine traditionnelle dans un cadre luxueux au cœur de la médina de Marrakech</p>
        <div class="hero-buttons">
            <a href="{{ route('reservations.create') }}" class="btn btn-primary" style="font-size: 1.1rem; padding: 1rem 2rem;">
                RÉSERVER MAINTENANT
            </a>
            <a href="{{ route('chambres.index') }}" class="btn btn-outline" style="font-size: 1.1rem; padding: 1rem 2rem;">
                VOIR LES CHAMBRES
            </a>
        </div>
    </div>
</section>

<!-- Featured Rooms Section -->
<section class="section" style="background: var(--cream);">
    <div class="container">
        <h2 class="section-title">Nos Chambres d'Exception</h2>
        <p class="section-subtitle">
            Chaque chambre raconte une histoire unique, alliant traditions marocaines et confort moderne
        </p>
        
        <div class="cards-grid">
            @if(isset($chambres) && $chambres->count() > 0)
                @foreach($chambres as $chambre)
                    @if($chambre && $chambre->id_chambre)
                        <div class="card">
                            <div class="card-image" style="background-image: url('{{ $chambre->photos ? asset('storage/' . $chambre->photos) : 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?ixlib=rb-4.0.3' }}');">
                                <div class="card-price">{{ number_format($chambre->prix ?? 0, 0) }} DH/nuit</div>
                            </div>
                            <div class="card-content">
                                <h3 class="card-title">{{ $chambre->nom ?? 'Chambre' }}</h3>
                                <p class="card-description">{{ Str::limit($chambre->description ?? 'Belle chambre confortable', 100) }}</p>
                                <div class="card-features">
                                    <span><i class="fas fa-users"></i> {{ $chambre->capacite }} personnes</span>
                                    <span><i class="fas fa-bed"></i> {{ ucfirst($chambre->type_chambre ?? 'double') }}</span>
                                    <span><i class="fas fa-wifi"></i> Wi-Fi</span>
                                </div>
                                <div style="display: flex; gap: 1rem; justify-content: space-between;">
                                    <a href="{{ route('chambres.show', $chambre->id_chambre) }}" class="btn btn-outline" style="flex: 1;">
                                        Voir détails
                                    </a>
                                    <a href="{{ route('reservations.create', $chambre->id_chambre) }}" class="btn btn-primary" style="flex: 1;">
                                        Réserver
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @else
                <div style="grid-column: 1/-1; text-align: center; padding: 2rem;">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-bed"></i>
                        </div>
                        <h3 class="service-title">Nos Chambres</h3>
                        <p>Nous préparons de magnifiques chambres pour votre séjour.</p>
                        <a href="{{ route('chambres.index') }}" class="btn btn-primary">
                            Voir nos chambres
                        </a>
                    </div>
                </div>
            @endif
        </div>
        
        <div style="text-align: center; margin-top: 3rem;">
            <a href="{{ route('chambres.index') }}" class="btn btn-primary">
                Voir toutes nos chambres
            </a>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="section" style="background: white;">
    <div class="container">
        <h2 class="section-title">Nos Services</h2>
        <p class="section-subtitle">
            Une expérience complète pour un séjour inoubliable
        </p>
        
        <div class="services-grid">
            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-spa"></i>
                </div>
                <h3 class="service-title">Spa & Hammam</h3>
                <p>Détendez-vous dans notre hammam traditionnel et profitez de nos soins authentiques.</p>
            </div>
            
            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-utensils"></i>
                </div>
                <h3 class="service-title">Restaurant</h3>
                <p>Savourez la cuisine marocaine traditionnelle dans un cadre authentique.</p>
            </div>
            
            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-car"></i>
                </div>
                <h3 class="service-title">Transfert Aéroport</h3>
                <p>Service de navette depuis et vers l'aéroport de Marrakech.</p>
            </div>
            
            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-map-marked-alt"></i>
                </div>
                <h3 class="service-title">Excursions</h3>
                <p>Découvrez les merveilles de Marrakech et ses environs avec nos guides.</p>
            </div>
            
            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-wifi"></i>
                </div>
                <h3 class="service-title">Wi-Fi Gratuit</h3>
                <p>Connexion internet haut débit gratuite dans tout le riad.</p>
            </div>
            
            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-concierge-bell"></i>
                </div>
                <h3 class="service-title">Conciergerie</h3>
                <p>Notre équipe est à votre disposition 24h/24 pour tous vos besoins.</p>
            </div>
        </div>
        
        <div style="text-align: center; margin-top: 3rem;">
            <a href="{{ route('services.index') }}" class="btn btn-primary">
                Découvrir tous nos services
            </a>
        </div>
    </div>
</section>

<!-- About Section -->
<section class="section" style="background: var(--cream);">
    <div class="container">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 3rem; align-items: center;">
            <div>
                <h2 class="section-title" style="text-align: left; margin-bottom: 2rem;">
                    L'Art de Vivre Marocain
                </h2>
                <p style="font-size: 1.1rem; line-height: 1.8; color: var(--text-light); margin-bottom: 1.5rem;">
                    Niché au cœur de la médina historique de Marrakech, le Riad Authentique vous invite à découvrir 
                    l'hospitalité marocaine dans toute sa splendeur. Notre riad traditionnel, restauré avec soin, 
                    allie l'architecture ancestrale aux commodités modernes.
                </p>
                <p style="font-size: 1.1rem; line-height: 1.8; color: var(--text-light); margin-bottom: 2rem;">
                    Chaque détail a été pensé pour vous offrir une expérience authentique et inoubliable, 
                    de nos chambres décorées avec art aux espaces communs baignés de lumière naturelle.
                </p>
                <a href="{{ route('contact') }}" class="btn btn-primary">
                    Nous contacter
                </a>
            </div>
            <div>
                <div style="background: url('https://images.unsplash.com/photo-1539650116574-75c0c6d73826?ixlib=rb-4.0.3') center/cover; height: 400px; border-radius: 15px; box-shadow: 0 10px 30px rgba(139, 69, 19, 0.2);"></div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <h2>Prêt pour une Expérience Unique ?</h2>
        <p>Réservez dès maintenant votre séjour au Riad Authentique et laissez-vous transporter par la magie de Marrakech</p>
        <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
            <a href="{{ route('reservations.create') }}" class="btn btn-primary" style="font-size: 1.1rem; padding: 1rem 2rem;">
                Réserver Maintenant
            </a>
            <a href="{{ route('contact') }}" class="btn btn-outline" style="font-size: 1.1rem; padding: 1rem 2rem;">
                Poser une Question
            </a>
        </div>
    </div>
</section>
@endsection