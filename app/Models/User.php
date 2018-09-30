<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    const ADMIN_TYPE = 'admin';
    const DEFAULT_TYPE = 'default';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function rates(){
        return $this->hasMany('App\Models\ShowEpisodesRate', 'user_id', 'id');
    }

    public function following(){
        return $this->hasMany('App\Models\ShowFollow', 'user_id', 'id');
    }

    public function isAdmin(){
        return $this->type === self::ADMIN_TYPE;
    }
}
