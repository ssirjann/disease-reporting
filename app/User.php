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
        'name', 'email', 'password', 'type',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Check if user is authorized medical personnel
     *
     * @return bool
     */
    public function isAuthorized()
    {
        return $this->type == 'authorized';
    }

    /**
     * Check if user is admin
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->type == 'admin';
    }

    /**
     * Check if a normal user is authenticated
     *
     * @return bool
     */
    public function isNormal()
    {
        return $this->type = 'normal';
    }
}
