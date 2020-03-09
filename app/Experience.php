<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
   protected $fillable = [
      'lawyer_id', 'name', 'description', 'position'
   ];
}
