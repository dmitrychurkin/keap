<?php

declare(strict_types=1);

namespace DmitryChurkin\Keap\Tests\Unit;

use DmitryChurkin\Keap\AccessToken\AccessTokenEntity;
use DmitryChurkin\Keap\AccessToken\AccessTokenManager;
use DmitryChurkin\Keap\AccessToken\AccessTokenSettings;
use DmitryChurkin\Keap\Transport\Http\Client as HttpClient;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\TestCase;

final class AccessTokenManagerTest extends TestCase
{
    public function test_refresh_access_token_uses_http_client_and_returns_entity(): void
    {
        Http::fake([
            // Stub a JSON response for token endpoint
            AccessTokenSettings::DEFAULT_TOKEN_URL => Http::response([
                'access_token' => 'access-xyz',
                'refresh_token' => 'refresh-abc',
                'expires_in' => 3600,
            ], Response::HTTP_OK),
        ]);

        $accessTokenSettings = new AccessTokenSettings(
            clientId: 'client-id-123',
            clientSecret: 'client-secret-xyz',
            redirectUrl: 'https://example.com/redirect'
        );

        $manager = new AccessTokenManager(
            accessTokenSettings: $accessTokenSettings,
            httpClient: app()->make(HttpClient::class)
        );

        // Act
        $result = $manager->requestAccessToken('account-id-123');

        // Assert
        $this->assertInstanceOf(AccessTokenEntity::class, $result);
        $this->assertEquals('access-xyz', $result->getAccessToken());
        $this->assertEquals('refresh-abc', $result->getRefreshToken());
    }
}
