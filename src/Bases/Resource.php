<?php

declare(strict_types=1);

namespace ValmarHoldings\DialerLiftUp\Bases;

use Illuminate\Http\Resources\Json\JsonResource;
use ValmarHoldings\DialerLiftUp\Services\Processor;

abstract class Resource extends JsonResource
{
    public string $apiEndpoint = "";
    public string $httpMethod = "post";
    public ?string $response = null;
    public ?ValueObject $result = null;
    protected int $page;

    public function execute(int $page = 1): self
    {
        $this->page = $page;
        $response = (new Processor)
            ->send($this);
        $this->ingest($response);

        return $this;
    }

    public function ingest(string $response): self
    {
        $this->response = $response;

        return $this;
    }
}
