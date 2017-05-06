<?php

namespace Cawoch;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $fillable = ['number'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
