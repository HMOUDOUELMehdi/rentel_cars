<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'name',
        'matricule',
        'model',
        'nombreDePlaces',
        'tarif',
    ];

    public function photos()
    {
        return $this->hasMany(CarPhoto::class, 'carId');
    }

    use HasFactory;
}
