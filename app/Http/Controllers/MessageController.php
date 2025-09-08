<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        if (Auth::guard('admin')->check()) {
            $messages = Message::with(['client', 'reservation'])->latest()->get();
        } else {
            $messages = Message::where('client_id', Auth::guard('client')->id())
                ->with(['administrateur', 'reservation'])->latest()->get();
        }
        
        return view('messages.index', compact('messages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'contenu' => 'required|string',
            'client_id' => 'required|exists:client,id',
            'reservation_id' => 'nullable|exists:reservation,id'
        ]);

        $message = Message::create([
            'contenu' => $request->contenu,
            'client_id' => $request->client_id,
            'administrateur_id' => Auth::guard('admin')->id(),
            'reservation_id' => $request->reservation_id,
            'dateEnvoi' => now()
        ]);

        return back()->with('success', 'Message envoyé');
    }

    public function show($id)
    {
        $message = Message::with(['client', 'administrateur', 'reservation'])->findOrFail($id);
        return view('messages.show', compact('message'));
    }
}

