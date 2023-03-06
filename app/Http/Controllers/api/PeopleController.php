<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PeopleStoreRequest;
use App\Models\People;
use Illuminate\Http\Request;

class PeopleController extends Controller
{
    public function store(PeopleStoreRequest $request)
    {
        People::query()->create([
            'device_id' => $request->device_id,
            'player_id' => $request->player_id
        ]);

        return response()->json([
            'status' => true,
            'message' =>'Kayıt başarılı.'
        ]);
    }
}
