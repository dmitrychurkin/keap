<?php

namespace DmitryChurkin\Keap\Contracts;

interface AuthorizationPayload
{
    public function getCode(): string;
}
