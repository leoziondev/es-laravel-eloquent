<?php

namespace App\Accessors;

trait DefaultAccessors
{
    public function getTitleAttribute($value)
    {
        return strtoupper($value);
    }

    public function getTitleAndBodyAttribute()
    {
        return $this->title . ' - ' . $this->body;
    }

    // public function getDateAttribute()
    // {
    //     return date('d-m-Y');
    // }
}
