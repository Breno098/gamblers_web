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
            'password' => Hash::make('aaaa'),
            'type' => 'adm',
            'avatar' => 'cristiano-ronaldo.png'
        ]);

        User::create([
            'name' => 'Rai',
            'email' => 'rai.luis1999@gmail.com',
            'password' => Hash::make('token@123'),
            'type' => 'adm',
            'avatar' => 'messi.png'
        ]);

        $this->createCountries();
        $this->createCompetitions();
        $this->createTeams();
        $this->createPlayers();
        $this->createStadia();
        $this->createGames();
        $this->createScoreboards();
        $this->createGoals();

        DB::table('user_competition')->insert([
            'user_id' => 1,
            'competition_id' => 1
        ]);
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
                'name_photo' => '20210427174101cl.jpg'
            ],
            [
                'id' => 2,
                'name' => 'Europa League',
                'season' => '2021/2022',
                'active' => 1,
                'name_photo' => '20210427174121el.jpg'
            ],
            [
                'id' => 3,
                'name' => 'Libertadores',
                'season' => '2021',
                'active' => 1,
                'name_photo' => '20210427174132lib.webp'
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
                'name_photo' => '20210427125605real'
            ],
            [
                'id' => 2,
                'name' => 'Juventus',
                'country_id' => ( Country::where('name', 'Itália')->first() )->id,
                'name_photo' => '20210427013854juventus.png'
            ],
            [
                'id' => 3,
                'name' => 'PSG',
                'country_id' => ( Country::where('name', 'França')->first() )->id,
                'name_photo' => '20210427013952psg.png'
            ],
            [
                'id' => 4,
                'name' => 'Barcelona',
                'country_id' => ( Country::where('name', 'Espanha')->first() )->id,
                'name_photo' => '20210428005203barc.png'
            ],
            [
                'id' => 5,
                'name' => 'Bayer Munchen',
                'country_id' => ( Country::where('name', 'Alemanha')->first() )->id,
                'name_photo' => '20210428005346bayer'
            ],
            [
                'id' => 6,
                'name' => 'Manchester City',
                'country_id' => ( Country::where('name', 'Inglaterra')->first() )->id,
                'name_photo' => '20210428005426man_city.jpg'
            ],
        ];

        foreach ($teams as $key => $value) {
            $teamCreated = Team::create($value);
            $teamCreated->competitions()->sync([1]);

            Player::create([
                'name' => 'Gol Contra',
                'team_id' => $teamCreated->id,
                'id' => $key + 9999
            ]);
        }
    }

    public function createPlayers()
    {
        $players = [
            [
                'id' => 1,
                'name' => 'Cristiano Ronaldo',
                'country_id' => ( Country::where('name', 'Portugal')->first() )->id,
                'team_id' => ( Team::where('name', 'Juventus')->first() )->id,
                'position' => 'ATA'
            ],
            [
                'id' => 2,
                'name' => 'Neymar',
                'country_id' => ( Country::where('name', 'Brasil')->first() )->id,
                'team_id' => ( Team::where('name', 'PSG')->first() )->id,
                'position' => 'ATA'
            ],
            [
                'id' => 3,
                'name' => 'Kroos',
                'country_id' => ( Country::where('name', 'Alemanha')->first() )->id,
                'team_id' => ( Team::where('name', 'Real Madrid')->first() )->id,
                'position' => 'VOL'
            ],
            [
                'id' => 4,
                'name' => 'Sergio Ramos',
                'country_id' => ( Country::where('name', 'Espanha')->first() )->id,
                'team_id' => ( Team::where('name', 'Real Madrid')->first() )->id,
                'position' => 'ZAG'
            ],
            [
                'id' => 5,
                'name' => 'Modric',
                'country_id' => ( Country::where('name', 'Croácia')->first() )->id,
                'team_id' => ( Team::where('name', 'Real Madrid')->first() )->id,
                'position' => 'MEI'
            ],
            [
                'id' => 6,
                'name' => 'Benzema',
                'country_id' => ( Country::where('name', 'França')->first() )->id,
                'team_id' => ( Team::where('name', 'Real Madrid')->first() )->id,
                'position' => 'ATA'
            ],
            [
                'id' => 7,
                'name' => 'Messi',
                'country_id' => ( Country::where('name', 'Argentina')->first() )->id,
                'team_id' => ( Team::where('name', 'Barcelona')->first() )->id,
                'position' => 'ATA'
            ],
            [
                'id' => 8,
                'name' => 'De Bruyne',
                'country_id' => ( Country::where('name', 'Bélgica')->first() )->id,
                'team_id' => ( Team::where('name', 'Manchester City')->first() )->id,
                'position' => 'MEI'
            ],
            [
                'id' => 9,
                'name' => 'Dybala',
                'country_id' => ( Country::where('name', 'Argentina')->first() )->id,
                'team_id' => ( Team::where('name', 'Juventus')->first() )->id,
                'position' => 'ATA'
            ],
            [
                'id' => 10,
                'name' => 'Chiellini',
                'country_id' => ( Country::where('name', 'Itália')->first() )->id,
                'team_id' => ( Team::where('name', 'Juventus')->first() )->id,
                'position' => 'ZAG'
            ],
            [
                'id' => 11,
                'name' => 'Morata',
                'country_id' => ( Country::where('name', 'Espanha')->first() )->id,
                'team_id' => ( Team::where('name', 'Juventus')->first() )->id,
                'position' => 'ATA'
            ],
            [
                'id' => 12,
                'name' => 'Dembélé',
                'country_id' => ( Country::where('name', 'França')->first() )->id,
                'team_id' => ( Team::where('name', 'Barcelona')->first() )->id,
                'position' => 'ATA'
            ],
        ];

        foreach ($players as $key => $value) {
            Player::create($value);
        }
    }

    public function createStadia()
    {
        $stadia = [
            [
                'id' => 1,
                'name' => 'Santiago Bernabeu',
                'country_id' => ( Country::where('name', 'Espanha')->first() )->id,
            ],
            [
                'id' => 2,
                'name' => 'San Siro',
                'country_id' => ( Country::where('name', 'Itália')->first() )->id,
            ],
        ];

        foreach ($stadia as $key => $value) {
            Stadium::create($value);
        }
    }

    public function createGames()
    {
        $games = [
            [
                'id' => 1,
                'date' => now(),
                'time' => now(),
                'status' => 'open',
                'team_home_id' => 1,
                'team_guest_id' => 2,
                'stadium_id' => 1,
                'competition_id' => 1,
                'stage' => 'oitavas'
            ],
            [
                'id' => 2,
                'date' => now(),
                'time' => now(),
                'status' => 'finished',
                'team_home_id' => 2,
                'team_guest_id' => 3,
                'stadium_id' => 2,
                'competition_id' => 1,
                'stage' => 'oitavas'
            ],
        ];

        foreach ($games as $key => $value) {
            Game::create($value);
        }
    }

    public function createScoreboards()
    {
        $scoreboards = [
            [
                'id' => 2,
                'type'  => 'bet',
                'game_id' => 1,
                'team_home_scoreboard' => 2,
                'team_guest_scoreboard' => 1,
                'user_id' => 1
            ],
            // [
            //     'id' => 3,
            //     'type'  => 'bet',
            //     'game_id' => 1,
            //     'team_home_scoreboard' => 3,
            //     'team_guest_scoreboard' => 1,
            //     'user_id' => 2
            // ],

        ];

        foreach ($scoreboards as $key => $value) {
            Scoreboard::create($value);
        }
    }

    public function createGoals()
    {
        $goals = [
            [
                'id' => 3,
                'player_id' => 4,
                'team_id' => 1,
                'scoreboard_id' => 2,
            ],
            [
                'id' => 4,
                'player_id' => 4,
                'team_id' => 1,
                'scoreboard_id' => 2,
            ],
            [
                'id' => 5,
                'player_id' => 1,
                'team_id' => 2,
                'scoreboard_id' => 2,
            ],
            // [
            //     'id' => 6,
            //     'player_id' => 5,
            //     'team_id' => 1,
            //     'scoreboard_id' => 3,
            // ],
            // [
            //     'id' => 7,
            //     'player_id' => 4,
            //     'team_id' => 1,
            //     'scoreboard_id' => 3,
            // ],
            // [
            //     'id' => 8,
            //     'player_id' => 5,
            //     'team_id' => 1,
            //     'scoreboard_id' => 3,
            // ],
            // [
            //     'id' => 9,
            //     'player_id' => 1,
            //     'team_id' => 2,
            //     'scoreboard_id' => 3,
            // ],

        ];

        foreach ($goals as $key => $value) {
            Goal::create($value);
        }
    }
}
