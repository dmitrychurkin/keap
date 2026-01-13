<?php

declare(strict_types=1);

namespace DmitryChurkin\Keap\Contracts;

interface Authorization
{
    public function getAuthorizationUrl(?string $state = null): string;
}
