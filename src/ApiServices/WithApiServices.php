<?php

namespace DmitryChurkin\Keap\ApiServices;

use Keap\Core\V2\Configuration;

trait WithApiServices
{
    use Contacts;

    protected function makeRequest(string $apiServiceClass)
    {
        $accessToken = $this->getAccessToken();

        return new $apiServiceClass(
            config: (new Configuration)->setAccessToken($accessToken),
            selector: new HeaderSelector($accessToken),
        );
    }
}
