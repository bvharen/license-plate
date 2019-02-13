# license-plate

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)

## Structure

```
src/
tests/
```

## Install

Via Composer

``` bash
$ composer require bvanharen/license-plate
```

## Example

``` php
$licensePlate = new Bvanharen\LicensePlate();
$licensePlate->set('XN901V');
echo $licensePlate->get();
```


## Testing

``` bash
$ composer test
```

## Security


## Credits

- [Brian van Haren][link-author]
## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[link-author]: https://github.com/bvanharen
