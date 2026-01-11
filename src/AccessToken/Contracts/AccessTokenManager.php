<?php

declare(strict_types=1);

namespace DmitryChurkin\Keap\AccessToken\Contracts;

interface AccessTokenManager
{
    public function requestAccessToken(string $code): AccessToken;

    public function refreshAccessToken(): AccessToken;

    public function isAccessTokenExpired(): bool;

    public function getAuthorizationUrl(?string $state = null): string;

    public function getAccessToken(): AccessToken;

    public function setAccessToken(AccessToken $accessToken): void;
}
