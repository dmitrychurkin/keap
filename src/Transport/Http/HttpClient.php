<?php

declare(strict_types=1);

namespace DmitryChurkin\Keap\Transport\Http;

interface HttpClient
{
    public function newJsonRequest();

    public function newFormRequest();
}
