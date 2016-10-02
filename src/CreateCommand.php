<?php


namespace App;

use App\Perceptron\Perceptron;
use App\Perceptron\Teacher;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class CreateCommand extends Command
{
    protected function configure()
    {
        $this->setName('create')
            ->setDescription('Create perseptron')
            ->addArgument(
                'elements', InputArgument::REQUIRED,
                'How many inputs does it have?'
            )
            ->addArgument(
                'bias', InputArgument::REQUIRED,
                'Which bias should it use'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $elements = $input->getArgument('elements');
        $bias = $input->getArgument('bias');

        $perceptron = new Perceptron($elements, $bias);

        $output->writeln([
            '<info>Perseptron was successfully created!</info>',
            '<info>With ' . $elements . ' elements</info>',
            '<info>And bias equals to ' . $bias . '</info>',
        ]);


        $helper = $this->getHelper('question');

        $output->writeln('<comment>We are ready to start learning.</comment>');
        $question = new Question('<question>How many iterations do you wish?</question>', 10000);

        $times = $helper->ask($input, $output, $question);

        $teacher = new Teacher;
        $teacher->teach($perceptron, $times);

        $output->writeln('<info>Perseptron is successfully teached!</info>');

        $variant = null;
        do {
            $question = new Question('<question>Which variant do you want to check?</question>', 'q');

            $variant = $helper->ask($input, $output, $question);

            if ($variant !== 'q') {
                $data = explode($variant, ' ');

                if ($perceptron->check($data)) {
                    $output->writeln('<info>It is 5</info>');
                } else {
                    $output->writeln('<info>It is not 5</info>');
                }
            } else {
                $output->writeln('<info>Bye</info>');
            }
        } while ($variant !== 'q');
    }
}
