<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Humidity extends Model
{
    use scopeTraits;

    public $fillable = ['value'];
}
