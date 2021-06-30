<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'name', 
        'name_photo',
        'type',
        'active'
    ];

    protected $casts = [
        'active' => 'boolean'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function competitions()
    {
        return $this->belongsToMany(Competition::class, 'competition_team', 'team_id', 'competition_id');
    }
 
    public function players()
    {
        return $this->belongsToMany(Player::class, 'team_player', 'team_id', 'player_id');
    }

    public function countryPlayers()
    {
        return $this->hasMany(Player::class, 'country_team_id');
    }

    public function goals()
    {
        return $this->hasMany(Goal::class);
    }
}
