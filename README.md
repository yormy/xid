# Xid

[![Latest Version on Packagist](https://img.shields.io/packagist/v/yormy/xid.svg?style=flat-square)](https://packagist.org/packages/yormy/xid)
[![Total Downloads](https://img.shields.io/packagist/dt/yormy/xid.svg?style=flat-square)](https://packagist.org/packages/yormy/xid)
![GitHub Workflow Status](https://img.shields.io/github/workflow/status/facade/ignition/run-php-tests?label=Tests)
![Alt text](./coverage.svg)


## Installation


You can install the package via composer:

```bash
composer require yormy/xid
```

# Adding Xid Id's
Add to your database migrations
```
$table->string('xid')->unique();
```



## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Yormy](https://gitlab.com/yormy)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
