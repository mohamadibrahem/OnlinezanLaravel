<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConsultationNotification extends Model
{
   protected $fillable = [
      'lawyer_id',
      'consultation_id',
      'type',
      'status',
      'message_count',
   ];
}
