<?php

declare(strict_types=1);

namespace App\Inpost\Application\Query;

use App\Inpost\Domain\Model\InpostResult;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler(fromTransport: 'sync')]
final readonly class GetParcelsForCityQueryHandler
{
    public function __invoke(GetParcelsForCityQuery $message): InpostResult
    {
        return new InpostResult();
    }
}
