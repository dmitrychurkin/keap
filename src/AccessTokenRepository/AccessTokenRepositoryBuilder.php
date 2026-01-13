<?php

declare(strict_types=1);

namespace DmitryChurkin\Keap\AccessTokenRepository;

final class AccessTokenRepositoryBuilder
{
    /**
     * @param  class-string<Contracts\AccessTokenRepository>  $accessTokenRepositoryClass
     */
    public static function from(string $accessTokenRepositoryClass): self
    {
        return new self($accessTokenRepositoryClass);
    }

    private Contracts\AccessTokenAdapter $accessTokenAdapter;

    private function __construct(
        /**
         * @var class-string<Contracts\AccessTokenRepository>
         */
        private readonly string $accessTokenRepositoryClass,
    ) {}

    /**
     * @param  class-string<DmitryChurkin\Keap\Contracts\Entity>  $accessTokenEntityClass
     */
    public function withEntity(string $accessTokenEntityClass): self
    {
        $this->accessTokenAdapter = AccessTokenAdapter::makeWithEntity(
            accessTokenEntityClass: $accessTokenEntityClass,
        );

        return $this;
    }

    public function build(): Contracts\AccessTokenRepository
    {
        if (method_exists($this->accessTokenRepositoryClass, 'makeWithAdapter')) {
            return $this->accessTokenRepositoryClass::makeWithAdapter(
                $this->accessTokenAdapter,
            );
        }

        return new $this->accessTokenRepositoryClass;
    }
}
