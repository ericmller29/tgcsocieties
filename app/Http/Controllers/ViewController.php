<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Societies;
use Auth;

class ViewController extends Controller
{
    public function society($societySlug){
		$data['society'] = Societies::where('slug', $societySlug)->first();

		// return $society->tourneys;
		return view('society', $data);
    }

    public function tourney($societySlug, $tourneySlug){
		$data['society'] = Societies::where('slug', $societySlug)->first();
		$data['tourney'] = $data['society']->tourneys()->where('slug', $tourneySlug)->first();
		$leaderboard = collect($data['tourney']->leaderboard);
		
		if(Auth::check()){
			$data['is_users'] = Auth::user()->societies()->find($data['society']->id)->count();
		}

		$data['leaderboard'] = $leaderboard->sort(function($a, $b){
			$scoreA = $a->getScoresTotal($a->scores);
			$scoreB = $b->getScoresTotal($b->scores);

			return $scoreA > $scoreB;
		});

		return view('tourney', $data);
    }
}
