<?php declare(strict_types = 1);

namespace Apishka\Tester\Command;

use Apishka\Tester\Tester as TesterRunner;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Apishka easy extend command
 */
class Tester extends \Symfony\Component\Console\Command\Command
{
    /**
     * {@inheritdoc}
     */
    protected function configure(): void
    {
        $this
            ->setName('apishka:tester')
            ->setDescription('Apishka tester')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $tester = TesterRunner::apishka();
        $result = $tester->execute();

        $data = $result->getData();
        if ($output->getVerbosity() == OutputInterface::VERBOSITY_NORMAL)
            $data = $result->cleanData($data);

        foreach ($data as $test)
            $this->drawTestData($output, $test);

        return 0;
    }

    /**
     * Draw test data
     * @param OutputInterface $output
     * @param array $test
     * @param int $level
     */
    protected function drawTestData(OutputInterface $output, array $test, int $level = 0): void
    {
        $output->writeln(
            str_pad('', $level * 2) .
            str_pad($test['name'], 74 - $level *2) .
            ($test['success'] ? '<info>[DONE]</info>' : '<error>[FAIL]</error>')
        );

        if (array_key_exists('error', $test))
        {
            $output->writeln(
                str_pad('', ($level + 1) * 2) .
                '<fg=red>' . $test['error'] . '</>'
            );
        }

        if (array_key_exists('subtests', $test))
        {
            foreach ($test['subtests'] as $subtest)
            {
                $this->drawTestData($output, $subtest, $level + 1);
            }
        }
    }
}