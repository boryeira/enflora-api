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

    // public function orders()
    // {
    //     return $this->hasMany('App\Models\Orders\Order');
    // }

}
