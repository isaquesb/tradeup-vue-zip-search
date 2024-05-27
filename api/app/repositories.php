<?php

declare(strict_types=1);

use DI\ContainerBuilder;
use App\Infrastructure\ViaCep;

return function (ContainerBuilder $containerBuilder) {
    // Here we map our UserRepository interface to its in memory implementation
    $containerBuilder->addDefinitions([
        \App\Domain\ZipCode\AddressRepository::class => \DI\autowire(ViaCep\Zip\AddressRepository::class),
    ]);
};
