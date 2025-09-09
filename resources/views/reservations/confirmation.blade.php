@extends('layouts.app')

@section('title', 'Confirmation de Réservation')

@section('styles')
<style>
    .confirmation-hero {
        background: linear-gradient(rgba(40, 167, 69, 0.8), rgba(25, 135, 84, 0.9)),
                    url('https://images.unsplash.com/photo-1544618411-66c6417b6f5b?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80') center/cover;
        height: 40vh;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-align: center;
    }

    .confirmation-hero .success-icon {
        font-size: 4rem;
        margin-bottom: 1rem;
        animation: bounce 1s ease-in-out;
    }

    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% {
            transform: translateY(0);
        }
        40% {
            transform: translateY(-10px);
        }
        60% {
            transform: translateY(-5px);
        }
    }

    .confirmation-hero h1 {
        font-size: 3rem;
        margin-bottom: 1rem;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
    }

    .confirmation-content {
        padding: 4rem 0;
        background: var(--cream);
    }

    .confirmation-card {
        max-width: 800px;
        margin: 0 auto;
        background: white;
        border-radius: 15px;
        box-shadow: 0 20px 40px rgba(139, 69, 19, 0.1);
        overflow: hidden;
    }

    .card-header {
        background: linear-gradient(135deg, var(--primary-brown) 0%, var(--secondary-brown) 100%);
        color: white;
        padding: 2rem;
        text-align: center;
    }

    .card-header h2 {
        font-size: 2rem;
        margin-bottom: 0.5rem;
    }

    .reservation-id {
        background: rgba(255, 255, 255, 0.2);
        padding: 0.5rem 1rem;
        border-radius: 20px;
        display: inline-block;
        margin-top: 1rem;
        font-weight: 600;
    }

    .card-content {
        padding: 2rem;
    }

    .reservation-details {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2rem;
        margin-bottom: 2rem;
    }

    .detail-section h4 {
        color: var(--primary-brown);
        margin-bottom: 1rem;
        font-size: 1.3rem;
        border-bottom: 2px solid var(--light-brown);
        padding-bottom: 0.5rem;
    }

    .detail-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0.75rem;
        padding: 0.5rem 0;
        border-bottom: 1px solid #f0f0f0;
    }

    .detail-row:last-child {
        border-bottom: none;
    }

    .detail-label {
        font-weight: 600;
        color: var(--text-dark);
    }

    .detail-value {
        color: var(--text-light);
    }

    .chambre-info {
        background: var(--cream);
        border-radius: 10px;
        padding: 1.5rem;
        margin-bottom: 2rem;
    }

    .chambre-card-horizontal {
        display: flex;
        gap: 1rem;
        align-items: center;
    }

    .chambre-image-small {
        width: 120px;
        height: 80px;
        border-radius: 8px;
        overflow: hidden;
        flex-shrink: 0;
    }

    .chambre-image-small img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .chambre-details h5 {
        color: var(--primary-brown);
        margin-bottom: 0.5rem;
    }

    .chambre-riad {
        color: var(--gold);
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
    }

    .chambre-price-large {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--primary-brown);
    }

    .total-section {
        background: rgba(139, 69, 19, 0.1);
        border-radius: 10px;
        padding: 1.5rem;
        margin: 2rem 0;
        border-left: 4px solid var(--primary-brown);
    }

    .total-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0.5rem;
        font-size: 1.1rem;
    }

    .total-final {
        border-top: 2px solid var(--primary-brown);
        padding-top: 1rem;
        margin-top: 1rem;
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--primary-brown);
    }

    .status-badge {
        display: inline-block;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 600;
        text-transform: uppercase;
    }

    .status-pending {
        background: #fff3cd;
        color: #856404;
    }

    .status-confirmed {
        background: #d1ecf1;
        color: #0c5460;
    }

    .next-steps {
        background: #e8f4f8;
        border-radius: 10px;
        padding: 1.5rem;
        margin-top: 2rem;
    }

    .next-steps h4 {
        color: var(--primary-brown);
        margin-bottom: 1rem;
    }

    .next-steps ul {
        list-style: none;
        padding: 0;
    }

    .next-steps li {
        padding: 0.5rem 0;
        padding-left: 2rem;
        position: relative;
    }

    .next-steps li::before {
        content: '\f00c';
        font-family: 'Font Awesome 6 Free';
        font-weight: 900;
        position: absolute;
        left: 0;
        color: #28a745;
    }

    .contact-info {
        background: var(--dark-brown);
        color: white;
        padding: 2rem;
        text-align: center;
    }

    .contact-info h4 {
        color: var(--gold);
        margin-bottom: 1rem;
    }

    .contact-details {
        display: flex;
        justify-content: space-around;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .contact-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .action-buttons {
        display: flex;
        gap: 1rem;
        justify-content: center;
        margin-top: 2rem;
        flex-wrap: wrap;
    }

    .btn-print {
        padding: 0.75rem 1.5rem;
        background: var(--primary-brown);
        color: white;
        border: none;
        border-radius: 5px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-print:hover {
        background: var(--dark-brown);
        transform: translateY(-2px);
    }

    .btn-home {
        padding: 0.75rem 1.5rem;
        background: var(--gold);
        color: var(--dark-brown);
        border: none;
        border-radius: 5px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-home:hover {
        background: #B8860B;
        transform: translateY(-2px);
    }

    @media (max-width: 768px) {
        .confirmation-hero h1 {
            font-size: 2rem;
        }

        .reservation-details {
            grid-template-columns: 1fr;
        }

        .chambre-card-horizontal {
            flex-direction: column;
            text-align: center;
        }

        .chambre-image-small {
            width: 100%;
            height: 150px;
        }

        .contact-details {
            flex-direction: column;
            align-items: center;
        }

        .action-buttons {
            flex-direction: column;
        }
    }

    @media print {
        .confirmation-hero,
        .action-buttons,
        header,
        footer {
            display: none !important;
        }
        
        .confirmation-content {
            padding: 0;
            background: white;
        }
    }
</style>
@endsection

@section('content')
<!-- Hero Section -->
<section class="confirmation-hero">
    <div class="container">
        <div class="success-icon">
            <i class="fas fa-check-circle"></i>
        </div>
        <h1>Réservation Confirmée !</h1>
        <p>Votre demande de réservation a été envoyée avec succès</p>
    </div>
</section>

<!-- Confirmation Content -->
<section class="confirmation-content">
    <div class="container">
        <div class="confirmation-card">
            <div class="card-header">
                <h2>Détails de votre Réservation</h2>
                <div class="reservation-id">
                    Réservation #{{ str_pad($reservation->id, 6, '0', STR_PAD_LEFT) }}
                </div>
            </div>
            
            <div class="card-content">
                <!-- Reservation Status -->
                <div style="text-align: center; margin-bottom: 2rem;">
                    <span class="status-badge status-{{ $reservation->statut == 'confirmee' ? 'confirmed' : 'pending' }}">
                        @if($reservation->statut == 'confirmee')
                            <i class="fas fa-check"></i> Confirmée
                        @else
                            <i class="fas fa-clock"></i> En Attente de Confirmation
                        @endif
                    </span>
                </div>

                <!-- Chambre Information -->
                <div class="chambre-info">
                    <h4 style="color: var(--primary-brown); margin-bottom: 1rem;">Chambre Réservée</h4>
                    <div class="chambre-card-horizontal">
                        <div class="chambre-image-small">
                            <img src="{{ $reservation->chambre->photos ? asset('storage/' . explode(',', $reservation->chambre->photos)[0]) : 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80' }}" 
                                 alt="{{ $reservation->chambre->nom }}">
                        </div>
                        <div class="chambre-details">
                            <h5>{{ $reservation->chambre->nom }}</h5>
                            <div class="chambre-riad">{{ $reservation->chambre->riad->nom ?? 'Riad Authentique' }}</div>
                            <div class="chambre-price-large">{{ number_format($reservation->chambre->prix, 0, ',', ' ') }} MAD/nuit</div>
                        </div>
                    </div>
                </div>

                <!-- Reservation Details -->
                <div class="reservation-details">
                    <div class="detail-section">
                        <h4><i class="fas fa-user"></i> Informations Client</h4>
                        <div class="detail-row">
                            <span class="detail-label">Nom complet:</span>
                            <span class="detail-value">{{ $reservation->client->prenom }} {{ $reservation->client->nom }}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Email:</span>
                            <span class="detail-value">{{ $reservation->client->email }}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Téléphone:</span>
                            <span class="detail-value">{{ $reservation->client->telephone }}</span>
                        </div>
                    </div>

                    <div class="detail-section">
                        <h4><i class="fas fa-calendar"></i> Détails du Séjour</h4>
                        <div class="detail-row">
                            <span class="detail-label">Date d'arrivée:</span>
                            <span class="detail-value">{{ \Carbon\Carbon::parse($reservation->dateArrivee)->format('d/m/Y') }}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Date de départ:</span>
                            <span class="detail-value">{{ \Carbon\Carbon::parse($reservation->dateDepart)->format('d/m/Y') }}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Nombre de nuits:</span>
                            <span class="detail-value">{{ \Carbon\Carbon::parse($reservation->dateArrivee)->diffInDays(\Carbon\Carbon::parse($reservation->dateDepart)) }}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Nombre de personnes:</span>
                            <span class="detail-value">{{ $reservation->nombrePersonnes }}</span>
                        </div>
                    </div>
                </div>

                @if($reservation->demandesSpeciales)
                    <div class="detail-section" style="grid-column: 1 / -1;">
                        <h4><i class="fas fa-comment"></i> Demandes Spéciales</h4>
                        <p style="background: #f8f9fa; padding: 1rem; border-radius: 5px; color: var(--text-light);">
                            {{ $reservation->demandesSpeciales }}
                        </p>
                    </div>
                @endif

                <!-- Total Section -->
                <div class="total-section">
                    <h4 style="color: var(--primary-brown); margin-bottom: 1rem;"><i class="fas fa-calculator"></i> Récapitulatif des Prix</h4>
                    <div class="total-row">
                        <span>Prix par nuit:</span>
                        <span>{{ number_format($reservation->chambre->prix, 0, ',', ' ') }} MAD</span>
                    </div>
                    <div class="total-row">
                        <span>Nombre de nuits:</span>
                        <span>{{ \Carbon\Carbon::parse($reservation->dateArrivee)->diffInDays(\Carbon\Carbon::parse($reservation->dateDepart)) }}</span>
                    </div>
                    <div class="total-row total-final">
                        <span>Prix Total:</span>
                        <span>{{ number_format($reservation->prixTotal, 0, ',', ' ') }} MAD</span>
                    </div>
                </div>

                <!-- Next Steps -->
                <div class="next-steps">
                    <h4><i class="fas fa-list-check"></i> Prochaines Étapes</h4>
                    <ul>
                        <li>Vous recevrez un email de confirmation dans les 24h</li>
                        <li>Notre équipe vous contactera pour finaliser votre réservation</li>
                        <li>Le paiement sera à effectuer à votre arrivée ou selon nos conditions</li>
                        <li>Présentez-vous à la réception avec une pièce d'identité</li>
                    </ul>
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons">
                    <button onclick="window.print()" class="btn-print">
                        <i class="fas fa-print"></i> Imprimer la Confirmation
                    </button>
                    <a href="{{ route('home') }}" class="btn-home">
                        <i class="fas fa-home"></i> Retour à l'Accueil
                    </a>
                    <a href="{{ route('chambres.index') }}" class="btn-print">
                        <i class="fas fa-bed"></i> Voir d'Autres Chambres
                    </a>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="contact-info">
                <h4><i class="fas fa-phone"></i> Besoin d'Aide ?</h4>
                <p>Notre équipe est à votre disposition pour toute question</p>
                <div class="contact-details">
                    <div class="contact-item">
                        <i class="fas fa-phone"></i>
                        <span>+212 524 123 456</span>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-envelope"></i>
                        <span>info@riad-authentique.com</span>
                    </div>
                    <div class="contact-item">
                        <i class="fab fa-whatsapp"></i>
                        <span>+212 661 123 456</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection