<?php

declare(strict_types=1);

namespace App\Application\Actions\ZipCode;

use App\Application\Actions\Action;
use App\Domain\ZipCode\AddressRepository;
use Psr\Log\LoggerInterface;

abstract class ZipAction extends Action
{
    protected AddressRepository $addressRepository;

    public function __construct(LoggerInterface $logger, AddressRepository $addressRepository)
    {
        parent::__construct($logger);
        $this->addressRepository = $addressRepository;
    }
}
