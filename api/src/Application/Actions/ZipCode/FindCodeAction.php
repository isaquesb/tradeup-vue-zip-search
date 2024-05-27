<?php

declare(strict_types=1);

namespace App\Application\Actions\ZipCode;

use Psr\Http\Message\ResponseInterface as Response;

class FindCodeAction extends ZipAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $zipCode = $this->resolveArg('code');
        $address = $this->addressRepository->findAddressByZip($zipCode);

        $this->logger->info("Address of code `{$zipCode}` was found.");

        return $this->respondWithData($address);
    }
}
