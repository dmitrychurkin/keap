<?php

namespace DmitryChurkin\Keap\AccessTokenRepository\Contracts;

use DmitryChurkin\Keap\Contracts\Entity;

interface AccessTokenAdapter
{
    public function toEntity(AccessTokenModel $model): Entity;

    public function fromEntity(Entity $entity): array;
}
