<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Riad;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the services for public view.
     */
    public function index()
    {
        $services = Service::with('riad')->get();
        return view('services.index', compact('services'));
    }

    /**
     * Display a listing of the services for admin.
     */
    public function adminIndex()
    {
        $services = Service::with('riad')->get();
        return view('admin.services.index', compact('services'));
    }

    /**
     * Display the specified service.
     */
    public function show($id)
    {
        $service = Service::with('riad')->findOrFail($id);
        return view('services.show', compact('service'));
    }

    /**
     * Show the form for creating a new service.
     */
    public function create()
    {
        $riads = Riad::all();
        return view('admin.services.create', compact('riads'));
    }

    /**
     * Store a newly created service in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'prix' => 'required|numeric|min:0',
            'disponible' => 'boolean',
            'riad_id' => 'required|exists:riad,id'
        ]);

        Service::create($request->all());
        return redirect()->route('admin.services')->with('success', 'Service créé avec succès');
    }

    /**
     * Show the form for editing the specified service.
     */
    public function edit($id)
    {
        $service = Service::findOrFail($id);
        $riads = Riad::all();
        return view('admin.services.edit', compact('service', 'riads'));
    }

    /**
     * Update the specified service in storage.
     */
    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'prix' => 'required|numeric|min:0',
            'disponible' => 'boolean',
            'riad_id' => 'required|exists:riad,id'
        ]);

        $service->update($request->all());
        return redirect()->route('admin.services')->with('success', 'Service mis à jour avec succès');
    }

    /**
     * Remove the specified service from storage.
     */
    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();
        return redirect()->route('admin.services')->with('success', 'Service supprimé avec succès');
    }
}