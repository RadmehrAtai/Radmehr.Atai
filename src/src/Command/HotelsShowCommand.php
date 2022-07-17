<?php

namespace App\Command;

use App\Repository\HotelRepository;
use App\Repository\UserRepository;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:hotels:show',
    description: 'A command to show all hotels that hotel owners have',
)]
class HotelsShowCommand extends Command
{

    private $userRepository;
    private $hotelRepository;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository, HotelRepository $hotelRepository, string $name = null)
    {
        parent::__construct($name);

        $this->userRepository = $userRepository;
        $this->hotelRepository = $hotelRepository;
    }


    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $arg1 = $input->getArgument('arg1');

        if ($arg1) {
            $io->note(sprintf('You passed an argument: %s', $arg1));
        }

        if ($input->getOption('option1')) {
            // ...
        }

        $hotels = $this->hotelRepository->findAll();
        $users = $this->userRepository->findAll();

        $owners = array();
        $h = array();

        foreach ($hotels as $hotel) {
            foreach ($users as $user) {
                if ($hotel->getOwner() === $user) {
                    $owners[] = $user->getEmail();
                    $h[] = $hotel->getName();
                }
            }
        }

        $table = new Table($output);
        $io->table(['Users', 'Hotels'], [
            [
                implode("\n",$owners),
                implode("\n",$h)
            ]
        ]);
        $table->setStyle('box-double');
        $table->render();

        return Command::SUCCESS;
    }
}
