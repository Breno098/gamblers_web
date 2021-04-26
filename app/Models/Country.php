<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'name'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function teams()
    {
        return $this->hasMany(Team::class);
    }

    public function players()
    {
        return $this->hasMany(Player::class);
    }

    public function stadia()
    {
        return $this->hasMany(Stadium::class);
    }
}
