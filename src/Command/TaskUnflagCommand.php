<?php

namespace WhelmedCli\Command;

use Symfony\Component\Console\Output\OutputInterface;

class TaskUnflagCommand extends AbstractCommand
{
    public function __invoke($uuid, OutputInterface $output)
    {
        $json = $this->request('/task/update/' . $uuid, 'PATCH', [
            'flagged' => false
        ]);

        $task = $json->task;
        $output->writeln($this->color()->green($task->uuid) . $this->color()->white($task->title) .
            'has been marked as NOT flagged.');
    }
}
