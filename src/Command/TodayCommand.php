<?php

namespace WhelmedCli\Command;

use Symfony\Component\Console\Output\OutputInterface;

class TodayCommand extends AbstractCommand
{
    public function __invoke(OutputInterface $output)
    {
        $json = $this->request('/perspective/today');

        $this->printTasks($json->tasks, $output);
    }
}
