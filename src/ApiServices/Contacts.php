<?php

namespace DmitryChurkin\Keap\ApiServices;

use Keap\Core\V2\Api\ContactApi;

trait Contacts
{
    public function contacts(): ContactApi
    {
        return $this->makeRequest(ContactApi::class);
    }
}
