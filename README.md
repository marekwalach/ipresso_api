# iPresso REST API Client
[![Total Downloads](https://img.shields.io/packagist/dt/michalper/ipresso_api.svg)](https://packagist.org/packages/michalper/ipresso_api/)
[![Latest Stable Version](https://img.shields.io/packagist/v/michalper/ipresso_api.svg)](https://packagist.org/packages/michalper/ipresso_api/)

## Documentation

- [API Documentation](http://apidoc.ipresso.pl/v2/en/)

## Installation

Install the latest version with

```bash
$ composer require michalper/ipresso_api
```
## Examples

### Authentication

```php
<?php

$ipresso = new iPresso();
$ipresso->setLogin('login');
$ipresso->setPassword('password');
$ipresso->setCustomerKey('customerKey');
$ipresso->setUrl('https://yourdomain.ipresso.pl');
$token = $ipresso->getToken();
```

### Adding new contact

```php
<?php

use \iPresso\Model\Contact;
use \iPresso\Service\Response;

$contact = new Contact();
$contact->setEmail('email@address.com');
$contact->setFirstName('FirstName');
$contact->setLastName('LastName');

/** @var Response $response */
$response = $ipresso->contact->add($contact);
```

### Collect contact’s data with a given ID number

```php
<?php

use \iPresso\Service\Response;

$idContact = 1;
/** @var Response $response */
$response = $ipresso->contact->get($idContact);
```

### Adding activity to a contact


```php
<?php

use \iPresso\Service\Response;
use \iPresso\Model\ContactActivity;

$idContact = 1;
$contactActivity = new ContactActivity();
$contactActivity->setKey('activityKey');
$contactActivity->setDate('2017-01-01 00:00:01');
$contactActivity->addParameter('parameterKey','parameterValue');

/** @var Response $response */
$response = $ipresso->contact->addActivity($idContact, $contactActivity);
```

## About

### Requirements

- iPresso REST API Client works with PHP 5.3 or above.

### Submitting bugs and feature requests

Bugs and feature request are tracked on [GitHub](https://github.com/michalper/ipresso_api/issues)