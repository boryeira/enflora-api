<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Orders\Order;

class OrderTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Order $order)
    {
        return [
            'id' => (int)$order->id,
            'amount' => (string)'$'.number_format($order->amount, 0, ',', '.'),
            'amountRaw' => (int)$order->amount,
            'quantity' => (string)$order->quantity,
            'status' => (array)$order->status,
            'deliveryDate' => isset($order->delivery_date) ? (string)$order->delivery_date->format('d-m-Y') : null,
            'payDate' => isset($order->pay_date) ? (string)$order->pay_date->format('d-m-Y') : null,
            'createdAt' => (string)$order->created_at->format('d-m-Y'),
            'rels' => [
                'self' => [
                    'href' => route('orders.show',['order'=>$order->id]),
                ],
                'owner' => [
                    'id' => (int)$order->user_id,
                ],
                'orderItems' => [
                    'href' => route('orders.items',['order'=>$order->id]),
                ],

            ],
        ];
    }
}
