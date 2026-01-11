<?php

declare(strict_types=1);

namespace DmitryChurkin\Keap\Contracts;

use DmitryChurkin\Keap\AccessToken\Contracts\AccessToken;
use Keap\Core\V2\Api\ContactApi;

interface Keap
{
    public function updateAccessToken(AuthorizationPayload $authorizationPayload): AccessToken;

    public function getAuthorizationUrl(?string $state = null): string;

    public function refreshAccessToken(): AccessToken;

    public function contacts(): ContactApi;
}
