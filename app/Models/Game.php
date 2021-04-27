<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
        'date', 'time', 'status', 'user_id', 'team_home_id', 'team_guest_id', 'stadium_id', 'competition_id', 'stage'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    protected $casts = [
        'date' => 'datetime:Y-m-d',
        'time' => 'datetime:H:i'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function teamHome()
    {
        return $this->belongsTo(Team::class, 'team_home_id', 'id');
    }

    public function teamGuest()
    {
        return $this->belongsTo(Team::class, 'team_guest_id', 'id');
    }

    public function stadium()
    {
        return $this->belongsTo(Stadium::class);
    }

    public function competition()
    {
        return $this->belongsTo(Competition::class);
    }

    public function scoreboard()
    {
        return $this->hasMany(Scoreboard::class);
    }

    public function getScoreboardOfficialAttribute()
    {
        return $this->scoreboard()->where('game_id', $this->id)->where('type', 'official')->first();
    }
}
