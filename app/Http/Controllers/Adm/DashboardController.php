<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use App\Models\Scoreboard;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $rules = [
            [
                'score' => '3.0',
                'description' => 'Acertar exatamente o placar'
            ],
            [
                'score' => '1.0',
                'description' => 'Acertar a circunstância do jogo'
            ],
            [
                'score' => '0.5',
                'description' => 'Acertar o jogador que fez gol em uma partida'
            ]
        ];

        $scoreboards = Scoreboard::select('user_id', 'score')
            ->where('type', 'gambler')
            ->groupBy('user_id')
            ->groupBy('score')
            ->take(5);

        return view('adm.dashboard.index', [
            'rules' => $rules,
            'scoreboards' => $scoreboards
        ]);
    }
}
