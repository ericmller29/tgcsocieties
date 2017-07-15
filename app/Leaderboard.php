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
}
