<?php

namespace Database\Seeders;

use App\Models\Competition;
use App\Models\Country;
use App\Models\Game;
use App\Models\Goal;
use App\Models\Player;
use App\Models\Scoreboard;
use App\Models\Stadium;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Breno',
            'email' => 'brenohenrique098@gmail.com',
            'password' => Hash::make('token@123'),
            'type' => 'adm',
            'avatar' => 'cristiano-ronaldo.png'
        ]);

        $this->createCountries();
        $this->createCompetitions();
        $this->createTeams();
    }

    public function createCountries()
    {
        $coutries = [
            ['id' => 1, 'name' => 'Brasil'],
            ['id' => 2, 'name' => 'França'],
            ['id' => 3, 'name' => 'Alemanha'],
            ['id' => 4, 'name' => 'Inglaterra'],
            ['id' => 5, 'name' => 'Portugal'],
            ['id' => 6, 'name' => 'Espanha'],
            ['id' => 7, 'name' => 'Itália'],
            ['id' => 8, 'name' => 'Croácia'],
            ['id' => 9, 'name' => 'Argentina'],
            ['id' => 10, 'name' => 'Bélgica']
        ];

        foreach ($coutries as $key => $value) {
            Country::create($value);
        }
    }

    public function createCompetitions()
    {
        $competition = [
            [
                'id' => 1,
                'name' => 'Champions League',
                'season' => '2021/2022',
                'active' => 1,
            ],
            [
                'id' => 2,
                'name' => 'Copa do Mundo 2022',
                'season' => '2022',
                'active' => 1,
            ],
        ];

        foreach ($competition as $key => $value) {
            Competition::create($value);
        }
    }

    public function createTeams()
    {
        $teams = [
            [
                'id' => 1,
                'name' => 'Real Madrid',
                'country_id' => ( Country::where('name', 'Espanha')->first() )->id,
                'type' => 'team'
            ],
            [
                'id' => 2,
                'name' => 'Juventus',
                'country_id' => ( Country::where('name', 'Itália')->first() )->id,
                'type' => 'team'
            ],
            [
                'id' => 3,
                'name' => 'Portugal',
                'country_id' => ( Country::where('name', 'Portugal')->first() )->id,
                'type' => 'country_team'
            ],
            [
                'id' => 4,
                'name' => 'Brasil',
                'country_id' => ( Country::where('name', 'Brasil')->first() )->id,
                'type' => 'country_team'
            ],
        ];

        foreach ($teams as $key => $value) {
            $teamCreated = Team::create($value);
            $teamCreated->competitions()->sync([1]);
            $teamCreated->players()->create([
                'name' => 'Gol Contra',
                'id' => $key + 9999
            ]);
        }
    }
}
