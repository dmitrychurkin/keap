<?php

declare(strict_types=1);

namespace DmitryChurkin\Keap;

use DmitryChurkin\Keap\AccessToken\AccessTokenEntity;
use DmitryChurkin\Keap\AccessToken\AccessTokenManager;
use DmitryChurkin\Keap\AccessToken\AccessTokenSettings;
use DmitryChurkin\Keap\AccessTokenRepository\AccessTokenRepositoryBuilder;
use DmitryChurkin\Keap\Contracts\Keap as KeapContract;
use DmitryChurkin\Keap\Transport\Http\Client as HttpClient;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

final class KeapServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/keap.php',
            'keap'
        );

        $this->app->singleton(KeapContract::class, function (Application $app) {
            $config = $app->make('config');

            return new Keap(
                tokenManager: new AccessTokenManager(
                    accessTokenSettings: new AccessTokenSettings(
                        clientId: $config->get('keap.client_id'),
                        clientSecret: $config->get('keap.client_secret'),
                        redirectUrl: $config->get('keap.redirect_url'),
                    ),
                    httpClient: new HttpClient,
                ),
                tokenRepository: AccessTokenRepositoryBuilder::from($config->get('keap.access_token_repository'))
                    ->withEntity(AccessTokenEntity::class)
                    ->build(),
            );
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/keap.php' => config_path('keap.php'),
            ], 'keap-config');
        }
    }
}
