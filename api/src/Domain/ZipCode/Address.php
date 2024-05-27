<?php

declare(strict_types=1);

namespace App\Domain\ZipCode;

use JsonSerializable;

class Address implements JsonSerializable
{

    public string $street;

    public string $neighborhood;

    public string $city;

    public string $state;

    public string $zip;

    public function __construct(string $street, string $neighborhood, string $city, string $state, string $zip)
    {
        $this->street = $street;
        $this->neighborhood = $neighborhood;
        $this->city = $city;
        $this->state = $state;
        $this->zip = $zip;
    }

    #[\ReturnTypeWillChange]
    public function jsonSerialize(): array
    {
        return [
            'street' => $this->street,
            'neighborhood' => $this->neighborhood,
            'city' => $this->city,
            'state' => $this->state,
            'zip' => $this->zip,
        ];
    }
}
