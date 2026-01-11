<?php

declare(strict_types=1);

namespace DmitryChurkin\Keap\AccessToken\Contracts;

use DmitryChurkin\Keap\Contracts\Entity;

interface AccessToken extends Entity
{
    public function getAccessToken(): string;

    public function setAccessToken(string $accessToken): void;

    public function getEndOfLife(): int;

    public function setEndOfLife(int $endOfLife): void;

    public function getRefreshToken(): string;

    public function setRefreshToken(string $refreshToken): void;

    public function getExtraInfo(): array;

    public function setExtraInfo(array $extraInfo): void;

    public function isExpired(): bool;
}
