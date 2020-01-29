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
        
    //   $this->flow = Flow::make('production', [
    //     'apiKey'    => '7B19A4CF-F041-40C4-9488-4180L75A6AAA',
    //     'secret'    => '8a8c824cd4550b1ee4d581a1d3404d9d640638b0',
    //   ]);
      $this->flow = Flow::make('sandbox', [
              'apiKey'    => '367F3C6A-DEB8-46F7-89E5-32CLED2236B9',
              'secret'    => '65d9f9656b478aaa7be72267bc33f40747f47c94',
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

    public function returnFlow(Request $request)
    {
      $payment = $this->flow->payment()->get($request->token);
      $paymentData = $payment->paymentData;
      $order = Order::find($payment->commerceOrder);
      if($order->status['id']==3)
      {
        return view('flow.return');
      }
      else 
      {
        return view('flow.error');
      }
      
    }

    public function confirmFlow(Request $request)
    {
      $payment = $this->flow->payment()->get($request->token);
      $paymentData = $payment->paymentData;
      $order = Order::find($payment->commerceOrder);
      if($order->status['id']==2)
      {
        $order->status = 3;
        $order->save();

      }
      return Response()->json([
                  'data' => 'ok',
              ], 200);
    }

}
