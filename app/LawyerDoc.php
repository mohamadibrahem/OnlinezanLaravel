<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LawyerDoc extends Model
{
   protected $fillable = [
      'lawyer_id',
      'original_name',
      'filename',
   ];
}
