<?php

declare(strict_types=1);

namespace DmitryChurkin\Keap\Contracts\ApiServices;

use Keap\Core\V2\Api\ContactApi;

interface Contacts
{
    public function contacts(): ContactApi;
}
