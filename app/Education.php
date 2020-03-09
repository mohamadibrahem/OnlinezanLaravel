<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
   protected $fillable = [
      'lawyer_id', 'name', 'special', 'degree'
   ];
}
