<?php
/*
 * This file is part of the Eko\InstagramBundle Symfony bundle.
 *
 * (c) Vincent Composieux <vincent.composieux@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eko\InstagramBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;

/**
 * AuthenticationController
 *
 * This controller is used to authenticate with the Instagram API
 *
 * @author Vincent Composieux <vincent.composieux@gmail.com>
 */
class AuthenticationController extends Controller
{
    /**
     * Most recent medias action
     *
     * @param \Symfony\Component\HttpFoundation\Request $request Request object
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function redirectAction(Request $request)
    {
        // Get returned code and obtain token access with it
        $code = $request->query->get('code');

        $application = $this->get('eko_instagram.application.manager')
            ->get('vcomposieux')
            ->authenticate($code);

        // Initialize Users API endpoint and set authenticated application
        $users = $this->get('eko_instagram.api.endpoint.users')
            ->setApplication($application);

        $medias = $users->getRecentMedias();
    }
}