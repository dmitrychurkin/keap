<?php

namespace DmitryChurkin\Keap\Transport\Http;

use Illuminate\Support\Facades\Http;

final class Client implements HttpClient
{
    public function newJsonRequest()
    {
        return Http::acceptJson();
    }

    public function newFormRequest()
    {
        return Http::asForm();
    }
}
