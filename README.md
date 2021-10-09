# Laravel-SlackReporter

[![Latest Version on Packagist](https://img.shields.io/packagist/v/feline-studio/laravel-slack-reporter.svg?style=flat-square)](https://packagist.org/packages/feline-studio/laravel-slack-reporter)
[![Total Downloads](https://img.shields.io/packagist/dt/feline-studio/laravel-slack-reporter.svg?style=flat-square)](https://packagist.org/packages/feline-studio/laravel-slack-reporter)
[![Package Test](https://github.com/Feline-Studio/Laravel-SlackReporter/actions/workflows/test.yml/badge.svg)](https://github.com/Feline-Studio/Laravel-SlackReporter/actions/workflows/test.yml)

Report website error to Slack channel.

## Installation

You can install the package via composer:

```bash
composer require feline-studio/laravel-slack-reporter
```

You will need to publish the config file of this package with this command:

```bash
php artisan vendor:publish --provider="FelineStudio\SlackReporter\SlackReporterServiceProvider"
```

The config file will be published in `config/slack-reporter.php`.
You will need to edit the config file and setup the Slack's incoming webhook url.

After configuring the package, you can use it to handle error by modifying the `register` function in `App\Exceptions\Handler`.

```php
    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            SlackReporter::handle($e);
        });
    }
```


### Testing

```bash
composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email david@feline.studio instead of using the issue tracker.

## Credits

-   [David Day](https://github.com/dj6082013)

## License

The GNU GPLv3. Please see [License](LICENSE) for more information.
