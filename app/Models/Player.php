<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $fillable = [
        'name', 
        'position',
    ];

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'team_player', 'player_id', 'team_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function goals()
    {
        return $this->hasMany(Goal::class);
    }

    public function getTeamAttribute()
    {
        return $this->teams()->where('type', 'team')->first();
    }

    public function getCountryTeamAttribute()
    {
        return $this->teams()->where('type', 'country_team')->first();
    }
}
