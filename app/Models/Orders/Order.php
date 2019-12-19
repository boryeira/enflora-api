<?php

namespace App\Models\Orders;

use Illuminate\Database\Eloquent\Model;
use App\Transformers\OrderTransformer;

class Order extends Model
{
  public $transformer = OrderTransformer::class;
  protected $dates = [
      'delivery_date','pay_date'
  ];


  public function getStatusAttribute($value)
  {
    $rawStatus = [
      '1'=> ['id'=>'1','admin'=>'Error','client'=>'Error','css'=>'danger'],
      '2'=> ['id'=>'2','admin'=>'Pendiente','client'=>'Pendiente pago','css'=>'secondary'],
      '3'=> ['id'=>'3','admin'=>'Pagado','client'=>'Pendiente de entrega','css'=>'success'],
      '4'=> ['id'=>'4','admin'=>'Entregado','client'=>'Entregado','css'=>'info'],

    ];
    return $rawStatus[$value];
  }



  public function user()
  {
      return $this->belongsTo('App\Models\Users\User');
  }

  public function orderItems()
  {
    return $this->hasMany('App\Models\Orders\OrderItem');
  }


}
