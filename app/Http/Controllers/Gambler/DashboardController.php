<?php

namespace App\Http\Controllers\Gambler;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $rules = [
            [
                'score' => '3.0',
                'description' => 'Placar exato'
            ],
            [
                'score' => '1.0',
                'description' => 'Circunstância do jogo'
            ],
            [
                'score' => '0.5',
                'description' => 'Jogador que fez gol'
            ]
        ];

        return view('gambler.dashboard.index', [
            'rules' => $rules,
        ]);
    }
}
