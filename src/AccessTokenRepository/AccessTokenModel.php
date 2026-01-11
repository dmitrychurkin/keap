<?php

declare(strict_types=1);

namespace DmitryChurkin\Keap\AccessTokenRepository;

final class AccessTokenModel implements Contracts\AccessTokenModel
{
    public function __construct(
        private readonly object $model,
    ) {}

    public function getAccessToken(): string
    {
        return $this->model->connection;
    }

    public function getId(): string|int
    {
        return $this->model->id;
    }
}
