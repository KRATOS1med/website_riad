<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Reservation extends Model
{
    use HasFactory;

    protected $table = 'reservation'; // Table au singulier selon votre DB
    
    protected $fillable = [
        'dateArrivee',
        'dateDepart',
        'statut',
        'prixTotal',
        'statut_paiement',
        'client_id',
        'chambre_id'
    ];

    protected $casts = [
        'dateArrivee' => 'date',
        'dateDepart' => 'date',
        'prixTotal' => 'float'
    ];

    // Relations
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function chambre()
    {
        return $this->belongsTo(Chambre::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    // Méthodes
    public function confirmer()
    {
        $this->statut = 'confirmee';
        $this->save();
        
        // Mettre à jour la disponibilité de la chambre
        $this->chambre->majDisponibilite();
    }

    public function annuler()
    {
        $this->statut = 'annulee';
        $this->save();
        
        // Mettre à jour la disponibilité de la chambre
        $this->chambre->majDisponibilite();
    }

    public function mettreEnAttente()
    {
        $this->statut = 'en_attente';
        $this->save();
    }

    // Calculer le prix total automatiquement
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($reservation) {
            if ($reservation->chambre && $reservation->dateArrivee && $reservation->dateDepart) {
                $jours = Carbon::parse($reservation->dateArrivee)->diffInDays(Carbon::parse($reservation->dateDepart));
                $reservation->prixTotal = $jours * $reservation->chambre->prix;
            }
        });
    }
}
