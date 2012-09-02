InstagramBundle - A bundle to interact with Instagram API
=========================================================

[![Build Status](https://secure.travis-ci.org/eko/InstagramBundle.png?branch=master)](http://travis-ci.org/eko/InstagramBundle)

/!\ Currently in development

Features
--------

 * Authenticate to Instagram API
 * Retrieve instagram photos

Installation / Configuration
----------------------------

### 1) Add this in your `app/routing.yml`

```yaml
eko_instagram:
  resource: "@EkoInstagramBundle/Resources/config/routing.xml"
```


### 2) Add your configuration in `app/config.yml`

```yaml
eko_instagram:
    applications:
        yourapplication:
            application_id: 000000000000000000000
            application_secret: 000000000000000000000
            redirect_route: eko_instagram_default_redirect
```

Authenticate user
-----------------

### Create a new controller action with the following line

```php
<?php

namespace Eko\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Acme\DemoBundle\Form\ContactType;

// these import the "@Route" and "@Template" annotations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DemoController extends Controller
{
    /**
     * Authenticate user with Instagram OAuth API
     *
     * @Route("/instagram/authenticate", name="_demo_instagram_authenticate")
     * @Template()
     */
    public function authenticateAction()
    {
        $application = $this->get('eko_instagram.application.manager')->get('yourapplication');

        return $this->redirect($application->getAuthenticationCodeUrl());
    }
}
```

More soon
---------

Do not hesitate to contribute!