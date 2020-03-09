<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lawyer extends Model
{
   //
   protected $fillable = [
   'user_id',
   'status',
   'firstname',
   'middlename',
   'lastname',
   'city_id',
   'specialization_id',
   'category_id',
   'online_consultation_price',
   'urgent_consultation_price',
   'education',
   'biography',
   'services',
   'video',
];

   public function user(){
      return $this->belongsTo('App\User');
   }

   public function city(){
      return $this->belongsTo('App\City');
   }

   public function service(){
      return $this->belongsTo('App\Service', 'specialization_id', 'id');
   }
}
