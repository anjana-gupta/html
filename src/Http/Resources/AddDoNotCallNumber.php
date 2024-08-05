<?php

declare(strict_types=1);

namespace ValmarHoldings\DialerLiftUp\Http\Resources;

use stdClass;
use ValmarHoldings\DialerLiftUp\Bases\Resource;
use ValmarHoldings\DialerLiftUp\ValueObjects\AddedDNCNumber;

class AddDoNotCallNumber extends Resource
{
    public function __construct(private string $lead)
    {
        $this->apiEndpoint = "";
        $this->httpMethod = "post";
    }

    // phpcs:ignore SlevomatCodingStandard.Functions.UnusedParameter.UnusedParameter, SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingAnyTypeHint
    public function toArray($request): array
    {
        return [];
    }

    public function ingest(string $response): Resource
    {
        parent::ingest($response);

        $this->result = (new AddedDNCNumber)->from((object) $response);

        return $this;
    }
}
