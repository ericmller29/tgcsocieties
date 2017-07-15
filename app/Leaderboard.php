<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leaderboard extends Model
{
    protected $table = 'leaderboard';
    protected $fillable = ['username', 'scores', 'tourney_id'];

    public function tourney(){
    	return $this->belongsTo('App\Tourneys', 'tourney_id', 'id');
    }

    public function getScoresAttribute($value){
    	return json_decode($value);
    }

    public function getScoresTotal($scores){
    	return array_sum(get_object_vars($scores));
    }
}
