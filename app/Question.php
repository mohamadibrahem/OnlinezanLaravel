<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
   protected $fillable = [
      'service_id', 'title', 'text', 'status'
   ];
}
