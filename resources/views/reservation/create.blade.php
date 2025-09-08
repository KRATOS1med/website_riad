@extends('layouts.app')

@section('title', 'Réservation')

@section('styles')
<style>
    .reservation-hero {
        background: linear-gradient(rgba(139, 69, 19, 0.7), rgba(101, 67, 33, 0.8)),
                    url('https://images.unsplash.com/photo-1578662996442-48f60103fc96?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80') center/cover;
        height: 40vh;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-align: center;
    }

    .reservation-hero h1 {
        font-size: 3rem;
        margin-bottom: 1rem;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
    }

    .reservation-hero p {
        font-size: 1.2rem;
        opacity: 0.95;
    }

    .reservation-content {
        padding: 4rem 0;
        background: var(--cream);
    }

    .reservation-form-container {
        max-width: 800px;
        margin: 0 auto;
        background: white;
        border-radius: 15px;
        box-shadow: 0 20px 40px rgba(139, 69, 19, 0.1);
        overflow: hidden;
    }

    .form-header {
        background: linear-gradient(135deg, var(--primary-brown) 0%, var(--secondary-brown) 100%);
        color: white;
        padding: 2rem;
        text-align: center;
    }

    .form-header h2 {
        font-size: 2rem;
        margin-bottom: 0.5rem;
    }

    .form-content {
        padding: 2rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
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

    .form-control.select {
        cursor: pointer;
    }

    textarea.form-control {
        min-height: 100px;
        resize: vertical;
    }

    .required {
        color: #e74c3c;
    }

    .room-selection {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .room-card-small {
        background: white;
        border-radius: 10px;
        padding: 1rem;
        border: 2px solid transparent;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-bottom: 1rem;
    }

    .room-card-small:hover,
    .room-card-small.selected {
        border-color: var(--primary-brown);
        box-shadow: 0 5px 15px rgba(139, 69, 19, 0.2);
    }

    .room-card-small.selected {
        background: rgba(139, 69, 19, 0.05);
    }

    .room-card-content {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .room-image-small {
        width: 80px;
        height: 60px;
        border-radius: 5px;
        overflow: hidden;
        flex-shrink: 0;
    }

    .room-image-small img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .room-info {
        flex: 1;
    }

    .room-info h4 {
        color: var(--primary-brown);
        margin-bottom: 0.25rem;
    }

    .room-info .room-price {
        color: var(--gold);
        font-weight: 600;
    }

    .room-info .room-riad {
        font-size: 0.9rem;
        color: var(--text-light);
    }

    .price-summary {
        background: var(--cream);
        border-radius: 10px;
        padding: 1.5rem;
        margin-top: 1.5rem;
    }

    .price-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0.5rem;
    }

    .price-row.total {
        border-top: 2px solid var(--primary-brown);
        padding-top: 1rem;
        margin-top: 1rem;
        font-weight: 700;
        font-size: 1.2rem;
        color: var(--primary-brown);
    }

    .btn-submit {
        width: 100%;
        padding: 1rem 2rem;
        background: linear-gradient(135deg, var(--gold) 0%, #B8860B 100%);
        color: var(--dark-brown);
        border: none;
        border-radius: 5px;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(218, 165, 32, 0.3);
    }

    .alert {
        padding: 1rem;
        border-radius: 5px;
        margin-bottom: 1rem;
    }

    .alert-danger {
        background: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    .alert-success {
        background: #d1edff;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    @media (max-width: 768px) {
        .reservation-hero h1 {
            font-size: 2rem;
        }

        .form-row {
            grid-template-columns: 1fr;
        }

        .room-card-content {
            flex-direction: column;
            text-align: center;
        }

        .room-image-small {
            width: 100%;
            height: 150px;
        }
    }
</style>
@endsection

@section('content')
<!-- Hero Section -->
<section class="reservation-hero">
    <div class="container">
        <h1>Réservation</h1>
        <p>Réservez votre séjour dans notre riad authentique</p>
    </div>
</section>

<!-- Reservation Form -->
<section class="reservation-content">
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul style="margin: 0; padding-left: 1rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="reservation-form-container">
            <div class="form-header">
                <h2>Formulaire de Réservation</h2>
                <p>Remplissez les informations ci-dessous pour effectuer votre réservation</p>
            </div>
            
            <div class="form-content">
                <form action="{{ route('reservations.store') }}" method="POST" id="reservationForm">
                    @csrf
                    
                    <!-- Personal Information -->
                    <h3 style="color: var(--primary-brown); margin-bottom: 1.5rem; border-bottom: 2px solid var(--light-brown); padding-bottom: 0.5rem;">
                        Informations Personnelles
                    </h3>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="nom">Nom <span class="required">*</span></label>
                            <input type="text" id="nom" name="nom" class="form-control" value="{{ old('nom') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="prenom">Prénom <span class="required">*</span></label>
                            <input type="text" id="prenom" name="prenom" class="form-control" value="{{ old('prenom') }}" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="email">Email <span class="required">*</span></label>
                            <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="telephone">Téléphone <span class="required">*</span></label>
                            <input type="tel" id="telephone" name="telephone" class="form-control" value="{{ old('telephone') }}" required>
                        </div>
                    </div>

                    <!-- Room Selection -->
                    <h3 style="color: var(--primary-brown); margin-bottom: 1.5rem; border-bottom: 2px solid var(--light-brown); padding-bottom: 0.5rem;">
                        Sélection de Chambre
                    </h3>
                    
                    <div class="room-selection">
                        <label style="font-weight: 600; margin-bottom: 1rem; display: block;">Choisissez votre chambre <span class="required">*</span></label>
                        @foreach($chambres as $chambre)
                            <div class="room-card-small {{ $selectedChambre && $selectedChambre->id == $chambre->id ? 'selected' : '' }}" 
                                 onclick="selectRoom({{ $chambre->id }}, {{ $chambre->prix }})">
                                <div class="room-card-content">
                                    <div class="room-image-small">
                                        <img src="{{ $chambre->photos ? asset('storage/' . explode(',', $chambre->photos)[0]) : 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80' }}" alt="{{ $chambre->nom }}">
                                    </div>
                                    <div class="room-info">
                                        <h4>{{ $chambre->nom }}</h4>
                                        <div class="room-riad">{{ $chambre->riad->nom ?? 'Riad Authentique' }}</div>
                                        <div class="room-price">{{ number_format($chambre->prix, 0, ',', ' ') }} MAD/nuit</div>
                                        <input type="radio" name="chambre_id" value="{{ $chambre->id }}" 
                                               style="display: none;" 
                                               {{ $selectedChambre && $selectedChambre->id == $chambre->id ? 'checked' : '' }}>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Stay Information -->
                    <h3 style="color: var(--primary-brown); margin-bottom: 1.5rem; border-bottom: 2px solid var(--light-brown); padding-bottom: 0.5rem;">
                        Détails du Séjour
                    </h3>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="dateArrivee">Date d'Arrivée <span class="required">*</span></label>
                            <input type="date" id="dateArrivee" name="dateArrivee" class="form-control" 
                                   value="{{ old('dateArrivee') }}" min="{{ date('Y-m-d') }}" required onchange="calculateTotal()">
                        </div>
                        <div class="form-group">
                            <label for="dateDepart">Date de Départ <span class="required">*</span></label>
                            <input type="date" id="dateDepart" name="dateDepart" class="form-control" 
                                   value="{{ old('dateDepart') }}" min="{{ date('Y-m-d', strtotime('+1 day')) }}" required onchange="calculateTotal()">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="nombrePersonnes">Nombre de Personnes <span class="required">*</span></label>
                        <select id="nombrePersonnes" name="nombrePersonnes" class="form-control select" required>
                            <option value="">Sélectionnez le nombre de personnes</option>
                            @for($i = 1; $i <= 10; $i++)
                                <option value="{{ $i }}" {{ old('nombrePersonnes') == $i ? 'selected' : '' }}>
                                    {{ $i }} {{ $i == 1 ? 'Personne' : 'Personnes' }}
                                </option>
                            @endfor
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="demandesSpeciales">Demandes Spéciales</label>
                        <textarea id="demandesSpeciales" name="demandesSpeciales" class="form-control" 
                                  placeholder="Décrivez vos demandes spéciales (petit-déjeuner, transport, etc.)">{{ old('demandesSpeciales') }}</textarea>
                    </div>

                    <!-- Price Summary -->
                    <div class="price-summary" id="priceSummary" style="display: none;">
                        <h4 style="color: var(--primary-brown); margin-bottom: 1rem;">Résumé de la Réservation</h4>
                        <div class="price-row">
                            <span>Prix par nuit:</span>
                            <span id="pricePerNight">0 MAD</span>
                        </div>
                        <div class="price-row">
                            <span>Nombre de nuits:</span>
                            <span id="numberOfNights">0</span>
                        </div>
                        <div class="price-row total">
                            <span>Total:</span>
                            <span id="totalPrice">0 MAD</span>
                        </div>
                    </div>

                    <button type="submit" class="btn-submit">
                        <i class="fas fa-calendar-check"></i>
                        Confirmer la Réservation
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
let selectedRoomPrice = {{ $selectedChambre ? $selectedChambre->prix : 0 }};

function selectRoom(roomId, price) {
    // Remove selected class from all rooms
    document.querySelectorAll('.room-card-small').forEach(card => {
        card.classList.remove('selected');
    });
    
    // Add selected class to clicked room
    event.currentTarget.classList.add('selected');
    
    // Check the radio button
    document.querySelector(`input[name="chambre_id"][value="${roomId}"]`).checked = true;
    
    selectedRoomPrice = price;
    calculateTotal();
}

function calculateTotal() {
    const dateArrivee = document.getElementById('dateArrivee').value;
    const dateDepart = document.getElementById('dateDepart').value;
    
    if (dateArrivee && dateDepart && selectedRoomPrice > 0) {
        const startDate = new Date(dateArrivee);
        const endDate = new Date(dateDepart);
        const timeDiff = endDate.getTime() - startDate.getTime();
        const numberOfNights = Math.ceil(timeDiff / (1000 * 3600 * 24));
        
        if (numberOfNights > 0) {
            const totalPrice = selectedRoomPrice * numberOfNights;
            
            document.getElementById('pricePerNight').textContent = new Intl.NumberFormat('fr-MA').format(selectedRoomPrice) + ' MAD';
            document.getElementById('numberOfNights').textContent = numberOfNights;
            document.getElementById('totalPrice').textContent = new Intl.NumberFormat('fr-MA').format(totalPrice) + ' MAD';
            document.getElementById('priceSummary').style.display = 'block';
        } else {
            document.getElementById('priceSummary').style.display = 'none';
        }
    } else {
        document.getElementById('priceSummary').style.display = 'none';
    }
}

// Initialize if a room is preselected
if (selectedRoomPrice > 0) {
    calculateTotal();
}
</script>
@endsection