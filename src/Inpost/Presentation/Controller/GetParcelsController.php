<?php

declare(strict_types=1);

namespace App\Inpost\Presentation\Controller;

use App\Inpost\Application\Query\GetParcelsQuery;
use App\Inpost\Presentation\Dto\GetParcelsParamsDto;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;
use App\Inpost\Domain\Model\InpostResult;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Throwable;

final class GetParcelsController extends AbstractController
{
    use HandleTrait;

    public function __construct(
        private readonly NormalizerInterface $normalizer,
        private LoggerInterface $logger,
        MessageBusInterface $messageBus,
    ) {
        $this->messageBus = $messageBus;
    }

    #[Route('/get_parcels', name: 'app_inpost_get_parcels', methods: ['GET'])]
    public function index(
        #[MapQueryString]
        GetParcelsParamsDto $query
    ): JsonResponse|NotFoundHttpException {
        $city = (string) $query->getCity();
        $postCode = (string) $query->getPostCode();

        try {
            /** @var InpostResult */
            $result = $this->handle(new GetParcelsQuery(city: $city, postCode: $postCode));
        } catch (Throwable $throwable) {
            $this->logger->error($throwable->getMessage());
            return $this->createNotFoundException();
        }

        $serializedResult = $this->normalizer->normalize($result, 'json');

        return $this->json($serializedResult);
    }
}
