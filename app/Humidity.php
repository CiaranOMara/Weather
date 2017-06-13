<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Humidity extends Model
{
    use ScopeTrait;

    public $fillable = ['value'];
}
