<?php

namespace DmitryChurkin\Keap\AccessToken\Contracts;

use DmitryChurkin\Keap\Contracts\Entity;

interface AccessTokenManager
{
    public function requestAccessToken(string $code): AccessToken;

    public function refreshAccessToken(): AccessToken;

    public function isAccessTokenExpired(): bool;

    public function getAuthorizationUrl(?string $state = null): string;

    public function getAccessToken(): AccessToken;

    public function setAccessToken(string|Entity $data): AccessToken;
}
