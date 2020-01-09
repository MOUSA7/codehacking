<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
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
        'name', 'email','photo_id', 'password','role_id','is_active',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];



    public function Role(){
        return $this->belongsTo('App\Role');
    }
    public function photo(){
        return $this->belongsTo('App\photo');
    }
    public function isAdmin(){
        if ($this->Role->name = 'Administrator'and $this->is_active == 1){
            return true;
        }
        return false;
    }

    public function posts(){
        return $this->hasMany('App\post');
    }
    public function category(){
        return $this->belongsTo('App\Category');
    }
}