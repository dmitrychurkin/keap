<?php

declare(strict_types=1);

namespace DmitryChurkin\Keap\AccessToken;

use DmitryChurkin\Keap\Transport\Http\HttpClient;

final class AccessTokenManager implements Contracts\AccessTokenManager
{
    private Contracts\AccessToken $accessToken;

    public function __construct(
        private readonly AccessTokenSettings $accessTokenSettings,
        private readonly HttpClient $httpClient,
    ) {}

    public function getAccessToken(): Contracts\AccessToken
    {
        return $this->accessToken;
    }

    public function setAccessToken(Contracts\AccessToken $accessToken): void
    {
        $this->accessToken = $accessToken;
    }

    public function isAccessTokenExpired(): bool
    {
        $token = $this->getAccessToken();

        if (! is_object($token)) {
            return true;
        }

        return $token->isExpired();
    }

    public function requestAccessToken(string $code): Contracts\AccessToken
    {
        $response = $this->httpClient
            ->asForm()
            ->post($this->accessTokenSettings->getTokenUrl(), [
                'client_id' => $this->accessTokenSettings->getClientId(),
                'client_secret' => $this->accessTokenSettings->getClientSecret(),
                'code' => $code,
                'grant_type' => 'authorization_code',
                'redirect_uri' => $this->accessTokenSettings->getRedirectUrl(),
            ]);

        return $this->setTokenFromResponse($response);
    }

    public function refreshAccessToken(): Contracts\AccessToken
    {
        $response = $this->httpClient
            ->asForm()
            ->withHeaders([
                'Authorization' => 'Basic '.base64_encode($this->accessTokenSettings->getClientId().':'.$this->accessTokenSettings->getClientSecret()),
            ])
            ->post($this->accessTokenSettings->getTokenUrl(), [
                'grant_type' => 'refresh_token',
                'refresh_token' => $this->getAccessToken()->getRefreshToken(),
            ]);

        return $this->setTokenFromResponse($response);
    }

    public function getAuthorizationUrl(?string $state = null): string
    {
        $params = [
            'client_id' => $this->accessTokenSettings->getClientId(),
            'redirect_uri' => $this->accessTokenSettings->getRedirectUrl(),
            'response_type' => 'code',
            'scope' => 'full',
        ];

        if ($state) {
            $params['state'] = (string) $state;
        }

        return $this->accessTokenSettings->getAuthorizeUrl().'?'.http_build_query($params);
    }

    private function setTokenFromResponse($response): Contracts\AccessToken
    {
        $this->setAccessToken(new AccessTokenEntity($response->json()));

        return $this->getAccessToken();
    }
}
