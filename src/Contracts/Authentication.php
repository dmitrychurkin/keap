<?php

declare(strict_types=1);

namespace DmitryChurkin\Keap\Contracts;

use DmitryChurkin\Keap\AccessToken\Contracts\AccessToken;

interface Authentication
{
    public function updateAccessToken(AuthorizationPayload $authorizationPayload): AccessToken;

    public function refreshAccessToken(): AccessToken;

    public function getAccessToken(): string;
}
