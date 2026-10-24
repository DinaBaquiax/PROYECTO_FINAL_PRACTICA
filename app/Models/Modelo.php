<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

abstract class Modelo extends Model
{
    public $timestamps = false;
    protected $guarded = [];
}