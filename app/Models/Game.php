<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Game extends Model
{
    protected $fillable = [
        'date', 
        'time', 
        'status', 
        'stage'
    ];

    protected $casts = [
        'date' => 'datetime:Y-m-d H:i',
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

    public function getScoreboardBetUserAttribute($user_id)
    {
        return $this->scoreboard()->where('game_id', $this->id)->where('type', 'bet')->where('user_id', $user_id)->first();
    }

    public function getScoreboardBetUserAuthAttribute()
    {
        return $this->scoreboard()->where('game_id', $this->id)->where('type', 'bet')->where('user_id', Auth::user()->id)->first();
    }

    public function getGoalsInTheGameAttribute($playerId)
    {
        $results = $this->scoreboard()
            ->where('game_id', $this->id)
            ->where('type', 'bet')
            ->where('user_id', Auth::user()->id)
            ->first();

        if(!isset($results->goals)){
            return 0;
        }

        $goals = [];
        collect($results->goals)->each(function($res) use (&$goals, $playerId){
            if($res->player_id === $playerId){
                $goals[] = $res->player;
            };
        });

        return $goals;
    }

    public function getOfficialGoalsInTheGameAttribute($playerId)
    {
        $results = $this->scoreboard()
            ->where('game_id', $this->id)
            ->where('type', 'official')
            ->whereNull('user_id')
            ->first();

        if(!isset($results->goals)){
            return 0;
        }

        $goals = [];
        collect($results->goals)->each(function($res) use (&$goals, $playerId){
            if($res->player_id === $playerId){
                $goals[] = $res->player;
            };
        });

        return $goals;
    }
}
