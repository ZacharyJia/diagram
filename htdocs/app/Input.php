<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Input extends Model
{
    protected $table = 'input';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
