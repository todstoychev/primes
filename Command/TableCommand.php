<?php

namespace Todstoychev\PrimesBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\{
    Input\InputInterface, Input\InputOption, Output\OutputInterface
};

class TableCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('primes:table')
            ->setDescription('Generates primes multiplication table.')
            ->addOption('count', null, InputOption::VALUE_REQUIRED, 'Prime numbers count.')
        ;
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $count = 10;

        if ($input->getOption('count')) {
            $count = $input->getOption('count');
        }

        /** @var \Todstoychev\PrimesBundle\Generator\TableGenerator $tableGenerator */
        $tableGenerator = $this->getContainer()->get('todstoychev_primes.table_generator');
        /** @var \Todstoychev\PrimesBundle\Generator\PrimesGenerator $primesGenerator */
        $primesGenerator = $this->getContainer()->get('todstoychev_primes.primes_generator');
        $primes = $primesGenerator->generate($count);
        $tableGenerator->setColumns($primes);
        $table = $tableGenerator->generate();

        $output->writeln($table);
    }

}
