<?php

declare(strict_types=1);

namespace ValmarHoldings\DialerLiftUp\ValueObjects;

use stdClass;
use ValmarHoldings\DialerLiftUp\Bases\ValueObject;

class AddedDNCNumber extends ValueObject
{
    // phpcs:ignore SlevomatCodingStandard.TypeHints.PropertyTypeHint.MissingAnyTypeHint
    protected $casts = [
        "code" => "integer",
        "status" => "string",
        "statusMessage" => "string",
    ];
    // phpcs:ignore SlevomatCodingStandard.TypeHints.PropertyTypeHint.MissingAnyTypeHint
    protected $fillable = [
        "code",
        "status",
        "statusMessage",
    ];

    public function from(stdClass $response): self
    {
        return new self([
            "code" => data_get($response, "code"),
            "status" => data_get($response, "status"),
            "statusMessage" => data_get($response, "status_message"),
        ]);
    }
}
