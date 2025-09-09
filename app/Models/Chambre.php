<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chambre extends Model
{
    use HasFactory;

    protected $table = 'chambre';
    protected $primaryKey = 'id_chambre';

    protected $fillable = [
        'nom',
        'description',
        'prix',
        'photos',
        'disponibilite',
        'riad_id',
        'id_riad',  // Ensure this matches your DB column
        'type_chambre'
    ];

    protected $casts = [
        'disponibilite' => 'boolean',
        'prix' => 'decimal:2'
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'chambre_id', 'id_chambre');
    }

    // FIXED: belongsTo with correct foreign/local keys
    public function riad()
    {
        return $this->belongsTo(Riad::class, 'id_riad', 'id_riad');  // Foreign: chambre.id_riad -> local: riad.id_riad
        // If riad PK is 'id', use: return $this->belongsTo(Riad::class, 'id_riad', 'id');
    }

    // Rest of your accessors...
    public function getCapaciteAttribute()
    {
        return $this->type_chambre === 'triple' ? 3 : 2;
    }

    public function getImageAttribute()
    {
        return $this->photos;
    }
}