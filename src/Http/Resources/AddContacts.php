<?php

declare(strict_types=1);

namespace ValmarHoldings\DialerLiftUp\Http\Resources;

use ValmarHoldings\DialerCore\ValueObjects\Contact;
use ValmarHoldings\DialerLiftUp\Bases\Resource;
use ValmarHoldings\DialerLiftUp\Http\Resources\AddContact as UploadCallBase;

class AddContacts extends Resource
{
    public string $apiEndpoint = "";

    public function execute(int $page = 1): self
    {
        $this->page = $page;
        collect($this->resource)
            ->each(function (Contact $contact): void {
                $addContact = (new UploadCallBase($contact))
                    ->execute();
                $this->ingest($addContact->response);
            });

        return $this;
    }
}
