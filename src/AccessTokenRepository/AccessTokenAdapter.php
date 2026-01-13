<?php

declare(strict_types=1);

namespace DmitryChurkin\Keap\AccessTokenRepository;

use DmitryChurkin\Keap\Contracts\Entity;

final class AccessTokenAdapter implements Contracts\AccessTokenAdapter
{
    public static function makeWithEntity(string $accessTokenEntityClass): Contracts\AccessTokenAdapter
    {
        return new self(
            accessTokenEntityClass: $accessTokenEntityClass,
        );
    }

    private function __construct(
        private readonly string $accessTokenEntityClass,
    ) {}

    public function toEntity(object $databaseRecord): Entity
    {
        return (new $this->accessTokenEntityClass(unserialize($databaseRecord->connection)))
            ->setId($databaseRecord->id);
    }

    public function fromEntity(Entity $entity): array
    {
        return [
            'connection' => serialize($entity),
        ];
    }
}
