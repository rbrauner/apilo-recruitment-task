<?php

declare(strict_types=1);

namespace App\Inpost\Application\Query;

use App\Inpost\Application\Exception\ApiUrlIsNotAStringException;
use App\Inpost\Domain\Model\InpostResult;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

#[AsMessageHandler(fromTransport: 'sync')]
final readonly class GetParcelsForCityQueryHandler
{
    public function __construct(
        private ParameterBagInterface $params,
        private HttpClientInterface $client,
        private SerializerInterface $serializer,
    ) {
    }

    public function __invoke(GetParcelsForCityQuery $message): InpostResult
    {
        $apiUrl = $this->params->get('app.inpost.api_url');
        if (!is_string($apiUrl)) {
            throw new ApiUrlIsNotAStringException();
        }

        $query = ['city' => $message->getCity()];

        $result = $this->client->request('GET', $apiUrl, [
            'query' => $query,
        ]);
        $resultContent = $result->getContent();

        return $this->serializer->deserialize($resultContent, InpostResult::class, 'json');
    }
}
