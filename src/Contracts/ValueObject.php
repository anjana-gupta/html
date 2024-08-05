<?php

declare(strict_types=1);

namespace ValmarHoldings\DialerLiftUp\Contracts;

use stdClass;

interface ValueObject
{
    public function from(stdClass $response): self;
}