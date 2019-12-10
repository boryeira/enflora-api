<?php


namespace App\Auth;

use League\OAuth2\Server\Entities\AccessTokenEntityInterface;
use App\Models\Users\User;

class BearerTokenResponse extends \League\OAuth2\Server\ResponseTypes\BearerTokenResponse
{
    /**
     * Add custom fields to your Bearer Token response here, then override
     * AuthorizationServer::getResponseType() to pull in your version of
     * this class rather than the default.
     *
     * @param AccessTokenEntityInterface $accessToken
     *
     * @return array
     */
    protected function getExtraParams(AccessTokenEntityInterface $accessToken): array
    {
        $user = User::find($this->accessToken->getUserIdentifier());

        return [
            
            'user_id' => $user->id,
            'user_email' => $user->email,
            'user_full_name' => $user->first_name.' '.$user->last_name,
            
        ];
    }
}