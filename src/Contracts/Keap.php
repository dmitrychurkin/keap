<?php

declare(strict_types=1);

namespace DmitryChurkin\Keap\Contracts;

interface Keap extends
    Authentication,
    Authorization,
    ApiServices\Contacts {}
