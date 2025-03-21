<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enclosure extends Model
{
    use HasFactory;

    protected $fillable = [
        'pool_id',
        'capacity',
    ];

    public function crocodiles()
    {
        return $this->hasMany(Crocodile::class, 'pool_id', 'pool_id');
    }
}
