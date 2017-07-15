<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'gamer_tag', 'platform'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function societies(){
        return $this->hasMany('App\Societies', 'user_id', 'id');
    }

    public function tourneys(){
        return $this->hasMany('App\Tourneys', 'user_id', 'id');
    }
}
