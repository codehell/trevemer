<?php

namespace Cawoch\Http\Controllers;

use Cawoch\Phone;

class PhoneController extends Controller
{
    public function delete(Phone $phone)
    {
        $client = $phone->client;
        $phone->delete();
        return redirect(route('client.show', $client));
    }
}
