<?php

declare(strict_types=1);

namespace DmitryChurkin\Keap\AccessTokenRepository;

use DmitryChurkin\Keap\Contracts\Entity;
use Illuminate\Support\Facades\DB;

final class AccessTokenRepository implements Contracts\AccessTokenRepository
{
    public static function makeWithAdapter(Contracts\AccessTokenAdapter $accessTokenAdapter): Contracts\AccessTokenRepository
    {
        return new self($accessTokenAdapter);
    }

    private function __construct(
        private readonly Contracts\AccessTokenAdapter $accessTokenAdapter,
    ) {}

    public function getAccessToken(): Entity
    {
        $databaseRecord = DB::table('infusionsoft_accounts')
            ->latest()
            ->first();

        if (! $databaseRecord) {
            throw new Exceptions\TokenModelNotFoundException('Access token model not found.');
        }

        $accessTokenModel = new AccessTokenModel($databaseRecord);

        return $this->accessTokenAdapter->toEntity($accessTokenModel);
    }

    public function saveAccessToken(Entity $tokenEntity): int
    {
        $accessToken = $this->getAccessToken();

        return DB::table('infusionsoft_accounts')
            ->where('id', $accessToken->getId())
            ->update(
                $this->accessTokenAdapter->fromEntity($tokenEntity)
            );
    }
}
