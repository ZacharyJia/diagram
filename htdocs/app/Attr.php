<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attr extends Model
{
    protected $table = 'attr';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
