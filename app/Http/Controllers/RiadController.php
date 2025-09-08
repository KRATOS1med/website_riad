<?php
namespace App\Http\Controllers;

use App\Models\Riad;
use App\Models\Chambre;
use Illuminate\Http\Request;

class RiadController extends Controller
{
    public function index()
    {
        $riads = Riad::with('chambres')->get();
        return view('riads.index', compact('riads'));
    }

    public function show($id)
    {
        $riad = Riad::with('chambres')->findOrFail($id);
        return view('riads.show', compact('riad'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'noteEtoiles' => 'nullable|numeric|min:0|max:5'
        ]);

        $riad = Riad::create($request->all());
        return redirect()->route('riads.index')->with('success', 'Riad créé avec succès');
    }

    public function update(Request $request, $id)
    {
        $riad = Riad::findOrFail($id);
        $riad->update($request->all());
        return redirect()->route('riads.show', $id)->with('success', 'Riad mis à jour');
    }

    public function destroy($id)
    {
        $riad = Riad::findOrFail($id);
        $riad->delete();
        return redirect()->route('riads.index')->with('success', 'Riad supprimé');
    }
}
