<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tourneys extends Model
{
    protected $table = 'tourneys';
    protected $fillable = ['name', 'course_name', 'entry_fee', 'start_date', 'duration', 'rounds', 'society_id', 'user_id', 'par', 'slug'];
    protected $hidden = ['user_id', 'society_id', 'created_at', 'updated_at', 'slug'];
    protected $dates = ['start_date'];

    public function society(){
    	return $this->belongsTo('App\Societies', 'society_id', 'id');
    }
    
    public function user(){
    	return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function leaderboard(){
    	return $this->hasMany('App\Leaderboard', 'tourney_id', 'id');
    }
}
