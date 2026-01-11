<?php

namespace DmitryChurkin\Keap;

final class HeaderSelector extends \Keap\Core\V2\HeaderSelector
{
    public function __construct(
        private readonly string $accessToken,
    ) {}

    public function selectHeaders(array $accept, string $contentType, bool $isMultipart): array
    {
        $headers = parent::selectHeaders($accept, $contentType, $isMultipart);

        $headers['Authorization'] = 'Bearer ' . $this->accessToken;

        return $headers;
    }
}
