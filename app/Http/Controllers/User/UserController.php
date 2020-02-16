<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Auth;
use Response;

class UserController extends ApiController
{

    public function fcmToken(Request $request)
    {

        Auth::user()->fcm_token = $request->fcmtoken;
        if(Auth::user()->save()){
            return response()->json('guardado-'.Auth::user()->fcm_token.' enviado:'.$request->fcmtoken.'request:'.$request->toJson(), 200);
        } else {
            return response()->json('no guardado', 401);
        }

    }
}
