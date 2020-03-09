<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UrgentConsultation extends Model
{
   protected $fillable = [
      'lawyer_id', 'client_id', 'client_phone', 'status', 'description', 'conclusion', 'npa', 'received_datetime', 'closing_datetime'
   ];
   public function lawyer(){
      return $this->belongsTo('App\Lawyer');
   }

   public function client(){
      return $this->belongsTo('App\Client');
   }
}
