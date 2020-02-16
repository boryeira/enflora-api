<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Response;

class UserController extends Controller
{

    public function fcmToken(Request $request)
    {
    return response()->json($request->fcmtoken);
      Auth::user()->fcm_token = $request->fcmtoken;
      if(Auth::user()->save()){
        return response()->json('guardado-'.Auth::user()->fcm_token.' enviado:'.$request->fcmtoken.'request:'.$request->toJson(), 200);
      } else {
        return response()->json('no guardado', 401);
      }

    }
}
