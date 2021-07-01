<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    protected $fillable = [
        'name', 
        'active', 
        'name_photo', 
        'season'
    ];

    protected $casts = [
        'active' => 'boolean'
    ];

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'competition_team', 'competition_id', 'team_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_competition', 'competition_id', 'user_id');
    }

    public function games()
    {
        return $this->hasMany(Game::class);
    }
}
