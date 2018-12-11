<?php

namespace WhelmedCli\Command;

use Symfony\Component\Console\Output\OutputInterface;

class TaskDoCommand extends AbstractCommand
{
    public function __invoke($uuid, OutputInterface $output)
    {
        $json = $this->request('/task/do/' . $uuid);

        if($json->status == 'success') {
            $output->writeln($this->color()->green($json->message));
        } else {
            $output->writeln($this->color()->red($json->message));
        }
    }
}
