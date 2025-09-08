<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Riad extends Model
{
    protected $table = 'riad';
    protected $primaryKey = 'id'; 

    public function chambres()
    {
        return $this->hasMany(Chambre::class, 'id_riad', 'id');
    }
}
