<?php

namespace DmitryChurkin\Keap\AccessTokenRepository;

use DmitryChurkin\Keap\Contracts\Entity;
use DmitryChurkin\Keap\AccessTokenRepository\Contracts;

class AccessTokenAdapter implements Contracts\AccessTokenAdapter
{
    public static function makeWithEntity(string $accessTokenEntityClass): self
    {
        return new self(
            accessTokenEntityClass: $accessTokenEntityClass,
        );
    }

    private function __construct(
        private readonly string $accessTokenEntityClass,
    ) {}

    public function toEntity(Contracts\AccessTokenModel $model): Entity
    {
        return $this->accessTokenEntityClass::from($model->getAccessToken())
            ->setId($model->getId());
    }

    public function fromEntity(Entity $entity): array
    {
        return [
            'connection' => $entity->toString()
        ];
    }
}
