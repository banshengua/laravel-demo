<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Userec extends Model
{
   protected $table="userec";
     protected $primaryKey='rec_id';
    public $timestamps = false;
}
