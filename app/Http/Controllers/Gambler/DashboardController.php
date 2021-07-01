<?php

namespace App\Http\Controllers\Gambler;

use App\Http\Controllers\Controller;
use App\Models\Competition;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $rules = [];
        $rules[] = ['score' => '3.0', 'description' => 'Placar exato'];
        $rules[] = ['score' => '1.0', 'description' => 'Circunstância do jogo'];
        $rules[] = ['score' => '0.5', 'description' => 'Jogador que fez gol'];

        return view('gambler.dashboard.index', [
            'rules' => $rules,
            'competitions' => Competition::where('active', true)->take(3)->get()
        ]);
    }
}
