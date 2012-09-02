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
use Guzzle\Service\Client;

use Eko\InstagramBundle\Application\Application;

/**
 * Authentication
 *
 * This class is used to authenticate with Instagram API
 *
 * @author Vincent Composieux <vincent.composieux@gmail.com>
 */
class Authentication
{
    /**
     * @var \Guzzle\Service\Client $client Guzzle http client
     */
    protected $client;

    /**
     * @var string $apiBaseUrl Instagram API base url
     */
    protected $apiBaseUrl = 'https://api.instagram.com';

    /**
     * @var array $parameters Authentication parameters
     */
    protected $parameters = array();

    /**
     * @var string $authenticationCode Authentication code returned by Instagram (first step)
     */
    protected $authenticationCode;

    /**
     * Constructor
     *
     * @param array $parameters Authentication parameters filled from configuration
     */
    public function __construct(array $parameters)
    {
        $this->parameters = $parameters;
    }

    /**
     * Sets authentication returned by Instagram (first step)
     *
     * @param string $code Authentication code returned by Instagram
     *
     * @return Authentication
     */
    public function setAuthenticationCode($code)
    {
        $this->authenticationCode = $code;

        return $this;
    }

    /**
     * Returns Instagram URL to get authentication code
     *
     * @return string
     */
    public function getAuthenticationCodeUrl()
    {
        $client = new Client($this->apiBaseUrl);

        $parameters = sprintf(
            '/oauth/authorize?client_id=%s&redirect_uri=%s&response_type=code',
            $this->parameters['client_id'],
            $this->parameters['redirect_url']
        );

        $request = $client->get($parameters);

        return $request->getUrl();
    }

    public function getAccessToken()
    {
        $client = new Client($this->apiBaseUrl);

        $parameters = array(
            'grant_type'    => 'authorization_code',
            'client_id'     => $this->parameters['client_id'],
            'client_secret' => $this->parameters['client_secret'],
            'redirect_uri'  => $this->parameters['redirect_url'],
            'code'          => $this->authenticationCode
        );

        $request = $client->post('/oauth/access_token', null, $parameters);

        $response = $request->send();

        var_dump($response->getMessage()); exit;
    }
}