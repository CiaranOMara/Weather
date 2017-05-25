<?php

namespace App;

use Carbon\Carbon;

trait scopeTraits
{

    /**
     * Scope the query to records created this year.
     *
     * @param  Builder $query
     * @return mixed
     */
    public function scopeThisYear($query)
    {
        return $query->where('created_at', '>=', Carbon::now()->firstOfYear());
    }

    /**
     * Scope the query to records created in the last 24 hours.
     *
     * @param  Builder $query
     * @return mixed
     */
    public function scopeLast24Hours($query)
    {
//        $now = Carbon::now();

        return $query->whereBetween('created_at', [Carbon::now()->subHours(24), Carbon::now()]);
    }
}