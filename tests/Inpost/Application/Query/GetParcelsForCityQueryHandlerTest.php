<?php

declare(strict_types=1);

namespace App\Tests\Inpost\Application\Query;

use App\Inpost\Application\Query\GetParcelsForCityQuery;
use App\Inpost\Application\Query\GetParcelsForCityQueryHandler;
use App\Inpost\Domain\Model\AddressDetails;
use App\Inpost\Domain\Model\InpostResult;
use PHPUnit\Framework\Attributes\CoversClass;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Messenger\Exception\ValidationFailedException;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Symfony\Component\Messenger\MessageBusInterface;

#[CoversClass(GetParcelsForCityQueryHandler::class)]
final class GetParcelsForCityQueryHandlerTest extends KernelTestCase
{
    public function testCorrectRequest(): void
    {
        // Assign
        $this->prepareClient();
        /** @var MessageBusInterface */
        $messenger = static::getContainer()->get('messenger.default_bus');
        $query = new GetParcelsForCityQuery('Kozy');
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
        $result = $messenger->dispatch($query);
        $result = $result->getMessage();

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
        /** @phpstan-ignore-next-line */
        static::assertNull($result->getItems()[-1]);
        /** @phpstan-ignore-next-line */
        static::assertNull($result->getItems()[12]);
    }

    public function testEmptyCity(): void
    {
        // Assign
        $this->prepareClient();
        /** @var MessageBusInterface */
        $messenger = static::getContainer()->get('messenger.default_bus');
        $query = new GetParcelsForCityQuery('');

        // Act & Assert
        static::expectException(ValidationFailedException::class);
        $result = $messenger->dispatch($query);
        $result->getMessage();
    }

    private function prepareClient(): void
    {
        $httpResultContent = '{"count":12,"page":1,"total_pages":1,"items":[{"name":"KZY01A","address_details":{"city":"Kozy","province":"śląskie","post_code":"43-340","street":"Gajowa","building_number":"27","flat_number":null}},{"name":"XXX","address_details":{"city":"XXX","province":"XXX","post_code":"XXX","street":"XXX","building_number":"XXX","flat_number":null}},{"name":"XXX","address_details":{"city":"XXX","province":"XXX","post_code":"XXX","street":"XXX","building_number":"XXX","flat_number":null}},{"name":"XXX","address_details":{"city":"XXX","province":"XXX","post_code":"XXX","street":"XXX","building_number":"XXX","flat_number":null}},{"name":"XXX","address_details":{"city":"XXX","province":"XXX","post_code":"XXX","street":"XXX","building_number":"XXX","flat_number":null}},{"name":"XXX","address_details":{"city":"XXX","province":"XXX","post_code":"XXX","street":"XXX","building_number":"XXX","flat_number":null}},{"name":"XXX","address_details":{"city":"XXX","province":"XXX","post_code":"XXX","street":"XXX","building_number":"XXX","flat_number":null}},{"name":"XXX","address_details":{"city":"XXX","province":"XXX","post_code":"XXX","street":"XXX","building_number":"XXX","flat_number":null}},{"name":"XXX","address_details":{"city":"XXX","province":"XXX","post_code":"XXX","street":"XXX","building_number":"XXX","flat_number":null}},{"name":"XXX","address_details":{"city":"XXX","province":"XXX","post_code":"XXX","street":"XXX","building_number":"XXX","flat_number":null}},{"name":"XXX","address_details":{"city":"XXX","province":"XXX","post_code":"XXX","street":"XXX","building_number":"XXX","flat_number":null}},{"name":"Kozy","address_details":{"city":"Kozy","province":"śląskie","post_code":"43-340","street":"Krakowska","building_number":"38A","flat_number":null}}]}';
        $httpResult = static::createMock(ResponseInterface::class);
        $httpResult
            ->method('getContent')
            ->willReturn($httpResultContent)
        ;

        $client = static::createMock(HttpClientInterface::class);
        $client
            ->method('request')
            ->with('GET', 'https://api-shipx-pl.easypack24.net/v1/points', [
                'query' => ['city' => 'Kozy'],
            ])
            ->willReturn($httpResult)
        ;

        static::getContainer()->set('http_client', $client);
    }
}
