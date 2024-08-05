<?php

declare(strict_types=1);

namespace ValmarHoldings\DialerLiftUp\Services;

use Exception;
use Illuminate\Support\Facades\Http;
use ValmarHoldings\DialerLiftUp\Bases\Resource;

class Processor
{
    // phpcs:ignore SlevomatCodingStandard.Functions.FunctionLength.FunctionLength
    public function send(Resource $request): string
    {
        $endpoint = config("dialer.liftup.environment") === "SANDBOX"
            ? config("dialer.liftup.sandbox-endpoint")
            : config("dialer.liftup.production-endpoint");

        $response = Http::withHeaders([
            "Authorization" => config("dialer.liftup.authorization"),
            "Content-Type" => "application/json",
        ])
        ->asForm()
        ->{$request->httpMethod}(
            "{$endpoint}/{$request->apiEndpoint}",
            $request->toArray(request()),
        )
        ->throw();
        $response = $response->body();
        $this->validate($request->apiEndpoint, $response);

        return $response;
    }

    protected function validate(string $response): void
    {
        if ($response && $response !== "0") {
            return;
        }

        throw new Exception("liftUp Exception: {$response}");
    }
}
