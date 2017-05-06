<?php

namespace Cawoch;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $guarded = [];

    public function phones()
    {
        return $this->hasMany(Phone::class);
    }

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }

    public function getNameAttribute($key)
    {
        return $this->first_name .' '.$this->last_name.' '.$this->snd_last_name;
    }

    public function scopeSearch($query, $search) {
        return $query->select('clients.*')
            ->leftjoin('phones', 'clients.id', '=', 'phones.client_id')
            ->leftjoin('vehicles', 'clients.id', '=', 'vehicles.client_id')
            ->whereRaw("concat(first_name,' ', last_name) like ?", ["%$search%"])
            ->orWhere('snd_last_name', 'like', "%{$search}%")
            ->orWhere('email', 'like', "%{$search}%")
            ->orWhere('id_card', 'like', "%{$search}%")
            ->orWhere('number', 'like', "%{$search}%")
            ->orWhere('plate', 'like', "%{$search}%")
            ->distinct('clients.id')
            ->orderBy('clients.id', 'desc')
            ->simplePaginate()
            ->appends(['search' => $search]);
    }
}
