@extends('layouts.app')

@section('title', 'Réservation - Riad Baroud')

@section('content')
<!-- Hero Section with Riad Image -->
<section class="hero-section reservation-hero">
    <img src="{{ asset('images/riad.jpeg') }}" alt="Riad Baroud - Réservation" class="hero-image" onerror="this.src='https://via.placeholder.com/1200x400?text=Riad+Baroud'">
    <div class="hero-text">
        <h2>Réservation</h2>
    </div>
</section>

<!-- Form Section -->
<section class="section form-section">
    <div class="container">
        <div class="form-container">
            @if ($errors->any())
                <div class="error-alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="success-alert">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('reservations.store') }}" method="POST">
                @csrf
                <div class="form-row">
                    <input type="text" name="nom" placeholder="Nom" class="form-input half" value="{{ old('nom') }}" required>
                    <input type="text" name="prenom" placeholder="Prénom" class="form-input half" value="{{ old('prenom') }}" required>
                </div>
                <div class="form-row">
                    <input type="email" name="email" placeholder="Email" class="form-input half" value="{{ old('email') }}" required>
                    <input type="tel" name="telephone" placeholder="Téléphone" class="form-input half" value="{{ old('telephone') }}" required>
                </div>
                <div class="form-row">
                    <input type="date" name="dateArrivee" class="form-input half" value="{{ old('dateArrivee') }}" min="{{ date('Y-m-d') }}" required>
                    <input type="date" name="dateDepart" class="form-input half" value="{{ old('dateDepart') }}" required>
                </div>
                <div class="form-row">
                    <input type="number" name="nombrePersonnes" placeholder="Personnes" class="form-input half" value="{{ old('nombrePersonnes', 1) }}" min="1" max="10" required>
                    <select name="chambre_id" class="form-input half" required>
                        <option value="">Chambres</option>
                        @if(isset($chambres) && $chambres->count() > 0)
                            @foreach($chambres as $chambre)
                                <option value="{{ $chambre->id_chambre }}" {{ $selectedChambre && $selectedChambre->id_chambre == $chambre->id_chambre ? 'selected' : '' }}>
                                    {{ $chambre->nom }} ({{ $chambre->prix }} MAD/nuit)
                                </option>
                            @endforeach
                        @else
                            <!-- Fallback options if no DB data -->
                            <option value="suite-yan">Suite Yan (650 MAD/nuit)</option>
                            <option value="suite-sin">Suite Sin (600 MAD/nuit)</option>
                            <option value="chambre-crad">Chambre Crad (600 MAD/nuit)</option>
                            <option value="chambre-coz">Chambre Coz (650 MAD/nuit)</option>
                        @endif
                    </select>
                </div>
                <div class="form-row">
                    <textarea name="demandesSpeciales" placeholder="Demandes Spéciales (optionnel)" class="form-textarea full-width" rows="3">{{ old('demandesSpeciales') }}</textarea>
                </div>
                <button type="submit" class="btn-reservation full-width">Réservez</button>
                <p class="price-total">Prix Total: 00.00 dh</p>
            </form>
        </div>
    </div>
</section>

<script>
    // Basic price calculation (updates on change; uses sample prices—adjust as needed)
    const chambrePrices = {
        'suite-yan': 650,
        'suite-sin': 600,
        'chambre-crad': 600,
        'chambre-coz': 650
        // Add more from $chambres if dynamic
    };

    function calculateTotal() {
        const chambreId = document.querySelector('select[name="chambre_id"]').value;
        const arrivee = document.querySelector('input[name="dateArrivee"]').value;
        const depart = document.querySelector('input[name="dateDepart"]').value;
        const priceTotalEl = document.querySelector('.price-total');

        if (chambreId && arrivee && depart) {
            const price = chambrePrices[chambreId] || 600; // Default
            const start = new Date(arrivee);
            const end = new Date(depart);
            const nights = Math.ceil((end - start) / (1000 * 60 * 60 * 24));
            const total = price * nights;
            priceTotalEl.textContent = `Prix Total: ${total.toFixed(2)} dh`;
        } else {
            priceTotalEl.textContent = 'Prix Total: 00.00 dh';
        }
    }

    // Attach events
    document.querySelector('select[name="chambre_id"]').addEventListener('change', calculateTotal);
    document.querySelector('input[name="dateArrivee"]').addEventListener('change', calculateTotal);
    document.querySelector('input[name="dateDepart"]').addEventListener('change', calculateTotal);
</script>

<style>
    /* Inline styles for form (fallback if CSS not loaded) */
    .reservation-hero .hero-text { background: none; }
    .form-container { max-width: 500px; margin: 0 auto; background: #f9f9f9; padding: 30px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 15px; }
    .form-input, .form-textarea { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 1rem; }
    .form-textarea.full-width { grid-column: 1 / -1; }
    .error-alert { background: #fee; color: #c00; padding: 10px; border-radius: 5px; margin-bottom: 15px; }
    .success-alert { background: #efe; color: #060; padding: 10px; border-radius: 5px; margin-bottom: 15px; }
    @media (max-width: 768px) { .form-row { grid-template-columns: 1fr; } }
</style>
@endsection