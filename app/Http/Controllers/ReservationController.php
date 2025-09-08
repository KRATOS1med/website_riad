<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Client;
use App\Models\Chambre;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function index()
    {
        return view('reservations.index');
    }

    public function create($chambre_id = null)
    {
        $chambres = Chambre::where('disponibilite', true)->with('riad')->get();
        $selectedChambre = null;
        
        if ($chambre_id) {
            $selectedChambre = Chambre::findOrFail($chambre_id);
        }
        
        return view('reservations.create', compact('chambres', 'selectedChambre'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telephone' => 'required|string|max:20',
            'chambre_id' => 'required|exists:chambre,id',
            'dateArrivee' => 'required|date|after_or_equal:today',
            'dateDepart' => 'required|date|after:dateArrivee',
            'nombrePersonnes' => 'required|integer|min:1|max:10',
            'demandesSpeciales' => 'nullable|string'
        ]);

        // Calculate total price
        $chambre = Chambre::findOrFail($validated['chambre_id']);
        $dateArrivee = \Carbon\Carbon::parse($validated['dateArrivee']);
        $dateDepart = \Carbon\Carbon::parse($validated['dateDepart']);
        $nombreNuits = $dateArrivee->diffInDays($dateDepart);
        $prixTotal = $chambre->prix * $nombreNuits;

        // Create or find client
        $client = Client::firstOrCreate(
            ['email' => $validated['email']],
            [
                'nom' => $validated['nom'],
                'prenom' => $validated['prenom'],
                'telephone' => $validated['telephone'],
                'password' => \Hash::make('temporary_password')
            ]
        );

        // Create reservation
        $reservation = Reservation::create([
            'client_id' => $client->id,
            'chambre_id' => $validated['chambre_id'],
            'dateArrivee' => $validated['dateArrivee'],
            'dateDepart' => $validated['dateDepart'],
            'nombrePersonnes' => $validated['nombrePersonnes'],
            'prixTotal' => $prixTotal,
            'statut' => 'en_attente',
            'demandesSpeciales' => $validated['demandesSpeciales'] ?? null
        ]);

        return redirect()->route('reservations.confirmation', $reservation->id)
                         ->with('success', 'Votre réservation a été envoyée avec succès!');
    }

    public function confirmation($id)
    {
        $reservation = Reservation::with(['client', 'chambre.riad'])->findOrFail($id);
        return view('reservations.confirmation', compact('reservation'));
    }

    public function show($id)
    {
        $reservation = Reservation::with(['client', 'chambre.riad'])->findOrFail($id);
        return view('reservations.show', compact('reservation'));
    }
}