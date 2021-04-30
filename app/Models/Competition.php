<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    protected $fillable = [
        'name', 'active', 'name_photo', 'season'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'competition_team', 'team_id', 'Competition_id');
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
