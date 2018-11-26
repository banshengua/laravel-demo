<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
     protected $table="staff";
     protected $primaryKey='sta_id';
    public $timestamps = false;
}
