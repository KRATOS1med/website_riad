<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chambre;
use App\Models\Service;

class HomeController extends Controller
{
    public function index()
    {
        try {
            // Get featured rooms (available rooms, limit to 6)
            // Using correct column names from your database
            $chambres = Chambre::where('disponibilite', 1)
                              ->whereNotNull('id_chambre')
                              ->limit(6)
                              ->get();
        } catch (\Exception $e) {
            // If database error, return empty collection
            $chambres = collect();
        }
        
        return view('home', compact('chambres'));
    }

    public function search(Request $request)
    {
        $query = $request->get('query');
        
        // Search in chambres
        $chambres = Chambre::where('nom', 'like', "%{$query}%")
                          ->orWhere('description', 'like', "%{$query}%")
                          ->where('disponibilite', 1)
                          ->get();
        
        return view('search-results', compact('chambres', 'query'));
    }

    public function contact()
    {
        return view('contact');
    }

    public function sendContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string'
        ]);

        // Here you can add logic to send email or save to database
        // For now, we'll just redirect back with success message
        
        return redirect()->route('contact')->with('success', 'Votre message a été envoyé avec succès!');
    }
}