<?php

namespace DmitryChurkin\Keap;

use DmitryChurkin\Keap\AccessToken\{AccessTokenEntity, AccessTokenManager, AccessTokenSettings};
use DmitryChurkin\Keap\AccessTokenRepository\AccessTokenAdapter;
use DmitryChurkin\Keap\Contracts\Keap as KeapContract;
use DmitryChurkin\Keap\Transport\Http\Client as HttpClient;
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
            __DIR__ . '/../config/keap.php',
            'keap'
        );

        $this->app->singleton(KeapContract::class, function () {
            $accessTokenRepository = config('keap.access_token_repository');
            $accessTokenAdapter = AccessTokenAdapter::makeWithEntity(AccessTokenEntity::class);

            return new Keap(
                tokenManager: new AccessTokenManager(
                    accessTokenSettings: new AccessTokenSettings(
                        clientId: config('keap.client_id'),
                        clientSecret: config('keap.client_secret'),
                        redirectUri: config('keap.redirect_url'),
                    ),
                    httpClient: new HttpClient(),
                ),
                tokenRepository: $accessTokenRepository::makeWithAdapter($accessTokenAdapter),
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
                __DIR__ . '/../config/keap.php' => config_path('keap.php'),
            ], 'keap-config');
        }
    }
}
