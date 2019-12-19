<?php

namespace App\Models\Orders;

use Illuminate\Database\Eloquent\Model;
use App\Transformers\OrderItemTransformer;


class OrderItem extends Model
{
  public $transformer = OrderItemTransformer::class;
  public function getUnitAttribute($value)
  {
    $rawStatus = [
      '1'=> ['id'=>'1','singular'=>'Unidad','plural'=>'Unidades'],
      '2'=> ['id'=>'1','singular'=>'Gramo','plural'=>'Gramos'],
    ];
    return $rawStatus[$value];
  }
  
  public function product()
  {
      return $this->belongsTo('App\Models\Products\Product');
  }
  
  public function order()
  {
      return $this->belongsTo('App\Models\Orders\Order');
  }
}
