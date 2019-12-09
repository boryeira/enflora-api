<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Users\User;

class UserTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'id' => (int)$user->id,
            'firstName' => (string)$user->first_name,
            'lastName' => (string)$user->last_name,
        ];
    }
}
