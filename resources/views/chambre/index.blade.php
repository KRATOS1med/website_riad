@extends('layouts.app')

@section('title', 'Nos Chambres')

@section('styles')
<style>
    .chambres-hero {
        background: linear-gradient(rgba(139, 69, 19, 0.6), rgba(101, 67, 33, 0.7)),
                    url('https://images.unsplash.com/photo-1571896349842-33c89424de2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80') center/cover;
        height: 50vh;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-align: center;
    }

    .chambres-hero h1 {
        font-size: 3rem;
        margin-bottom: 1rem;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
    }

    .chambres-hero p {
        font-size: 1.3rem;
        opacity: 0.95;
        max-width: 600px;
        margin: 0 auto;
    }

    .chambres-content {
        padding: 4rem 0;
        background: var(--cream);
    }

    .filters-section {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        margin-bottom: 3rem;
        box-shadow: 0 10px 30px rgba(139, 69, 19, 0.1);
    }

    .filters-title {
        color: var(--primary-brown);
        margin-bottom: 1.5rem;
        text-align: center;
    }

    .filters-form {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        align-items: end;
    }

    .filter-group label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 600;
        color: var(--text-dark);
    }

    .filter-control {
        width: 100%;
        padding: 0.75rem;
        border: 2px solid #e0e0e0;
        border-radius: 5px;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .filter-control:focus {
        outline: none;
        border-color: var(--primary-brown);
        box-shadow: 0 0 0 3px rgba(139, 69, 19, 0.1);
    }

    .btn-filter {
        padding: 0.75rem 1.5rem;
        background: var(--primary-brown);
        color: white;
        border: none;
        border-radius: 5px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-filter:hover {
        background: var(--dark-brown);
        transform: translateY(-2px);
    }

    .chambres-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 2rem;
    }

    .chambre-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 15px 35px rgba(139, 69, 19, 0.1);
        transition: all 0.3s ease;
        position: relative;
    }

    .chambre-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 25px 50px rgba(139, 69, 19, 0.2);
    }

    .chambre-image {
        height: 250px;
        overflow: hidden;
        position: relative;
    }

    .chambre-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .chambre-card:hover .chambre-image img {
        transform: scale(1.1);
    }

    .availability-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
    }

    .available {
        background: #d4edda;
        color: #155724;
    }

    .unavailable {
        background: #f8d7da;
        color: #721c24;
    }

    .chambre-content {
        padding: 2rem;
    }

    .chambre-header {
        margin-bottom: 1rem;
    }

    .chambre-title {
        font-size: 1.5rem;
        color: var(--primary-brown);
        margin-bottom: 0.5rem;
    }

    .riad-name {
        color: var(--gold);
        font-size: 0.9rem;
        font-weight: 500;
    }

    .chambre-description {
        color: var(--text-light);
        margin-bottom: 1.5rem;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .chambre-features {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
    }

    .feature-tag {
        background: rgba(139, 69, 19, 0.1);
        color: var(--primary-brown);
        padding: 0.25rem 0.75rem;
        border-radius: 15px;
        font-size: 0.8rem;
        font-weight: 500;
    }

    .chambre-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 1rem;
        border-top: 1px solid #eee;
    }

    .chambre-price {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--primary-brown);
    }

    .chambre-price small {
        font-size: 1rem;
        font-weight: normal;
        color: var(--text-light);
    }

    .btn-group {
        display: flex;
        gap: 0.5rem;
    }

    .btn-view {
        padding: 0.5rem 1rem;
        background: transparent;
        color: var(--primary-brown);
        border: 2px solid var(--primary-brown);
        border-radius: 5px;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-view:hover {
        background: var(--primary-brown);
        color: white;
    }

    .btn-reserve {
        padding: 0.5rem 1rem;
        background: var(--gold);
        color: var(--dark-brown);
        border: none;
        border-radius: 5px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-reserve:hover {
        background: #B8860B;
        transform: translateY(-2px);
    }

    .no-results {
        text-align: center;
        padding: 4rem 2rem;
        color: var(--text-light);
    }

    .no-results i {
        font-size: 4rem;
        color: var(--light-brown);
        margin-bottom: 1rem;
    }

    .results-count {
        background: white;
        border-radius: 10px;
        padding: 1rem;
        margin-bottom: 2rem;
        box-shadow: 0 5px 15px rgba(139, 69, 19, 0.1);
        text-align: center;
    }

    .results-count h3 {
        color: var(--primary-brown);
        margin-bottom: 0.5rem;
    }

    @media (max-width: 768px) {
        .chambres-hero h1 {
            font-size: 2rem;
        }

        .filters-form {
            grid-template-columns: 1fr;
        }

        .chambres-grid {
            grid-template-columns: 1fr;
        }

        .chambre-footer {
            flex-direction: column;
            gap: 1rem;
            align-items: stretch;
        }

        .btn-group {
            justify-content: space-between;
        }
    }
</style>
@endsection

@section('content')
<!-- Hero Section -->
<section class="chambres-hero">
    <div class="container">
        <h1>Nos Chambres</h1>
        <p>Découvrez nos chambres authentiques alliant tradition marocaine et confort moderne</p>
    </div>
</section>

<!-- Chambres Content -->
<section class="chambres-content">
    <div class="container">
        <!-- Filters Section -->
        <div class="filters-section">
            <h3 class="filters-title">Filtrer les Chambres</h3>
            <form class="filters-form" action="{{ route('chambres.index') }}" method="GET">
                <div class="filter-group">
                    <label for="prix_max">Prix Maximum (MAD)</label>
                    <input type="number" id="prix_max" name="prix_max" class="filter-control" 
                           value="{{ request('prix_max') }}" placeholder="Ex: 1500">
                </div>
                <div class="filter-group">
                    <label for="riad_id">Riad</label>
                    <select id="riad_id" name="riad_id" class="filter-control">
                        <option value="">Tous les riads</option>
                        @foreach($chambres->unique('riad_id') as $chambre)
                            @if($chambre->riad)
                                <option value="{{ $chambre->riad->id }}" 
                                        {{ request('riad_id') == $chambre->riad->id ? 'selected' : '' }}>
                                    {{ $chambre->riad->nom }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="filter-group">
                    <label for="disponibilite">Disponibilité</label>
                    <select id="disponibilite" name="disponibilite" class="filter-control">
                        <option value="">Toutes</option>
                        <option value="1" {{ request('disponibilite') === '1' ? 'selected' : '' }}>Disponibles</option>
                        <option value="0" {{ request('disponibilite') === '0' ? 'selected' : '' }}>Non disponibles</option>
                    </select>
                </div>
                <div class="filter-group">
                    <button type="submit" class="btn-filter">
                        <i class="fas fa-search"></i> Filtrer
                    </button>
                </div>
            </form>
        </div>

        <!-- Results Count -->
        @if($chambres->count() > 0)
            <div class="results-count">
                <h3>{{ $chambres->count() }} chambre{{ $chambres->count() > 1 ? 's' : '' }} trouvée{{ $chambres->count() > 1 ? 's' : '' }}</h3>
                <p>Choisissez la chambre parfaite pour votre séjour</p>
            </div>
        @endif

        <!-- Chambres Grid -->
        @if($chambres->count() > 0)
            <div class="chambres-grid">
                @foreach($chambres as $chambre)
                    <div class="chambre-card">
                        <div class="chambre-image">
                            <img src="{{ $chambre->photos ? asset('storage/' . explode(',', $chambre->photos)[0]) : 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80' }}" 
                                 alt="{{ $chambre->nom }}">
                            <div class="availability-badge {{ $chambre->disponibilite ? 'available' : 'unavailable' }}">
                                {{ $chambre->disponibilite ? 'Disponible' : 'Non disponible' }}
                            </div>
                        </div>
                        <div class="chambre-content">
                            <div class="chambre-header">
                                <h3 class="chambre-title">{{ $chambre->nom }}</h3>
                                <div class="riad-name">{{ $chambre->riad->nom ?? 'Riad Authentique' }}</div>
                            </div>
                            <p class="chambre-description">{{ $chambre->description }}</p>
                            <div class="chambre-features">
                                <span class="feature-tag"><i class="fas fa-wifi"></i> WiFi</span>
                                <span class="feature-tag"><i class="fas fa-snowflake"></i> Climatisation</span>
                                <span class="feature-tag"><i class="fas fa-bath"></i> Salle de bain privée</span>
                                <span class="feature-tag"><i class="fas fa-tv"></i> TV</span>
                            </div>
                            <div class="chambre-footer">
                                <div class="chambre-price">
                                    {{ number_format($chambre->prix, 0, ',', ' ') }} MAD
                                    <small>/nuit</small>
                                </div>
                                <div class="btn-group">
                                    <a href="{{ route('chambres.show', $chambre->id) }}" class="btn-view">
                                        <i class="fas fa-eye"></i> Voir
                                    </a>
                                    @if($chambre->disponibilite)
                                        <a href="{{ route('reservations.create', $chambre->id) }}" class="btn-reserve">
                                            <i class="fas fa-calendar-plus"></i> Réserver
                                        </a>
                                    @else
                                        <span class="btn-reserve" style="opacity: 0.5; cursor: not-allowed;">
                                            <i class="fas fa-ban"></i> Indisponible
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="no-results">
                <i class="fas fa-search"></i>
                <h3>Aucune chambre trouvée</h3>
                <p>Essayez de modifier vos critères de recherche</p>
                <a href="{{ route('chambres.index') }}" class="btn btn-primary" style="margin-top: 1rem;">
                    Voir toutes les chambres
                </a>
            </div>
        @endif
    </div>
</section>
@endsection