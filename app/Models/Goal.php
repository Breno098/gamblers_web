<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    protected $fillable = [
        'minute', 'team_id', 'player_id', 'scoreboard_id'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    protected $casts = [
    ];

    public function scoreboard()
    {
        return $this->belongsTo(Scoreboard::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function player()
    {
        return $this->belongsTo(Player::class);
    }
}
