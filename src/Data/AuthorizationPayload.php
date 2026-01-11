<?php

namespace DmitryChurkin\Keap\Data;

use DmitryChurkin\Keap\Contracts\AuthorizationPayload as AuthorizationPayloadContract;

final class AuthorizationPayload implements AuthorizationPayloadContract
{
    public function __construct(
        private readonly string $code,
    ) {
    }

    public function getCode(): string
    {
        return $this->code;
    }
}
