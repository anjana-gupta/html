<?php

declare(strict_types=1);

namespace ValmarHoldings\DialerPackage\Bases;

use Illuminate\Http\Resources\Json\JsonResource;
use stdClass;
use ValmarHoldings\CashierRepay\Services\Processor;

abstract class Resource extends JsonResource
{
    public string $httpMethod = "post";
    public string $apiEndpoint = "";
    public ?stdClass $response = null;
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

    public function ingest(stdClass $response): self
    {
        $this->response = $response;

        return $this;
    }
}
