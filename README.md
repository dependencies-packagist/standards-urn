# Uniform Resource Names (URNs)

A simple library to work with Uniform Resource Names (URNs) based on the [RFC 8141](https://tools.ietf.org/html/rfc8141).

[![GitHub Tag](https://img.shields.io/github/v/tag/dependencies-packagist/standards-urn)](https://github.com/dependencies-packagist/standards-urn/tags)
[![Total Downloads](https://img.shields.io/packagist/dt/standards/urn?style=flat-square)](https://packagist.org/packages/standards/urn)
[![Packagist Version](https://img.shields.io/packagist/v/standards/urn)](https://packagist.org/packages/standards/urn)
[![Packagist PHP Version Support](https://img.shields.io/packagist/php-v/standards/urn)](https://github.com/dependencies-packagist/standards-urn)
[![Packagist License](https://img.shields.io/github/license/dependencies-packagist/standards-urn)](https://github.com/dependencies-packagist/standards-urn)

## Installation

You can install the package via [Composer](https://getcomposer.org/):

```bash
composer require standards/urn
```

## Usage

```php
use Standards\URN\NamespaceSpecificString;
use Standards\URN\UniformResourceName;

$urn = UniformResourceName::parse('urn:ietf:params:oauth:jwk-thumbprint:sha-256:NzbLsXh8...');
var_dump($urn->getNamespaceIdentifier());     // ietf
var_dump($urn->getNamespaceSpecificString()); // params:oauth:jwk-thumbprint:sha-256:NzbLsXh8...

$nss = NamespaceSpecificString::parse($urn->getNamespaceSpecificString());
var_dump($nss->getNamespace());    // params
var_dump($nss->getSubNamespace()); // oauth
var_dump($nss->getResource());     // jwk-thumbprint
var_dump($nss->getType());         // sha-256
var_dump($nss->getValue());        // NzbLsXh8...


$nss = NamespaceSpecificString::build(
    value: 'NzbLsXh8...'
);
$nss = NamespaceSpecificString::build()->setValue('NzbLsXh8...');
$urn = UniformResourceName::build('ietf', $nss);
var_dump($urn->toString()); // urn:ietf:params:oauth:jwk-thumbprint:sha-256:NzbLsXh8...
```

## License

Nacosvel Contracts is made available under the MIT License (MIT). Please see [License File](LICENSE) for more information.
