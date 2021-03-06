<?php

namespace Mongrate\Command;

use Mongrate\Exception\CannotApplyException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DownCommand extends BaseMigrationCommand
{
    protected function configure()
    {
        $this->setName('down')
            ->setDescription('Revert your migration - execute the down method of your migration.');

        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        parent::execute($input, $output);

        $isAlreadyApplied = $this->isMigrationApplied($this->className);

        if ($isAlreadyApplied === false) {
            throw new CannotApplyException('Cannot go down - the migration is not applied yet.');
        } else {
            $this->migrate('down');
        }
    }
}
