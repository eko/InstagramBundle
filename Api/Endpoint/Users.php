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
     * Returns basic information about a specific user
     *
     * @api /v1/users/{id}
     *
     * @return \stdClass
     */
    public function getUser()
    {
        $url = '/v1/users/'. $this->application->getAccount()->getId();

        return $this->executeRequest('get', $url);
    }

    /**
     * Returns authenticated user feed
     *
     * @api /v1/users/self/feed
     *
     * Additionally, you can add the following options:
     * - count:  Count of media to return
     * - min_id: Return media later than this min_id
     * - max_id: Return media earlier than this max_id
     *
     * @return \stdClass
     */
    public function getFeed(array $options = array())
    {
        $url = '/v1/users/self/feed';

        return $this->executeRequest('get', $url, $options);
    }

    /**
     * Returns user most recent medias
     *
     * @api /v1/users/{id}/media/recent
     *
     * Additionally, you can add the following options:
     * - count:         Count of media to return
     * - max_timestamp: Return media before this UNIX timestamp
     * - min_timestamp: Return media after this UNIX timestamp
     * - min_id:        Return media later than this min_id
     * - max_id:        Return media earlier than this max_id
     *
     * @return \stdClass
     */
    public function getRecentMedias(array $options = array())
    {
        $url = '/v1/users/'. $this->application->getAccount()->getId() .'/media/recent';

        return $this->executeRequest('get', $url, $options);
    }

    /**
     * Returns authenticated user's list of media they've liked
     *
     * @api /v1/users/self/media/liked
     *
     * Additionally, you can add the following options:
     * - count:       Count of media liked to return
     * - max_like_id: Return media liked before this id
     *
     * @return \stdClass
     */
    public function getMediaLiked(array $options = array())
    {
        $url = '/v1/users/self/media/liked';

        return $this->executeRequest('get', $url, $options);
    }

    /**
     * Returns a search for a user by name
     *
     * @api /v1/users/search
     *
     * Additionally, you can add the following options:
     * - count: Number of users to return
     *
     * @return \stdClass
     */
    public function getSearch($query, array $options = array())
    {
        $url = '/v1/users/search';

        $options['q'] = $query;

        return $this->executeRequest('get', $url, $options);
    }
}