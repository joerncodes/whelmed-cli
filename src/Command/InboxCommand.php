<?php

namespace WhelmedCli\Command;

use Symfony\Component\Console\Output\OutputInterface;

class InboxCommand extends AbstractCommand
{
    public function __invoke(OutputInterface $output)
    {
        $json = $this->request('/perspective/inbox');

        $this->printTasks($json->tasks, $output);
    }
}
