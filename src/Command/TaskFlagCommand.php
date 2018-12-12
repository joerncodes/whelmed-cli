<?php

namespace WhelmedCli\Command;

use Symfony\Component\Console\Output\OutputInterface;

class TaskFlagCommand extends AbstractCommand
{
    public function __invoke($uuid, OutputInterface $output)
    {
        $json = $this->request('/task/update/' . $uuid, 'PATCH', [
            'flagged' => true
        ]);

        $task = $json->task;
        $output->writeln($this->color()->green($task->uuid) . $this->color()->white($task->title) .
            'has been marked as flagged.');
    }
}
