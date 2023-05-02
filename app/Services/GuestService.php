<?php

namespace App\Services;

use App\Models\Guest;
use Illuminate\Http\Request;

date_default_timezone_set('Europe/Moscow');

class GuestService
{
    public function create(Request $request)
    {
        $guest = new Guest(
            [
                'name' => $request['name'],
                'text' => $request['text'],
                'created_at' => date("Y-m-d H:i:s", strtotime('now')),
            ]
        );
        $guest->save();
        return $guest->id;
    }

}
