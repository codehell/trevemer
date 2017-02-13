<?php

namespace Cawoch;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $guarded = [];

    public function getNameAttribute($key)
    {
        return $this->first_name .' '.$this->last_name;
    }
}
