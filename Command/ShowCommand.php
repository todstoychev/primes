<?php

namespace Todstoychev\PrimesBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\{
    Input\InputInterface, Input\InputOption, Output\OutputInterface
};

class ShowCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('primes:show')
            ->setDescription('Generates primes list.')
            ->addOption('count', null, InputOption::VALUE_REQUIRED, 'Number of primes to generate')
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
        $count = $input->getOption('count');

        if (empty($count)) {
            $count = 10;
        }

        $primesGenerator = $this->getContainer()->get('todstoychev_primes.primes_generator');
        $primes = $primesGenerator->generate($count);
        $output->writeln(implode($primes, ', '));
    }

}
