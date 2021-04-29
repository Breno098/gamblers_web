<?php

namespace App\Services;

use App\Models\Goal;
use App\Models\Player;
use App\Models\Scoreboard;

class ScoreService
{
    public function saveRequest($request, $type, $user_id = null)
    {
        if($user_id){
            $scoreboard = Scoreboard::where('game_id', $request->game['id'])->where('user_id', $user_id)->where('type', 'bet')->first();
        } else {
            $scoreboard = Scoreboard::where('game_id', $request->game['id'])->where('type', 'official')->first();
        }

        if($scoreboard){
            $scoreboard->update([
                'team_home_scoreboard' => count($request->goalsTeamHome),
                'team_guest_scoreboard' => count($request->goalsTeamGuest)
            ]);
        } else {
            $scoreboard = Scoreboard::create([
                'game_id'   => $request->game['id'],
                'team_home_scoreboard' => count($request->goalsTeamHome),
                'team_guest_scoreboard' => count($request->goalsTeamGuest),
                'type'      => $type,
                'user_id'   => $user_id,
            ]);
        }

        Goal::where('scoreboard_id', $scoreboard->id)->delete();

        collect($request->goalsTeamHome)->each(function($player) use ($scoreboard) {
            Goal::create([
                'player_id' => $player['id'],
                'team_id'   => $player['team_id'],
                'scoreboard_id' => $scoreboard->id
            ]);
        });

        collect($request->goalsTeamGuest)->each(function($player) use ($scoreboard) {
            Goal::create([
                'player_id' => $player['id'],
                'team_id'   => $player['team_id'],
                'scoreboard_id' => $scoreboard->id
            ]);
        });
    }

    public function calculate($request)
    {
        $official = Scoreboard::where('game_id', $request->game['id'])->where('type', 'official')->first();

        $bets = Scoreboard::where('game_id', $request->game['id'])->where('type', 'bet')->get();

        collect($bets)->each(function($bet) use ($official) {
            $score = 0;
            $report = [];

            $calc = $this->calculateScoreByScoreboard($bet, $official);
            $score += $calc['score'];
            $report[] = $calc['report'];

            $calc = $this->calculateScoreByGoals($bet->goals->toArray(), $official->goals->toArray());
            $score += $calc['score'];
            // $report[] = $calc['report'];
            foreach ($calc['report'] as $value) {
                $report[] = $value;
            }

            $bet->update([
                'score' => $score,
                'report' => json_encode($report)
            ]);

            $bet->game()->update([
                'status' => 'finished'
            ]);
        });

    }

    private function calculateScoreByGoals(array $betGoals, array $officialGoals)
    {
        $score = 0;
        $report = [];

        foreach ($betGoals as $betGoal) {
            $continue = true;

            for ($i = 0; $i < count($officialGoals) && $continue; $i++) {
                if($betGoal['player_id'] === $officialGoals[$i]['player_id'] && $officialGoals[$i]['player_id']){

                    $continue = false;
                    $score += 0.5;
                    $officialGoals[$i]['player_id'] = null;

                    $player = Player::find($betGoal['player_id']) ?? '--';

                    $report[] = [
                        'score' => 0.5,
                        'description' => "Gol de {$player->name}"
                    ];
                }
            }
        }

        return [
            'score' => $score,
            'report' => $report
        ];
    }

    private function calculateScoreByScoreboard(Scoreboard $bet, Scoreboard $official){
        $score = 0;
        $report = [];

        if($bet->team_home_scoreboard === $official->team_home_scoreboard && $bet->team_guest_scoreboard === $official->team_guest_scoreboard){
            $score = $score + 3;
            $report['score'] = 3;
            $report['description'] = 'Placar exato';
        } else if($bet->team_home_scoreboard > $bet->team_guest_scoreboard && $official->team_home_scoreboard > $official->team_guest_scoreboard){
            $score = $score + 1;
            $report['score'] = 1;
            $report['description'] = "Vitória do time mandante";
        } else if($bet->team_home_scoreboard < $bet->team_guest_scoreboard && $official->team_home_scoreboard < $official->team_guest_scoreboard){
            $score = $score + 1;
            $report['score'] = 1;
            $report['description'] = "Vitória do time visitante";
        } else if($bet->team_home_scoreboard == $bet->team_guest_scoreboard && $official->team_home_scoreboard == $official->team_guest_scoreboard){
            $score = $score + 1;
            $report['score'] = 1;
            $report['description'] = 'Empate';
        }

        return [
            'score' => $score,
            'report' => $report
        ];
    }
}
