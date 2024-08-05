<?php

declare(strict_types=1);

namespace ValmarHoldings\DialerLiftUp\Http\Resources;

use Illuminate\Support\Str;
use ValmarHoldings\DialerCore\ValueObjects\PhoneCall;
use ValmarHoldings\DialerLiftUp\Bases\Resource;

class DialNumber extends Resource
{
    public function __construct(PhoneCall $phoneCall)
    {
        $this->apiEndpoint = "";

        parent::__construct($phoneCall);
    }

    public function ingest(string $response): Resource
    {
        parent::ingest($response);

        return $this;
    }

    //phpcs:ignore SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingAnyTypeHint,SlevomatCodingStandard.Functions.UnusedParameter.UnusedParameter
    public function toArray($request): array
    {
        return [];
    }
}
