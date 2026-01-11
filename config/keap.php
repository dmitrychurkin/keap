<?php

declare(strict_types=1);

use DmitryChurkin\Keap\AccessTokenRepository\AccessTokenRepository;

return [
    'client_id' => env('INFUSIONSOFT_CLIENT_ID', ''),

    'client_secret' => env('INFUSIONSOFT_SECRET', ''),

    'redirect_url' => env('INFUSIONSOFT_REDIRECT_URL', ''),

    'access_token_repository' => AccessTokenRepository::class,
];
