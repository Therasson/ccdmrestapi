<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Space extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'town_id',
        'user_id',
        'district',
        'phone',
        'longitude',
        'latitude',
        'etat'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function menus()
    {
        return $this->hasMany(Menu::class);
    }

    //jointure avec la table image Polymorph

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function promote()
    {
        return $this->belongsTo(Promote::class);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function hotel()
    {
        return $this->hasOne(Hotel::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function recommendations()
    {
        return $this->hasMany(Recommendation::class);
    }
}
