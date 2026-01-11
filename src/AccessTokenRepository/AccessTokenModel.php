<?php

namespace DmitryChurkin\Keap\AccessTokenRepository;
use DmitryChurkin\Keap\AccessTokenRepository\Contracts;

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
