<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $table = 'message'; // Table au singulier selon votre DB
    
    protected $fillable = [
        'contenu',
        'dateEnvoi',
        'client_id',
        'administrateur_id',
        'reservation_id'
    ];

    protected $casts = [
        'dateEnvoi' => 'datetime'
    ];

    // Relations
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function administrateur()
    {
        return $this->belongsTo(Administrateur::class);
    }

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    // Méthodes
    public function envoyer()
    {
        $this->dateEnvoi = now();
        $this->save();
    }

    public function consulter()
    {
        return $this->load(['client', 'administrateur']);
    }

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($message) {
            if (!$message->dateEnvoi) {
                $message->dateEnvoi = now();
            }
        });
    }
}
