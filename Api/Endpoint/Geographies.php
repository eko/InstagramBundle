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
 * Geographies
 *
 * This class is used to interact with Geographies endpoint of Instagram API
 *
 * @author Vincent Composieux <vincent.composieux@gmail.com>
 */
class Geographies extends Endpoint
{
    /**
     * Returns very recent media from a geography subscription that you created
     *
     * @api /v1/geographies/{id}/media/recent
     *
     * @param integer $identifier A Geography identifier
     *
     * Additionally, you can add the following options:
     * - count:  max number of media to return.
     * - min_id: return media before this min_id.
     *
     * @return \stdClass
     */
    public function getRecentMedia($identifier, array $options = array())
    {
        $url = '/v1/geographies/'. $identifier .'/media/recent';

        $options['client_id'] = $this->application->getParameter('client_id');

        return $this->executeRequest('get', $url, $options);
    }
}