<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recommendation extends Model
{
    use HasFactory;

    protected $fillable = [
        'space_id',
        'user_id',
        'score',
        'comment',
        'etat' 
    ];

    public function space()
    {
        return $this->belongsTo(Space::class);
    }
}
