<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApplicationConsultation extends Model
{
   protected $fillable = [
      'client_name',
      'client_phone',
      'client_email',
      'user_type',
      'service',
      'comment',
      'file',
      'lawyer_id',
      'status_id',
      'conclusion',
      'npa',
      'received_datetime',
      'closing_datetime'
   ];

   public function lawyer(){
      return $this->belongsTo('App\Lawyer');
   }

   public function status(){
      return $this->belongsTo('App\ApplicationStatus', 'status_id', 'id');
   }

}
