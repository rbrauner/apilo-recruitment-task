<?php

declare(strict_types=1);

namespace App\Tests\Inpost\Application\Query;

use App\Inpost\Application\Query\GetParcelsForCityQuery;
use App\Inpost\Application\Query\GetParcelsForCityQueryHandler;
use App\Inpost\Domain\Model\AddressDetails;
use App\Inpost\Domain\Model\InpostResult;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(GetParcelsForCityQueryHandler::class)]
final class GetParcelsForCityQueryHandlerTest extends TestCase
{
    public function testCorrectRequest(): void
    {
        // Assign
        $query = new GetParcelsForCityQuery('Kozy');
        $handler = new GetParcelsForCityQueryHandler();
        $firstAddressDetails = (new AddressDetails())
            ->setCity("Kozy")
            ->setProvince("śląskie")
            ->setPostCode("43-340")
            ->setStreet("Gajowa")
            ->setBuildingNumber("27")
            ->setFlatNumber(null)
        ;
        $lastAddressDetails = (new AddressDetails())
            ->setCity("Kozy")
            ->setProvince("śląskie")
            ->setPostCode("43-340")
            ->setStreet("Krakowska")
            ->setBuildingNumber("38A")
            ->setFlatNumber(null)
        ;

        // Act
        $result = $handler($query);

        // Assert
        static::assertNotNull($result);
        static::assertInstanceOf(InpostResult::class, $result);
        static::assertEquals(12, $result->getCount());
        static::assertEquals(1, $result->getPage());
        static::assertEquals(1, $result->getTotalPages());
        static::assertIsArray($result->getItems());
        static::assertCount(12, $result->getItems());
        static::assertEquals("KZY01A", $result->getItems()[0]->getName());
        static::assertEquals(
            $firstAddressDetails,
            $result->getItems()[0]->getAddressDetails()
        );
        static::assertEquals(
            $lastAddressDetails,
            $result->getItems()[11]->getAddressDetails()
        );
    }
}
