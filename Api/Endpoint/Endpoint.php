<?php
/*
 * This file is part of the Eko\InstagramBundle Symfony bundle.
 *
 * (c) Vincent Composieux <vincent.composieux@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eko\InstagramBundle\Api\Endpoint;

use Eko\InstagramBundle\Api\Client;
use Eko\InstagramBundle\Application\Application;

/**
 * Endpoint
 *
 * This class is the main Endpoint API class
 *
 * @author Vincent Composieux <vincent.composieux@gmail.com>
 */
class Endpoint extends Client
{
    /**
     * @var \Eko\InstagramBundle\Application\Application $application Application instance
     */
    protected $application;

    /**
     * Sets Application
     *
     * @param \Eko\InstagramBundle\Application\Application $application An Application instance
     *
     * @return Endpoint
     */
    public function setApplication(Application $application)
    {
        $this->application = $application;

        return $this;
    }

    /**
     * Returns Application
     *
     * @return \Eko\InstagramBundle\Application\Application
     */
    public function getApplication()
    {
        return $this->application;
    }

    /**
     * Execute an HTTP API request call and returns data
     *
     * @param string $method  HTTP method type (get, post, ...)
     * @param string $url     API called URL
     * @param array  $options Optionals method parameters
     *
     * @return \stdClass
     *
     * @throws \RuntimeException When Instagram application (client) is not set
     */
    public function executeRequest($method, $url, array $options = array())
    {
        if (null === $this->application) {
            throw new \RuntimeException('You must set Application before using an endpoint API method.');
        }

        $token = $this->application->getAccessToken();

        $url = sprintf($url . '?access_token=%s', $token);
        $url .= '&' . http_build_query($options);

        $response = $this->client->get($url)->send();

        $data = json_decode($response->getBody(true));

        return $data;
    }
}