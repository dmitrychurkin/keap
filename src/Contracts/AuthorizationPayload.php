<?php

declare(strict_types=1);

namespace DmitryChurkin\Keap\Contracts;

interface AuthorizationPayload
{
    public function getCode(): string;
}
