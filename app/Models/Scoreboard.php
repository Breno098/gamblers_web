<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Scoreboard extends Model
{
    protected $fillable = [
        'type', 
        'team_home_scoreboard', 
        'team_guest_scoreboard', 
        'score', 
        'report'
    ];

    protected $casts = [
        'score' => 'float'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function goals()
    {
        return $this->hasMany(Goal::class);
    }
}
