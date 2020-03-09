<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contracts extends Model
{
   protected $fillable = [
      'title', 'text', 'file', 'price'
   ];
}
