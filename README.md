# Keap REST Client for Laravel

A Laravel package is port for integrating with the Keap (Infusionsoft) REST API after deprecation of https://github.com/infusionsoft/infusionsoft-php.

## Installation

### Development Setup (Local)

This package is currently set up for local development. It's already linked via your main application's composer.json.

```bash
composer require dmitrychurkin/keap
```

### Configuration

1. Publish the configuration file:

```bash
php artisan vendor:publish --tag=keap-config
```

2. Add your Keap credentials to your `.env` file:

```env
INFUSIONSOFT_CLIENT_ID=your_client_id
INFUSIONSOFT_SECRET=your_client_secret
INFUSIONSOFT_REDIRECT_URL=https://yourapp.com/keap/callback
```

TODO:
1. write a proper test coverage
2. extend with keap-sdk APIs

## License

MIT
