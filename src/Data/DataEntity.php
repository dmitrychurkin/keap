<?php

declare(strict_types=1);

namespace DmitryChurkin\Keap\Data;

use DmitryChurkin\Keap\Contracts\Entity;

abstract class DataEntity implements Entity
{
    protected string|int $id;

    abstract public function fromObject(object $data): void;

    public function getId(): string|int
    {
        return $this->id;
    }

    public function setId(string|int $id): Entity
    {
        $this->id = $id;

        return $this;
    }
}
