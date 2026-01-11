<?php

declare(strict_types=1);

namespace DmitryChurkin\Keap\AccessTokenRepository\Contracts;

use DmitryChurkin\Keap\Contracts\Entity;

interface AccessTokenRepository
{
    public static function makeWithAdapter(AccessTokenAdapter $accessTokenAdapter): AccessTokenRepository;

    public function getAccessToken(): Entity;

    public function saveAccessToken(Entity $tokenEntity): int;
}
