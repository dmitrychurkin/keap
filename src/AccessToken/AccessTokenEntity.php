<?php

namespace DmitryChurkin\Keap\AccessToken;

use DmitryChurkin\Keap\AccessToken\{Contracts, Exceptions};
use DmitryChurkin\Keap\Data\DataEntity;

final class AccessTokenEntity extends DataEntity implements Contracts\AccessToken
{
	private static function assertValidity(mixed $data): void
	{
		if (
			is_array($data) &&
			isset($data['error'])
		) {
			throw new Exceptions\InvalidTokenException($data['error_description']);
		}
	}

	public string $accessToken;

	public string $refreshToken;

	public int $endOfLife;

	public array $extraInfo;

	public function __construct(mixed $data = [])
	{
		self::assertValidity($data);

		if (is_object($data)) {
			$this->fromObject($data);
			return;
		}

		if (isset($data['access_token'])) {
			$this->setAccessToken($data['access_token']);
			unset($data['access_token']);
		}

		if (isset($data['refresh_token'])) {
			$this->setRefreshToken($data['refresh_token']);
			unset($data['refresh_token']);
		}

		if (isset($data['expires_in'])) {
			$this->setEndOfLife(time() + $data['expires_in']);
			unset($data['expires_in']);
		}

		if (count($data) > 0) {
			$this->setExtraInfo($data);
		}
	}

	public function getAccessToken(): string
	{
		return $this->accessToken;
	}

	public function setAccessToken(string $accessToken): void
	{
		$this->accessToken = $accessToken;
	}

	public function getEndOfLife(): int
	{
		return $this->endOfLife;
	}

	public function setEndOfLife(int $endOfLife): void
	{
		$this->endOfLife = $endOfLife;
	}

	public function getRefreshToken(): string
	{
		return $this->refreshToken;
	}

	public function setRefreshToken(string $refreshToken): void
	{
		$this->refreshToken = $refreshToken;
	}

	public function getExtraInfo(): array
	{
		return $this->extraInfo;
	}

	public function setExtraInfo(array $extraInfo): void
	{
		$this->extraInfo = $extraInfo;
	}

	public function isExpired(): bool
	{
		return ($this->getEndOfLife() < time());
	}

	public function fromObject(object $data): void
	{
		$this->setAccessToken($data->accessToken);
		$this->setRefreshToken($data->refreshToken);
		$this->setEndOfLife($data->endOfLife);
		$this->setExtraInfo($data->extraInfo);
	}
}
