<?php

namespace DmitryChurkin\Keap\Transport\Http;

interface HttpClient
{
    public function newJsonRequest();

    public function newFormRequest();
}
