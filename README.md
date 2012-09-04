InstagramBundle - A bundle to interact with Instagram API
=========================================================

[![Build Status](https://secure.travis-ci.org/eko/InstagramBundle.png?branch=master)](http://travis-ci.org/eko/InstagramBundle)

/!\ Currently in development

Features
--------

 * Authenticate with Instagram API
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

### 1) Create a first controller action to retrieve authentication code

```php
<?php
    /**
     * Get Instagram authentication code API action
     *
     * @Route("/instagram/authenticate", name="_demo_instagram_authenticate")
     * @Template()
     */
    public function authenticateAction()
    {
        $application = $this->get('eko_instagram.application.manager')->get('yourapplication');

        return $this->redirect($application->getAuthenticationCodeUrl());
    }
```

### 2) Create a second controller to use your API method

```php
<?php
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
```

More soon
---------

Do not hesitate to contribute!