<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
   protected $fillable = [
      'user_id',
      'status',
      'date_storage',
   ];

   public function user(){
      return $this->belongsTo('App\User');
   }

}
