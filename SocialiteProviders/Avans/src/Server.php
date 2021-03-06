<?php

namespace SocialiteProviders\Avans;

use League\OAuth1\Client\Credentials\TokenCredentials;
use SocialiteProviders\Manager\OAuth1\Server as BaseServer;
use SocialiteProviders\Manager\OAuth1\User;

class Server extends BaseServer
{
    /**
     * Get the URL for retrieving temporary credentials.
     *
     * @return string
     */
    public function urlTemporaryCredentials()
    {
        return 'https://publicapi.avans.nl/oauth/request_token';
    }
    /**
     * Get the URL for redirecting the resource owner to authorize the client.
     *
     * @return string
     */
    public function urlAuthorization()
    {
        return 'https://publicapi.avans.nl/oauth/saml.php';
    }
    /**
     * Get the URL retrieving token credentials.
     *
     * @return string
     */
    public function urlTokenCredentials()
    {
        return 'https://publicapi.avans.nl/oauth/access_token';
    }
    /**
     * Get the URL for retrieving user details.
     *
     * @return string
     */
    public function urlUserDetails()
    {
        return 'https://publicapi.avans.nl/oauth/people/@me';
    }
    /**
     * Take the decoded data from the user details URL and convert
     * it to a User object.
     *
     * @param mixed $data
     * @param \League\OAuth1\Client\Credentials\TokenCredentials $tokenCredentials
     *
     * @return \League\OAuth1\Client\Server\User
     */
    public function userDetails($data, TokenCredentials $tokenCredentials)
    {
        $user = new User();
        $user->id = $data['id'];
        $user->email = $data['emails'][0];
        $user->nickname = $data['nickname'];
        $user->name = $data['accounts']['username'];
        $user->firstName = $data['name']['givenName'];
        $user->lastName = $data['name']['familyName'];
        $user->location = $data['location'];

        if ($data['employee'] === 'true') {
            $user->extra['role'] = 'employee';
        } else {
            $user->extra['role'] = 'student';
        }

        return $user;
    }
    /**
     * Take the decoded data from the user details URL and extract
     * the user's UID.
     *
     * @param mixed $data
     * @param \League\OAuth1\Client\Credentials\TokenCredentials $tokenCredentials
     *
     * @return string|int
     */
    public function userUid($data, TokenCredentials $tokenCredentials)
    {
        // TODO: Implement userUid() method.
    }
    /**
     * Take the decoded data from the user details URL and extract
     * the user's email.
     *
     * @param mixed $data
     * @param \League\OAuth1\Client\Credentials\TokenCredentials $tokenCredentials
     *
     * @return string
     */
    public function userEmail($data, TokenCredentials $tokenCredentials)
    {
        // TODO: Implement userEmail() method.
    }
    /**
     * Take the decoded data from the user details URL and extract
     * the user's screen name.
     *
     * @param mixed $data
     * @param \League\OAuth1\Client\Credentials\TokenCredentials $tokenCredentials
     *
     * @return string
     */
    public function userScreenName($data, TokenCredentials $tokenCredentials)
    {
        // TODO: Implement userScreenName() method.
    }
}
