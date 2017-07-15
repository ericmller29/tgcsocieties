<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Societies extends Model
{
    protected $table = 'societies';
    protected $fillable = ['name', 'user_id', 'platform'];

    public function user(){
    	return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function tourneys(){
    	return $this->hasMany('App\Tourneys', 'society_id', 'id');
    }
}
