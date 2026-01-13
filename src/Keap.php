<?php

declare(strict_types=1);

namespace DmitryChurkin\Keap;

use DmitryChurkin\Keap\AccessToken\Contracts\AccessToken;
use DmitryChurkin\Keap\AccessToken\Contracts\AccessTokenManager;
use DmitryChurkin\Keap\AccessTokenRepository\Contracts\AccessTokenRepository;
use DmitryChurkin\Keap\ApiServices\WithApiServices;

final class Keap implements Contracts\Keap
{
    use WithApiServices;

    public function __construct(
        private readonly AccessTokenManager $tokenManager,
        private readonly AccessTokenRepository $tokenRepository
    ) {}

    public function updateAccessToken(Contracts\AuthorizationPayload $authorizationPayload): AccessToken
    {
        $accessToken = $this->tokenManager->requestAccessToken($authorizationPayload->getCode());

        $this->tokenRepository->saveAccessToken($accessToken);

        return $this->tokenManager->getAccessToken();
    }

    public function getAuthorizationUrl(?string $state = null): string
    {
        return $this->tokenManager->getAuthorizationUrl($state);
    }

    public function refreshAccessToken(): AccessToken
    {
        $this->tokenManager->setAccessToken(
            $this->tokenRepository->getAccessToken()
        );

        if ($this->tokenManager->isAccessTokenExpired()) {
            $accessToken = $this->tokenManager->refreshAccessToken();

            $this->tokenRepository->saveAccessToken($accessToken);
        }

        return $this->tokenManager->getAccessToken();
    }

    public function getAccessToken(): string
    {
        return $this->refreshAccessToken()
            ->getAccessToken();
    }
}
