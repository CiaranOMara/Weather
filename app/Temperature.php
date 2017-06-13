<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Temperature extends Model
{
    use ScopeTrait;

    public $fillable = ['value'];
}
