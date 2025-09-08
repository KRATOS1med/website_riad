@extends('layouts.app')

@section('title', 'Contactez-nous')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold text-center mb-8">Contactez-nous</h1>
        
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white rounded-lg shadow-md p-6">
            <form method="POST" action="{{ route('contact.send') }}">
                @csrf
                
                <div class="mb-4">
                    <label for="nom" class="block text-sm font-medium text-gray-700 mb-2">Nom complet</label>
                    <input type="text" id="nom" name="nom" value="{{ old('nom') }}" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label for="sujet" class="block text-sm font-medium text-gray-700 mb-2">Sujet</label>
                    <input type="text" id="sujet" name="sujet" value="{{ old('sujet') }}" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-6">
                    <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message</label>
                    <textarea id="message" name="message" rows="6" required
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('message') }}</textarea>
                </div>

                <button type="submit" 
                        class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-200">
                    Envoyer le message
                </button>
            </form>
        </div>

        <div class="mt-8 bg-gray-50 rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4">Informations de contact</h2>
            <div class="space-y-2">
                <p><strong>Téléphone:</strong> +212 XXX XXX XXX</p>
                <p><strong>Email:</strong> contact@riadbaroud.com</p>
                <p><strong>Adresse:</strong> Médina de Marrakech, Maroc</p>
            </div>
        </div>
    </div>
</div>
@endsection