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

use Guzzle\Service\Client as GuzzleClient;

/**
 * Client
 *
 * This class is used to prepare a Guzzle HTTP client for all Api classes
 *
 * @author Vincent Composieux <vincent.composieux@gmail.com>
 */
class Client
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
     * Constructor
     */
    public function __construct()
    {
        $this->client = new GuzzleClient($this->apiBaseUrl);
    }

    /**
     * Returns Guzzle HTTP client instanciated with base Instagram API
     *
     * @return \Guzzle\Service\Client
     */
    public function getClient()
    {
        return $this->client;
    }
}