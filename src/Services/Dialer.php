<?php

declare(strict_types=1);

namespace ValmarHoldings\DialerUContact\Services;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use ValmarHoldings\DialerUContact\Bases\Resource;
use ValmarHoldings\DialerUContact\Http\Resources\EndSession;
use ValmarHoldings\DialerUContact\Http\Resources\GetUserToken;
use ValmarHoldings\DialerUContact\Providers\Service;

class Processor
{
    // phpcs:ignore SlevomatCodingStandard.Functions.FunctionLength.FunctionLength
    public function send(Resource $request): string
    {
        $package = Service::$packageName;
        $endpoint = config("dialer.{$package}.environment") === "SANDBOX"
            ? config("dialer.{$package}.sandbox-endpoint")
            : config("dialer.{$package}.production-endpoint");
        $userToken = (new GetUserToken)
            ->execute()
            ->response;
        $userToken = Str::replaceFirst("\n", "", $userToken);
        $response = Http::withHeaders([
            "Authorization" => "Basic {$userToken}",
            "Content-Type" => "application/x-www-form-urlencoded",
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

    protected function validate(string $endpoint, string $response): void
    {
        if ($endpoint !== "sip/getsips") {
            (new EndSession)
                ->execute();
        }

        if ($response && $response !== "0") {
            return;
        }

        throw new Exception("uContact Exception: {$response}");
    }
}
