<?php

namespace DmitryChurkin\Keap\AccessToken;

final class AccessTokenSettings
{
    public const DEFAULT_TOKEN_URL = 'https://api.infusionsoft.com/token';
    public const DEFAULT_AUTHORIZE_URL = 'https://accounts.infusionsoft.com/app/oauth/authorize';

    public function __construct(
        private readonly string $clientId,
        private readonly string $clientSecret,
        private readonly string $redirectUri,
        private readonly string $tokenUrl = self::DEFAULT_TOKEN_URL,
        private readonly string $authorizeUrl = self::DEFAULT_AUTHORIZE_URL,
    ) {}

    public function getClientId(): string
    {
        return $this->clientId;
    }

    public function getClientSecret(): string
    {
        return $this->clientSecret;
    }

    public function getRedirectUri(): string
    {
        return $this->redirectUri;
    }

    public function getTokenUrl(): string
    {
        return $this->tokenUrl;
    }

    public function getAuthorizeUrl(): string
    {
        return $this->authorizeUrl;
    }
}
