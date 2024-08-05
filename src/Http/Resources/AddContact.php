<?php

declare(strict_types=1);

namespace ValmarHoldings\DialerLiftUp\Http\Resources;

use ValmarHoldings\DialerLiftUp\Bases\Resource;

class AddContact extends Resource
{
    public string $apiEndpoint = "";

    //phpcs:ignore SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingAnyTypeHint,SlevomatCodingStandard.Functions.UnusedParameter.UnusedParameter
    public function toArray($request): array
    {
        return [];
    }
}