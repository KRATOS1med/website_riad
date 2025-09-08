<?php

namespace App\Http\Controllers;

use App\Models\Chambre;
use Illuminate\Http\Request;

class ChambreController extends Controller
{
    public function index()
    {
        $chambres = Chambre::where('disponibilite', 1)->get();
        return view('chambres.index', compact('chambres'));
    }

    public function show($id)
    {
        // Use the correct primary key field
        $chambre = Chambre::where('id_chambre', $id)->first();
        
        if (!$chambre) {
            return redirect()->route('chambres.index')->with('error', 'Chambre non trouvée.');
        }
        
        return view('chambres.show', compact('chambre'));
    }

    public function disponibles(Request $request)
    {
        $query = Chambre::where('disponibilite', 1);
        
        // Add any filtering logic here if needed
        if ($request->has('type_chambre') && $request->type_chambre) {
            $query->where('type_chambre', $request->type_chambre);
        }
        
        if ($request->has('prix_max') && $request->prix_max) {
            $query->where('prix', '<=', $request->prix_max);
        }
        
        $chambres = $query->get();
        
        return view('chambres.disponibles', compact('chambres'));
    }

    // Admin methods (if you have admin functionality)
    public function create()
    {
        return view('admin.chambres.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'prix' => 'required|numeric|min:0',
            'type_chambre' => 'required|in:double,triple',
            'photos' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'disponibilite' => 'boolean'
        ]);

        if ($request->hasFile('photos')) {
            $validatedData['photos'] = $request->file('photos')->store('chambres', 'public');
        }

        Chambre::create($validatedData);

        return redirect()->route('admin.chambres')->with('success', 'Chambre créée avec succès.');
    }

    public function edit($id)
    {
        $chambre = Chambre::where('id_chambre', $id)->first();
        
        if (!$chambre) {
            return redirect()->route('admin.chambres')->with('error', 'Chambre non trouvée.');
        }
        
        return view('admin.chambres.edit', compact('chambre'));
    }

    public function update(Request $request, $id)
    {
        $chambre = Chambre::where('id_chambre', $id)->first();
        
        if (!$chambre) {
            return redirect()->route('admin.chambres')->with('error', 'Chambre non trouvée.');
        }

        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'prix' => 'required|numeric|min:0',
            'type_chambre' => 'required|in:double,triple',
            'photos' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'disponibilite' => 'boolean'
        ]);

        if ($request->hasFile('photos')) {
            $validatedData['photos'] = $request->file('photos')->store('chambres', 'public');
        }

        $chambre->update($validatedData);

        return redirect()->route('admin.chambres')->with('success', 'Chambre mise à jour avec succès.');
    }

    public function destroy($id)
    {
        $chambre = Chambre::where('id_chambre', $id)->first();
        
        if (!$chambre) {
            return redirect()->route('admin.chambres')->with('error', 'Chambre non trouvée.');
        }
        
        $chambre->delete();

        return redirect()->route('admin.chambres')->with('success', 'Chambre supprimée avec succès.');
    }
}