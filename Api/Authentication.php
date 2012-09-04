<?php
/*
 * This file is part of the Eko\InstagramBundle Symfony bundle.
 *
 * (c) Vincent Composieux <vincent.composieux@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eko\InstagramBundle\Api;

use Symfony\Bundle\FrameworkBundle\Routing\Router;

use Eko\InstagramBundle\Api\Client;
use Eko\InstagramBundle\Application\Application;

/**
 * Authentication
 *
 * This class is used to authenticate with Instagram API
 *
 * @author Vincent Composieux <vincent.composieux@gmail.com>
 */
class Authentication extends Client
{
    /**
     * @var array $parameters Authentication parameters
     */
    protected $parameters = array();

    /**
     * @var string $token Authentication token returned by Instagram (second step)
     */
    protected $token;

    /**
     * Constructor
     *
     * @param array $parameters Authentication parameters filled from configuration
     */
    public function __construct(array $parameters)
    {
        $this->parameters = $parameters;

        parent::__construct();
    }

    /**
     * Returns application access token
     *
     * @return string
     */
    public function getAccessToken()
    {
        return $this->token;
    }

    /**
     * Returns Instagram URL to get authentication code
     *
     * @return string
     */
    public function getAuthenticationCodeUrl()
    {
        $parameters = sprintf(
            '/oauth/authorize?client_id=%s&redirect_uri=%s&response_type=code',
            $this->parameters['client_id'],
            $this->parameters['redirect_url']
        );

        $request = $this->client->get($parameters);

        return $request->getUrl();
    }

    /**
     * Returns authentication token and user data returned by Instagram API
     *
     * @param string $code Authentication code returned by Instagram first-step query
     *
     * @return string
     *
     * @throws \RuntimeException When unable to parse json data returned
     */
    public function requestAccessToken($code)
    {
        $parameters = array(
            'grant_type'    => 'authorization_code',
            'client_id'     => $this->parameters['client_id'],
            'client_secret' => $this->parameters['client_secret'],
            'redirect_uri'  => $this->parameters['redirect_url'],
            'code'          => $code
        );

        $response = $this->client->post('/oauth/access_token', null, $parameters)->send();

        $data = json_decode($response->getBody(true));

        if (empty($data)) {
            throw new \RuntimeException('Unable to parse access token JSON data from Instagram API');
        }

        $this->token = $data->access_token;

        return $data;
    }
}