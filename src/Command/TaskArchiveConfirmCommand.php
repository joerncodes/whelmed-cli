<?php

namespace WhelmedCli\Command;

use Symfony\Component\Console\Output\OutputInterface;

class TaskArchiveConfirmCommand extends AbstractCommand
{
    public function __invoke(OutputInterface $output)
    {
        $json = $this->request('/task/archive/confirm', 'DELETE');

        if ($json->status == 'success') {
            $output->writeln($this->color()->green($json->message));
        } else {
            $output->writeln($this->color()->red($json->message));
        }
    }
}
