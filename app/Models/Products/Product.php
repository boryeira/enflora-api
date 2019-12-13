<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Model;
use App\Transformers\ProductTransformer;

class Product extends Model
{
    protected $appends = array('available');
    public $transformer = ProductTransformer::class;

    public function getAvailableAttribute()
    {
      $available = $this->quantity - $this->consumed;
      return $available;
    }

    public function getTypeAttribute($value)
    {
      $rawType = [
        '1'=> ['id'=>'1','name'=>'Flor','css'=>'success'],
        '2'=> ['id'=>'2','name'=>'Extracto','css'=>'warning'],
        '3'=> ['id'=>'3','name'=>'Comestible','css'=>'danger'],
        '4'=> ['id'=>'4','name'=>'Accesorio','css'=>'primary'],
      ];
      return $rawType[$value];
    }
    public function getStatusAttribute($value)
    {
      $rawStatus = [
        '1'=> ['id'=>'1','name'=>'Activo','css'=>'success'],
        '2'=> ['id'=>'2','name'=>'Inactivo','css'=>'danger'],
        '3'=> ['id'=>'3','name'=>'Pre-compra','css'=>'info'],
      ];
      return $rawStatus[$value];
    }

    public function getUnitAttribute($value)
    {
      $rawStatus = [
        '1'=> ['id'=>'1','singular'=>'Unidad','plural'=>'Unidades'],
        '2'=> ['id'=>'2','singular'=>'Gramo','plural'=>'Gramos'],
      ];
      return $rawStatus[$value];
    }


}
