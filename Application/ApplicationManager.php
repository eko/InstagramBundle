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

/**
 * ApplicationManager
 *
 * This class manage Instagram API applications defined in configuration
 *
 * @author Vincent Composieux <vincent.composieux@gmail.com>
 */
class ApplicationManager
{
    /**
     * @var array
     */
    protected $config;

    /**
     * @var array
     */
    protected $applications;

    /**
     * @var \Symfony\Bundle\FrameworkBundle\Routing\Router Router service
     */
    protected $router;

    /**
     * @param \Symfony\Bundle\FrameworkBundle\Routing\Router $router Router service
     * @param array                                          $config Configuration array
     */
    public function __construct(Router $router, array $config)
    {
        $this->config = $config;
        $this->router = $router;
    }

    /**
     * Check if application exists in configuration under 'applications' node
     *
     * @param string $application Application name
     *
     * @return bool
     */
    public function has($application) {
        return isset($this->config['applications'][$application]);
    }

    /**
     * Returns specified Application instance if exists
     *
     * @param string $application Application name
     *
     * @return Application
     *
     * @throws \InvalidArgumentException
     */
    public function get($application)
    {
        if (!$this->has($application)) {
            throw new \InvalidArgumentException(
                sprintf("Specified application '%s' is not defined in your configuration.", $application)
            );
        }

        if (!isset($this->applications[$application])) {
            $this->applications[$application] = new Application(
                $this->router,
                $this->config['applications'][$application]
            );
        }

        return $this->applications[$application];
    }
}