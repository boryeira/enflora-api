<?php

namespace App\Models\Users;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Transformers\UserTransformer;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
    public $transformer = UserTransformer::class;

    public function orders()
    {
        return $this->hasMany('App\Models\Orders\Order');
    }

    public function activeOrders()
    {
        return $this->hasMany('App\Models\Orders\Order')->where('delivery_date',null);
    }

    public function prescriptions()
    {
        return $this->hasMany('App\Models\Users\Prescription');
    }

    public function activePrescription()
    {
        return $this->hasOne('App\Models\Users\Prescription')->where('status','!=',3);
    }
    // public function revPrescription()
    // {
    //     return $this->hasMany('App\Models\User\Prescription')->where('status',1);
    // }

}
