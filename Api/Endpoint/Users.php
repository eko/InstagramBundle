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

use Eko\InstagramBundle\Api\Endpoint\Endpoint;
use Eko\InstagramBundle\Application\Application;

/**
 * Users
 *
 * This class is used to interact with Users endpoint of Instagram API
 *
 * @author Vincent Composieux <vincent.composieux@gmail.com>
 */
class Users extends Endpoint
{
    /**
     * Returns most recent medias
     *
     * @return string
     *
     * @throws \RuntimeException When unable to parse json data returned
     */
    public function getRecentMedias()
    {
        $this->checkIfApplicationIsSet();

        $identifier = $this->application->getAccount()->getId();
        $token      = $this->application->getAccessToken();

        $url = sprintf('/v1/users/%s/media/recent/?access_token=%s', $identifier, $token);

        $response = $this->client->get($url)->send();

        $data = json_decode($response->getBody(true));

        return $data;
    }
}