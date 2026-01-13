<?php

declare(strict_types=1);

namespace DmitryChurkin\Keap\AccessTokenRepository\Contracts;

use DmitryChurkin\Keap\Contracts\Entity;

interface AccessTokenAdapter
{
    public function toEntity(object $databaseRecord): Entity;

    public function fromEntity(Entity $entity): array;
}
