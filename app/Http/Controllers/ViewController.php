<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Societies;
use Auth;

class ViewController extends Controller
{
	public $rank = 1;
	public $last_score = 0;
	public $tie_count = 1;

    public function society($societySlug){
		$data['society'] = Societies::where('slug', $societySlug)->first();

		// return $society->tourneys;
		return view('society', $data);
    }

    public function tourney($societySlug, $tourneySlug){
		$data['society'] = Societies::where('slug', $societySlug)->first();
		$tourney = $data['society']->tourneys()->where('slug', $tourneySlug)->first();
		$data['tourney'] = $tourney;
		$leaderboard = collect($data['tourney']->leaderboard);
		
		if(Auth::check()){
			$data['is_users'] = Auth::user()->societies()->find($data['society']->id)->count();
		}

		$leaders_sorted = $leaderboard->sort(function($a, $b) use ($tourney){
            $scoreA = $a->getScoresTotal($a->scores, $tourney->rounds, $tourney->par);
            $scoreB = $b->getScoresTotal($b->scores, $tourney->rounds, $tourney->par);

			return $scoreA > $scoreB;
		})->values();

		$data['leaderboard'] = $leaders_sorted->map(function($player, $key) use ($tourney) {
            $playerScore = $player->getScoresTotal($player->scores, $tourney->rounds, $tourney->par);
			
			if($this->last_score == 0){
				$player['rank'] = $this->rank;
			}else if($playerScore == $this->last_score){
				$player['rank'] = 'T' . $this->rank;
				$this->tie_count = $this->tie_count + 1;
			}else if($playerScore > $this->last_score){
				$this->rank = $this->rank + $this->tie_count;
				$this->tie_count = 1;
				$player['rank'] = $this->rank;
			}
			$this->last_score = $playerScore;

			return $player;
		});

		return view('tourney', $data);
    }
}
