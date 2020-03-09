<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
   protected $fillable = [
     'first_user_id', 'second_user_id', 'is_accepted',
 ];
 public function appointment()
 {
     return $this->belongsTo('App\OnlineConsultation');
 }
}
