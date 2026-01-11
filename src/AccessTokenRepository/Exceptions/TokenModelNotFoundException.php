<?php

declare(strict_types=1);

namespace DmitryChurkin\Keap\AccessTokenRepository\Exceptions;

use DmitryChurkin\Keap\Exceptions\KeapException;

final class TokenModelNotFoundException extends KeapException
{
    public function __construct(string $message = '', array ...$rest)
    {
        parent::__construct("[TokenModelNotFoundException]: {$message}", ...$rest);
    }
}
