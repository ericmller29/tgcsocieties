<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Leaderboard;

class LeaderboardController extends Controller
{
    public $rank = 1;
    public $last_score = 0;
    public $tie_count = 1;
    
    public function showForm($tourneyId){
    	$tourney = Auth::user()->tourneys()->find($tourneyId);

    	if(!isset($tourney)){
    		return redirect('404');
    	}

    	$data['tourney'] = $tourney;

        $leaders_sorted = $tourney->leaderboard->sort(function($a, $b){
            $scoreA = $a->getScoresTotal($a->scores);
            $scoreB = $b->getScoresTotal($b->scores);

            return $scoreA > $scoreB;
        })->values();

        $data['leaderboard'] = $leaders_sorted->map(function($player, $key) {
            $playerScore = $player->getScoresTotal($player->scores);
            
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

    	return view('mine.leaderboard', $data);
    }

    public function create(Request $request, $tourneyId){
    	$tourney = Auth::user()->tourneys()->find($tourneyId);

    	if(!isset($tourney)){
    		return redirect('404');
    	}

    	$user_exists = $tourney->leaderboard()->where('username', $request->username)->count();

    	if($user_exists){
    		return redirect()->route('my.leaderboard', $tourneyId)
    			->with('message', 'The user ' . $request->get('username') . ' already exists in this leaderboard')
    			->with('type', 'error')
    			->with('gamertag', $request->get('username'));
    	}

    	$leaderboard = new Leaderboard();
    	$leaderboard->username = $request->get('username');
    	$leaderboard->scores = json_encode($request->get('score'));
    	$leaderboard->tourney()->associate($tourney->id);
    	$leaderboard->save();

    	return redirect()->route('my.leaderboard', $tourneyId)
    		->with('message', 'The leaderboard for ' . $tourney->name . ' has been updated!')
    		->with('type', 'success');
    }

    public function update(Request $request, $tourneyId, $leaderId){
    	$tourney = Auth::user()->tourneys()->find($tourneyId);

    	if(!isset($tourney)){
    		return redirect('404');
    	}

    	$user = $tourney->leaderboard()->find($leaderId);

    	if(!$user->count()){
    		return redirect()->route('my.leaderboard', $tourneyId)
    			->with('message', 'The user ' . $request->get('username') . ' does not exists in this leaderboard')
    			->with('type', 'error_no_scroll');
    	}

    	$user->username = $request->get('username');
    	$user->scores = json_encode($request->get('score'));
    	$user->save();

    	return redirect()->route('my.leaderboard', $tourneyId)
    		->with('message', 'The score for ' . $user->username . ' has been updated!')
    		->with('type', 'success');
    }
}
