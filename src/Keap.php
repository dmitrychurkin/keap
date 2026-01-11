<?php

declare(strict_types=1);

namespace DmitryChurkin\Keap;

use DmitryChurkin\Keap\AccessToken\Contracts\AccessToken;
use DmitryChurkin\Keap\AccessToken\Contracts\AccessTokenManager;
use DmitryChurkin\Keap\AccessTokenRepository\Contracts\AccessTokenRepository;
use Keap\Core\V2\Api\ContactApi;
use Keap\Core\V2\Configuration;

final class Keap implements Contracts\Keap
{
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

    public function contacts(): ContactApi
    {
        return $this->makeRequest(ContactApi::class);
    }

    private function makeRequest(string $apiServiceClass)
    {
        $accessToken = $this->refreshAccessToken()
            ->getAccessToken();

        return new $apiServiceClass(
            config: (new Configuration)->setAccessToken($accessToken),
            selector: new HeaderSelector($accessToken),
        );
    }
}
