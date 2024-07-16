<?php

declare(strict_types=1);

namespace App\Inpost\Presentation\Command;

use Override;
use App\Inpost\Application\Query\GetParcelsQuery;
use App\Inpost\Domain\Model\InpostResult;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Throwable;

#[AsCommand(
    name: 'app:inpost:get-parcels-for-city',
    description: 'Get inpost parcels for city',
)]
final class GetParcelsForCityCommand extends Command
{
    use HandleTrait;

    public function __construct(
        private readonly SerializerInterface $serializer,
        MessageBusInterface $messageBus,
    ) {
        $this->messageBus = $messageBus;
        parent::__construct();
    }

    #[Override]
    protected function configure(): void
    {
        $this
            ->addArgument('city', InputArgument::REQUIRED, 'City where parcels are located')
        ;
    }

    #[Override]
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $city = (string) $input->getArgument('city');

        try {
            /** @var InpostResult */
            $result = $this->handle(new GetParcelsQuery(city: $city));
        } catch (Throwable $throwable) {
            $io->error($throwable->getMessage());

            return Command::FAILURE;
        }

        $serializedResult = $this->serializer->serialize($result, 'json');
        $io->success(sprintf('Parcels for city %s fetched successfully: %s', $city, $serializedResult));

        return Command::SUCCESS;
    }
}
