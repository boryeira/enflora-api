<?php

namespace App\Models\Orders;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
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
      return $this->belongsTo('App\Models\Product\Product');
  }
  
  public function order()
  {
      return $this->belongsTo('App\Models\Order\Order');
  }
}
