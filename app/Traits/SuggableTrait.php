<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait SluggableTrait
{
    protected $separator;

    /**
     * Set slug attribute.
     *
     * @param string $value
     * @return void
     */
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value, $this->separator ?: '-');
    }
}