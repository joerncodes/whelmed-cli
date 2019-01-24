<?php

namespace WhelmedCli\Command;

use Symfony\Component\Console\Output\OutputInterface;

class TaskDeferCommand extends AbstractCommand
{
    public function __invoke($uuid, $deferUntil, OutputInterface $output)
    {
        $json = $this->request('/task/update/' . $uuid, 'PATCH', [
            'deferredUntil' => $deferUntil
        ]);

        $task = $json->task;
        $output->writeln($this->color()->green($task->uuid) . $this->color()->white($task->title) .
            'has been deferred.');
    }
}
