<?php

declare(strict_types=1);

namespace DmitryChurkin\Keap\Contracts;

interface Keap extends ApiServices\Contacts, Authentication, Authorization {}
