<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promote extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'slug',
        'etat'
    ];

    /**
     * @return mixed
     */
    public function spaces()
    {
        return $this->hasMany(Space::class);
    }

}
