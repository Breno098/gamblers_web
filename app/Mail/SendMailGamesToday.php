<?php

namespace App\Mail;

use App\Models\Competition;
use App\Models\Game;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailGamesToday extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $competitions = [];
        $games = [];
        foreach (Competition::where('active', 1)->orderBy('name')->get() as $comp) {

            $gamesFor = $comp->games()->where('status', 'open')->whereRaw("date_format(date, '%Y-%m-%d') = date_format(now(), '%Y-%m-%d')")->get();

            if(count($gamesFor) > 0){
                $competitions[] = $comp->name;
            }

            foreach ($gamesFor as $game) {
                $games[] = $game;
            }
        }

        return $this->from('gamblers@gamblers.com')->view('mail.notice_games', [
            'games' => $games,
            'competitions' => $competitions,
            'user' => User::find(2)
        ]);
    }
}
