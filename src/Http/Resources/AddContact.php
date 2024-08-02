<?php

declare(strict_types=1);

namespace ValmarHoldings\DialerLiftUp\Http\Resources;

use ValmarHoldings\DialerLiftUp\Bases\Resource;

class AddContact extends Resource
{
    public string $apiEndpoint = "Dialers/uploadbase";

    //phpcs:ignore SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingAnyTypeHint,SlevomatCodingStandard.Functions.UnusedParameter.UnusedParameter
    public function toArray($request): array
    {
        $stringToEncode = $this->resource->campaign
            . ";"
            . $this->resource->mobilePhone
            . ";Name="
            . $this->resource->name
            . ";;9999;";
        $base64FileContent = base64_encode($stringToEncode);

        return [
            "campaign" => $this->resource->campaign,
            "cant" => 1,
            "fileb64" => $base64FileContent,
            "filename" => time() . "_" . mt_rand(1_000, 9_999),
        ];
    }
}
