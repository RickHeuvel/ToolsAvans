<?php

namespace SocialiteProviders\Avans;

use SocialiteProviders\Manager\OAuth1\AbstractProvider;
use SocialiteProviders\Manager\OAuth1\User;

class Provider extends AbstractProvider
{
    /**
     * Unique Provider Identifier.
     */
    const IDENTIFIER = 'AVANS';

    /**
     * {@inheritDoc}
     */
    public function user()
    {
        if (! $this->hasNecessaryVerifier()) {
            throw new \InvalidArgumentException("Invalid request. Missing OAuth verifier.");
        }
        
        $token = $this->getToken()["tokenCredentials"];
        $user = $this->server->getUserDetails($token);
        
        return (new User())->map([
            'id'       => $user->id,
            'nickname' => $user->nickname,
            'firstName'=> $user->firstName,
            'lastName' => $user->lastName,
            'location' => $user->location,
            'name'     => $user->name,
            'email'    => $user->email,
            'role'     => $user->extra['role']
        ])->setToken($token->getIdentifier(), $token->getSecret());
    }
}
