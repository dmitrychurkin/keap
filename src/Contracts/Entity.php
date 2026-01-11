<?php

namespace DmitryChurkin\Keap\Contracts;

interface Entity
{
    public function getId(): string|int;

    public function setId(string|int $id): self;

    public function fromObject(object $data): void;

    public function toString(): string;
}
