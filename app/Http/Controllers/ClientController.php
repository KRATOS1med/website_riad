<?php
namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:client,email',
            'telephone' => 'required|string|max:20',
            'password' => 'required|string|min:6|confirmed'
        ]);

        $client = Client::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'password' => Hash::make($request->password)
        ]);

        Auth::guard('client')->login($client);
        return redirect()->route('client.dashboard');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::guard('client')->attempt($credentials)) {
            return redirect()->route('client.dashboard');
        }

        return back()->withErrors(['email' => 'Identifiants incorrects']);
    }

    public function logout()
    {
        Auth::guard('client')->logout();
        return redirect()->route('home');
    }

    public function dashboard()
    {
        $client = Auth::guard('client')->user();
        $reservations = $client->reservations()->with('chambre')->latest()->get();
        return view('client.dashboard', compact('client', 'reservations'));
    }

    public function profile()
    {
        $client = Auth::guard('client')->user();
        return view('client.profile', compact('client'));
    }

    public function updateProfile(Request $request)
    {
        $client = Auth::guard('client')->user();
        
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:client,email,' . $client->id,
            'telephone' => 'required|string|max:20'
        ]);

        $client->update($request->all());
        return redirect()->route('client.profile')->with('success', 'Profil mis à jour');
    }
}