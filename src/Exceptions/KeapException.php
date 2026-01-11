<?php

namespace DmitryChurkin\Keap\Exceptions;

use Exception;

abstract class KeapException extends Exception {
    public function __construct(string $message = "", array ...$rest) {
        parent::__construct("[KeapException]: {$message}", ...$rest);
    }
}
