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

/**
 * Instagram Account
 *
 * This class represents an account data returned by Instagram API application
 *
 * @author Vincent Composieux <vincent.composieux@gmail.com>
 */
class Account
{
    /**
     * @var integer Account identifier
     */
    protected $id;

    /**
     * @var string Account username
     */
    protected $username;

    /**
     * @var string Account full name
     */
    protected $fullname;

    /**
     * @var string Account biography
     */
    protected $bio;

    /**
     * @var string Account profile picture
     */
    protected $picture;

    /**
     * @var string Account website
     */
    protected $website;

    /**
     * Constructor
     *
     * @param \stdClass $object Instagram returned JSON object
     */
    public function __construct(\stdClass $object = null)
    {
        if (null !== $object) {
            $this->setFromObject($object);
        }
    }

    /**
     * Sets properties from an object returned by Instagram API
     *
     * @param \stdClass $object Instagram JSON returned data object
     *
     * @return Account
     *
     * @throws \RuntimeException When unable to find user property in object
     */
    public function setFromObject(\stdClass $object)
    {
        $user = $object->user;

        if (!$user instanceof \stdClass) {
            throw new \RuntimeException('Unable to find user object returned from JSON');
        }

        $this->id       = $user->id;
        $this->username = $user->username;
        $this->fullname = $user->full_name;
        $this->bio      = $user->bio;
        $this->picture  = $user->profile_picture;
        $this->website  = $user->website;

        return $this;
    }

    /**
     * Returns account identifier
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns account username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Returns account full name
     *
     * @return string
     */
    public function getFullname()
    {
        return $this->fullname;
    }

    /**
     * Returns account biography
     *
     * @return string
     */
    public function getBio()
    {
        return $this->bio;
    }

    /**
     * Returns account profile picture
     *
     * @return string
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Returns account website
     *
     * @return string
     */
    public function getWebsite()
    {
        return $this->website;
    }
}