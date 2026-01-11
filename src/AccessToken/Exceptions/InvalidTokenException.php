<?php

declare(strict_types=1);

namespace DmitryChurkin\Keap\AccessToken\Exceptions;

use DmitryChurkin\Keap\Exceptions\KeapException;

final class InvalidTokenException extends KeapException
{
    public function __construct(string $message = '', array ...$rest)
    {
        parent::__construct("[InvalidTokenException]: {$message}", ...$rest);
    }
}
