<?php
/*
 * This file is part of the Eko\InstagramBundle Symfony bundle.
 *
 * (c) Vincent Composieux <vincent.composieux@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eko\InstagramBundle\Application;

use Symfony\Bundle\FrameworkBundle\Routing\Router;

use Eko\InstagramBundle\Api\Authentication;

/**
 * Instagram Application
 *
 * This class represents an Instagram API application
 *
 * @author Vincent Composieux <vincent.composieux@gmail.com>
 */
class Application extends Authentication
{
    /**
     * @var array $config Configuration array
     */
    protected $config = array();

    /**
     * @var \Symfony\Bundle\FrameworkBundle\Routing\Router $router Router service
     */
    protected $router;

    /**
     * @var string $redirectRoute Redirect route
     */
    protected $redirectRoute;

    /**
     * Constructor
     *
     * @param array $config Configuration array
     */
    public function __construct(Router $router, $config)
    {
        $this->router = $router;
        $this->config = $config;

        $authenticationParameters = array(
            'client_id'     => $this->get('application_id'),
            'client_secret' => $this->get('application_secret'),
            'redirect_url'  => $this->generateRedirectUrl()
        );

        parent::__construct($authenticationParameters);
    }

    /**
     * Sets a configuration parameter
     *
     * @param string $parameter Parameter name
     * @param mixed  $value     Value to set
     *
     * @return Application
     */
    public function set($parameter, $value)
    {
        $this->config[$parameter] = $value;

        return $this;
    }

    /**
     * Returns a configuration parameter value
     *
     * @param string $parameter Parameter name
     *
     * @return null
     */
    public function get($parameter)
    {
        return isset($this->config[$parameter]) ? $this->config[$parameter] : null;
    }

    /**
     * Returns router generated redirect URL
     *
     * @return string
     */
    public function generateRedirectUrl()
    {
        $route = $this->get('redirect_route');

        return $this->router->generate($route, array(), true);
    }
}