@extends('layouts.app')

@section('title', 'Demandes de réservation')

@section('content')
<h1>Demandes de réservation</h1>
<table>
    <tr>
        <th>Nom</th>
        <th>Email</th>
        <th>Chambre</th>
        <th>Arrivée</th>
        <th>Départ</th>
        <th>Statut</th>
        <th>Action</th>
    </tr>
    @foreach($reservations as $reservation)
    <tr>
        <td>{{ $reservation->client_name }}</td>
        <td>{{ $reservation->client_email }}</td>
        <td>{{ $reservation->room_type }}</td>
        <td>{{ $reservation->checkin_date }}</td>
        <td>{{ $reservation->checkout_date }}</td>
        <td>{{ $reservation->status }}</td>
        <td>
            <form method="POST" action="{{ route('admin.reservations.status', $reservation->id) }}">
                @csrf
                <select name="status">
                    <option value="pending" @if($reservation->status=='pending')selected @endif>En attente</option>
                    <option value="accepted" @if($reservation->status=='accepted')selected @endif>Acceptée</option>
                    <option value="refused" @if($reservation->status=='refused')selected @endif>Refusée</option>
                </select>
                <button type="submit">Mettre à jour</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection