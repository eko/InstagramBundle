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

/**
 * Media
 *
 * This class is used to interact with Media endpoint of Instagram API
 *
 * @author Vincent Composieux <vincent.composieux@gmail.com>
 */
class Media extends Endpoint
{
    /**
     * Returns information about a media object
     *
     * @api /v1/media/{id}
     *
     * @param integer $identifier Media identifier
     *
     * @return \stdClass
     */
    public function getMedia($identifier)
    {
        return $this->executeRequest('get', '/v1/media/'. $identifier);
    }

    /**
     * Returns search for media in a given area
     *
     * @api /v1/media/search
     *
     * @param float $latitude  Latitude GPS point
     * @param float $longitude Longitude GPS point
     *
     * Additionally, you can add the following options:
     * - min_timestamp: a unix timestamp. All media returned will be taken later than this timestamp.
     * - max_timestamp: a unix timestamp. All media returned will be taken earlier than this timestamp.
     * - distance:      default is 1km (distance=1000), max distance is 5km.
     *
     * @return \stdClass
     */
    public function getSearchArea($latitude, $longitude, array $options = array())
    {
        $url = '/v1/media/search';

        $options['lng'] = $longitude;
        $options['lat'] = $latitude;

        return $this->executeRequest('get', $url, $options);
    }

    /**
     * Returns a list of what media is most popular at the moment
     *
     * @api /v1/media/popular
     *
     * @return \stdClass
     */
    public function getPopular()
    {
        return $this->executeRequest('get', '/v1/media/popular');
    }
}