<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chambre extends Model
{
    use HasFactory;

    // Your table name is 'chambre' (singular)
    protected $table = 'chambre';
    
    // Primary key is 'id_chambre' not 'id'
    protected $primaryKey = 'id_chambre';

    protected $fillable = [
        'nom',
        'description',
        'prix',
        'photos',
        'disponibilite',
        'riad_id',
        'id_riad',
        'type_chambre'
    ];

    protected $casts = [
        'disponibilite' => 'boolean',
        'prix' => 'decimal:2'
    ];

    // Relationship with reservations
    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'chambre_id', 'id_chambre');
    }
    
    // Accessor for capacity (since you don't have this column, we'll set a default)
    public function getCapaciteAttribute()
    {
        // Default capacity based on type_chambre
        return $this->type_chambre === 'triple' ? 3 : 2;
    }
    
    // Accessor for image (maps to photos column)
    public function getImageAttribute()
    {
        return $this->photos;
    }
}