<?php

declare(strict_types=1);

namespace DmitryChurkin\Keap\AccessTokenRepository\Contracts;

interface AccessTokenModel
{
    public function getAccessToken(): string;

    public function getId(): string|int;
}
