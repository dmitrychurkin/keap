<?php

declare(strict_types=1);

namespace DmitryChurkin\Keap\Contracts;

interface Entity
{
    public function getId(): string|int;

    public function setId(string|int $id): Entity;

    public function fromObject(object $data): void;
}
