<?php

namespace App\Http\Controllers\Flow;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DarkGhostHunter\FlowSdk\Flow;

use App\Models\Orders\Order;

class FlowController extends Controller
{
    public $flow;

    public function __construct()
    {
        
        // $this->flow = Flow::make('sandbox', [
        //     'apiKey'    => '762E30CF-BA2B-4652-B187-613BE9L55983',
        //     'secret'    => 'e387e7709f340d1f7e2adb4d47a5f6c25bf44c22',
        // ]);
        $this->flow   = Flow::make('production', [
            'apiKey'    => '38EF2728-5354-4284-82BB-1L50EE34CC92',
            'secret'    => 'cb0876ba65ec412e78492ed365f9477b61098e53',
        ]);
    

    }

    public function orderPay(Order $order)
    {

          try {
            $paymentResponse = $this->flow->payment()->commit([
                'commerceOrder'     => $order->id,
                'subject'           => 'Membresía',
                'amount'            => $order->amount,
                'email'             => $order->user->email,
                'urlConfirmation'   => url('/').'/flow/confirm',
                'urlReturn'         => url('/').'/flow/return',
                'optional'          => [
                    'Message' => 'Tu orden esta en proceso!'
                ]
            ]);
          }
          catch ( Exception $e) {
              //return $e->getMessage();
              return response()->json([
                'error' => $e->getMessage(),
            ]);
          }

        return response()->json([
            'url' => $paymentResponse->getUrl(),
        ]);

    }

}
