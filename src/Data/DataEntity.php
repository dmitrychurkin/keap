<?php

namespace DmitryChurkin\Keap\Data;

use DmitryChurkin\Keap\Contracts\Entity;

abstract class DataEntity implements Entity
{
    public static function from(string|Entity $data): static
	{
		return is_string($data)
			? new static(unserialize($data))
			: $data;
	}

    protected string|int $id;

    abstract public function fromObject(object $data): void;

	public function toString(): string
	{
		return serialize($this);
	}

	public function getId(): string|int
	{
		return $this->id;
	}

	public function setId(string|int $id): self
	{
		$this->id = $id;

		return $this;
	}
}
