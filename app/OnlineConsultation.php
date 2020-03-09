<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OnlineConsultation extends Model
{
   protected $fillable = [
      'conversation_id', 'payment_id', 'datetime', 'lawyer_id', 'client_id', 'status', 'time', 'price', 'comment'
   ];

   public function lawyer(){
      return $this->belongsTo('App\Lawyer');
   }

   public function client(){
      return $this->belongsTo('App\Client');
   }
}
