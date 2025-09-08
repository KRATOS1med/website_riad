<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Administrateur extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'administrateur'; // Table au singulier selon votre DB
    
    protected $fillable = [
        'nom',
        'email',
        'motDePasse'
    ];

    protected $hidden = [
        'motDePasse',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'motDePasse' => 'hashed',
    ];

    // Override pour utiliser motDePasse au lieu de password
    public function getAuthPassword()
    {
        return $this->motDePasse;
    }

    // Relations
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    // Méthodes
    public function ajouterChambre($data)
    {
        return Chambre::create($data);
    }

    public function modifierChambre($chambre_id, $data)
    {
        $chambre = Chambre::find($chambre_id);
        if ($chambre) {
            $chambre->update($data);
            return $chambre;
        }
        return false;
    }

    public function supprimerChambre($chambre_id)
    {
        $chambre = Chambre::find($chambre_id);
        if ($chambre) {
            return $chambre->delete();
        }
        return false;
    }

    public function accepterReservation($reservation_id)
    {
        $reservation = Reservation::find($reservation_id);
        if ($reservation) {
            $reservation->statut = 'confirmee';
            $reservation->save();
            return true;
        }
        return false;
    }

    public function refuserReservation($reservation_id)
    {
        $reservation = Reservation::find($reservation_id);
        if ($reservation) {
            $reservation->statut = 'refusee';
            $reservation->save();
            return true;
        }
        return false;
    }

    public function gererReservation($reservation_id, $action)
    {
        switch ($action) {
            case 'accepter':
                return $this->accepterReservation($reservation_id);
            case 'refuser':
                return $this->refuserReservation($reservation_id);
            default:
                return false;
        }
    }

    public function envoyerMessage($client_id, $contenu)
    {
        return Message::create([
            'contenu' => $contenu,
            'client_id' => $client_id,
            'administrateur_id' => $this->id,
            'dateEnvoi' => now()
        ]);
    }
}