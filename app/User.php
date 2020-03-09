<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
  use HasApiTokens, Notifiable;
  /**
  * The attributes that are mass assignable.
  *
  * @var array
  */
  protected $fillable = [
   'role_id', 'status', 'firstname',  'lastname', 'middlename', 'email', 'phone', 'profile_photo', 'password',
  ];

  /**
  * The attributes that should be hidden for arrays.
  *
  * @var array
  */
  protected $hidden = [
    'password', 'remember_token',
  ];

  public function lawyer(){
     return $this->belongsTo('App\Lawyer', 'id', 'user_id');
  }

  public function client(){
     return $this->belongsTo('App\Client', 'id', 'user_id');
  }
}
