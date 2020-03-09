<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConsultationFile extends Model
{
   protected $fillable = [
      'user_id',
      'consultation_id',
      'original_name',
      'filename',
   ];
}
