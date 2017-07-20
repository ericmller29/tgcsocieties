<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Societies;
use App\Tourneys;
use Auth;

use Carbon\Carbon;

class ViewController extends Controller
{
	public $rank = 1;
	public $last_score = 0;
	public $tie_count = 1;

	public function index(){
    	$tourneys = collect(Tourneys::all());

    	$data['tourneys'] = $tourneys->filter(function($t){
    		$end_date = $t->start_date->addDays($t->duration);
    		$currentDate = Carbon::now();

    		return $currentDate->lt($end_date) && $currentDate->gte($t->start_date);
    	})->forPage(1, 10)->all();

    	return view('homepage', $data);
	}
    public function society($societySlug){
		$data['society'] = Societies::where('slug', $societySlug)->first();
		$tourneys = collect($data['society']->tourneys()->orderBy('start_date', 'desc')->get());

    	$data['current_tourney'] = $tourneys->filter(function($t){
    		$end_date = $t->start_date->addDays($t->duration);
    		$currentDate = Carbon::now();

    		return $currentDate->lt($end_date) && $currentDate->gte($t->start_date);
    	})->first();

    	$data['past'] = $tourneys->filter(function($t){
    		$end_date = $t->start_date->addDays($t->duration);
    		$currentDate = Carbon::now();

    		return $currentDate->gt($end_date);
    	})->values();

		// return $society->tourneys;
		return view('society', $data);
    }

    public function leaderboard($societySlug, $tourneySlug){
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

		return view('leaderboard', $data);
    }

    public function tourneys(){
    	$tourneys = Tourneys::all();

    	if(isset($_GET['q'])){
    		$tourneys = Tourneys::where('course_name', 'like', '%' . $_GET['q'] . '%')
    						->orWhere('name', 'like', '%' . $_GET['q'] . '%')
    						->get();
    	}else{
    		$tourneys = Tourneys::all();
    	}

    	$tourneys = collect($tourneys);

    	$data['tourneys'] = $tourneys->filter(function($t){
    		$end_date = $t->start_date->addDays($t->duration);
    		$currentDate = Carbon::now();

    		return $currentDate->lt($end_date) && $currentDate->gte($t->start_date);
    	})->values();

    	return view('tourneys', $data);
    }
}
