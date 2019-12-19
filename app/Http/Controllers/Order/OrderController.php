<?php

namespace App\Http\Controllers\Order;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Models\Order\Order;
use Response;

class OrderController extends ApiController
{

    public function create(Request $request)
    {
        return Response()->json([
            'data' => 'llegueee!!',
        ]);
    }
}
