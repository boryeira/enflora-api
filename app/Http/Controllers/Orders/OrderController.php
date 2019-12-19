<?php

namespace App\Http\Controllers\Orders;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Models\Orders\Order;
use App\Models\Orders\OrderItem;
use App\Models\Products\Product;
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

        $total = 0;
        $quantity = 0;
        foreach($items as $item){
          $product = Product::find($item['id']);
          $total = $total + $item['quantity']*$product->value;
          $quantity = $quantity + $item['quantity'];
          if($product->available < $item['quantity'])
          {
            return Response()->json([
                'error' => $product->name.' supera el stock disponible.',
            ], 400);
          }
        }

        // return Response()->json([
        //   'data' => 'total: '.$total,
        // ], 200);

        $order = new Order;
        $order->user_id = $user->id;
        $order->quantity = $quantity;
        $order->status = 2;
        $order->save();
  
        foreach ($items as $item) {
              $product = Product::find($item['id']);
              $orderItem = new OrderItem;
              $orderItem->order_id = $order->id;
              $orderItem->name = $product->name;
              $orderItem->product_id = $product->id;
              $orderItem->quantity = $item['quantity'];
              $orderItem->amount = $product->value*$item['quantity'];
              $orderItem->unit = $product->unit['id'];
              $orderItem->status = 1;
              $orderItem->img = $product->img;
              $orderItem->save();
              $product->consumed = $product->consumed + $item['quantity'];
              if($product->available == 0){
                $product->status = 2 ;
              }
              $product->save();
            
        }

        $order->amount = $order->orderItems->sum('amount');
        if($order->save()) {
          return $this->showOne($order);
        } else {
          return Response()->json([
                  'error' => 'error DB',
                ], 200);
        }


    }

    public function show(Order $order)
    {
        return $this->showOne($order);
    }

    public function items(Order $order)
    {
        return $this->showAll($order->orderItems);
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return response()->json([
            'data' => 'deleted',
        ]);
    }
}
