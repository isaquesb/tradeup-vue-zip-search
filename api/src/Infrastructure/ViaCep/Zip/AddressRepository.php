<?php

declare(strict_types=1);

namespace App\Infrastructure\ViaCep\Zip;

use App\Domain\ZipCode;

class AddressRepository implements ZipCode\AddressRepository
{
    public function findAddressByZip(string $zip): ZipCode\Address
    {
        $url = "https://viacep.com.br/ws/{$zip}/json/";
        $response = file_get_contents($url);
        $data = json_decode($response, true);

        if (isset($data['erro'])) {
            throw new ZipCode\AddressNotFoundException();
        }

        return new ZipCode\Address(
            $data['logradouro'],
            $data['bairro'],
            $data['localidade'],
            $data['uf'],
            $data['cep'],
        );
    }
}
