<?php

namespace Cawoch;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $guarded = [];

    public function getNameAttribute($key)
    {
        return $this->first_name .' '.$this->last_name.' '.$this->snd_last_name;
    }

    public function scopeSearch($query, $search) {
        return $query->where(\DB::raw("concat(first_name, ' ', last_name)"), 'like', "%{$search}%")
            ->orWhere('last_name', 'like', "%{$search}%")
            ->orWhere('phone', 'like', "%{$search}%")
            ->orWhere('mobile', 'like', "%{$search}%")
            ->orWhere('email', 'like', "%{$search}%")
            ->orWhere('id_card', 'like', "%{$search}%")
            ->orderBy('id', 'desc')
            ->paginate()
            ->appends(['search' => $search]);
    }
}
