<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Client extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'client'; // Table au singulier selon votre DB
    
    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'telephone',
        'password'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Relations
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    // Méthodes
    public function reserver($chambre_id, $dateArrivee, $dateDepart)
    {
        return $this->reservations()->create([
            'chambre_id' => $chambre_id,
            'dateArrivee' => $dateArrivee,
            'dateDepart' => $dateDepart,
            'statut' => 'en_attente',
            'statut_paiement' => 'en_attente'
        ]);
    }

    public function annulation($reservation_id)
    {
        $reservation = $this->reservations()->find($reservation_id);
        if ($reservation && $reservation->statut !== 'confirmee') {
            $reservation->statut = 'annulee';
            $reservation->save();
            return true;
        }
        return false;
    }

    public function consulterReservations()
    {
        return $this->reservations()->with('chambre')->get();
    }

    public function noterRiad($riad_id, $note)
    {
        // Logique pour noter un riad
        $riad = Riad::find($riad_id);
        if ($riad) {
            // Calculer nouvelle moyenne des notes
            $riad->noteEtoiles = $note; // Simplifiée, vous pouvez implémenter une moyenne
            $riad->save();
        }
    }
}