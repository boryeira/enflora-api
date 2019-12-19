<?php

namespace App\Http\Controllers\Orders;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Models\Order\Order;
use Response;
use Auth;

class OrderController extends ApiController
{

    public function store(Request $request)
    {
        $user = Auth::user();
        $items = $request->all();

        if(count($items)<=0){
          return Response()->json([
            'error' => 'no se an ingresado productos',
          ], 200);
        }


        foreach($items as $item){
          return Response()->json([
            'error' => $item,
          ], 200);

            $product = Product::find($item['id']);
            
            if($product->available < $item['quantity'])
            {
                return Response()->json([
                    'error' => $product->name.' supera el stock disponible.',
                ], 400);
            }
        }

        return Response()->json([
          'data' => 'verificado',
      ], 200);

        $order = new Order;
        $order->user_id = $user->id;
        $order->quantity = array_sum($items);
        $order->status = 2;
        $order->save();
  
        foreach ($items as $key => $q) {
              $product = Product::find($key);
              $item = new OrderItem;
              $item->order_id = $order->id;
              $item->name = $product->name;
              $item->product_id = $product->id;
              $item->quantity = $q;
              $item->amount = $product->value*$q;
              $item->unit = $product->unit['id'];
              $item->status = 1;
              $item->img = $product->img;
              $item->save();
              $product->consumed = $product->consumed + $q;
              if($product->available == 0){
                $product->status = 2 ;
              }
              $product->save();
            
        }

        $order->amount = $order->orderItems->sum('amount');
        if($order->save()) {
          return Redirect::route('orders.index');
        } else {
          return Redirect::back()->withErrors(array('db' => 'error en base de datos'));
        }

        return Response()->json([
            'data' => $request->all(),
        ], 200);
    }
}
