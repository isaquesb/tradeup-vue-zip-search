<?php

declare(strict_types=1);

namespace App\Domain\ZipCode;

interface AddressRepository
{
    /**
     * @param string $zip
     * @return Address
     * @throws AddressNotFoundException
     */
    public function findAddressByZip(string $zip): Address;
}
