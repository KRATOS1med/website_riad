<?php
namespace App\Http\Controllers;

use App\Models\Administrateur;
use App\Models\Reservation;
use App\Models\Chambre;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdministrateurController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Adapter pour utiliser motDePasse
        $admin = Administrateur::where('email', $credentials['email'])->first();
        
        if ($admin && Hash::check($credentials['password'], $admin->motDePasse)) {
            Auth::guard('admin')->login($admin);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Identifiants incorrects']);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    public function dashboard()
    {
        $totalReservations = Reservation::count();
        $reservationsEnAttente = Reservation::where('statut', 'en_attente')->count();
        $reservationsConfirmees = Reservation::where('statut', 'confirmee')->count();
        $totalChambres = Chambre::count();
        $chambresDisponibles = Chambre::where('disponibilite', true)->count();
        $totalClients = Client::count();

        return view('admin.dashboard', compact(
            'totalReservations',
            'reservationsEnAttente', 
            'reservationsConfirmees',
            'totalChambres',
            'chambresDisponibles',
            'totalClients'
        ));
    }

    public function reservations()
    {
        $reservations = Reservation::with(['client', 'chambre'])->latest()->get();
        return view('admin.reservations', compact('reservations'));
    }

    public function clients()
    {
        $clients = Client::with('reservations')->get();
        return view('admin.clients', compact('clients'));
    }

    public function chambres()
    {
        $chambres = Chambre::with('riad')->get();
        return view('admin.chambres', compact('chambres'));
    }
}