<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceControl extends Model
{
   protected $fillable = [
      'name',
      'phone',
      'comment',
   ];
}
