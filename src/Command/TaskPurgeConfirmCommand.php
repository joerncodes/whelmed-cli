<?php

namespace WhelmedCli\Command;

use Symfony\Component\Console\Output\OutputInterface;

class TaskPurgeConfirmCommand extends AbstractCommand
{
    public function __invoke(OutputInterface $output)
    {
        $json = $this->request('/task/purge/confirm', 'DELETE');

        if ($json->status == 'success') {
            $output->writeln($this->color()->green($json->message));
        } else {
            $output->writeln($this->color()->red($json->message));
        }
    }
}
