@extends('layouts.app')

@section('title', 'Réservation')

@section('content')
<h1>Réserver une chambre</h1>
<form method="POST" action="{{ route('reservation.store') }}">
    @csrf
    <label>Nom:</label>
    <input type="text" name="name" required>
    <label>Email:</label>
    <input type="email" name="email" required>
    <label>Date d'arrivée:</label>
    <input type="date" name="checkin" required>
    <label>Date de départ:</label>
    <input type="date" name="checkout" required>
    <label>Chambre/Suite:</label>
    <select name="room" required>
        <option value="Suite Yan">Suite Yan</option>
        <option value="Suite Sin">Suite Sin</option>
        <option value="Chambre Crad">Chambre Crad</option>
        <option value="Chambre Smos">Chambre Smos</option>
    </select>
    <button type="submit">Envoyer la demande</button>
</form>
@endsection