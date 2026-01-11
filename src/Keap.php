<?php

namespace DmitryChurkin\Keap;

use DmitryChurkin\Keap\AccessToken\Contracts\{AccessToken, AccessTokenManager};
use DmitryChurkin\Keap\AccessTokenRepository\Contracts\AccessTokenRepository;
use DmitryChurkin\Keap\Contracts;
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

    public function getAuthorizationUrl(): string
    {
        return $this->tokenManager->getAuthorizationUrl();
    }

    public function refreshAccessToken(): AccessToken
    {
        $accessToken = $this->tokenManager->setAccessToken(
            $this->tokenRepository->getAccessToken()
        );

        if ($accessToken->isExpired()) {
            $accessToken = $this->tokenManager->refreshAccessToken();

            $this->tokenRepository->saveAccessToken($accessToken);
        }

        return $accessToken;
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
            config: (new Configuration())->setAccessToken($accessToken),
            selector: new HeaderSelector($accessToken),
        );
    }
}
