<?php

namespace WhelmedCli\Command;

use Symfony\Component\Console\Output\OutputInterface;

class TaskMoveCommand extends AbstractCommand
{
    public function __invoke($uuid, $project, OutputInterface $output)
    {
        $json = $this->request('/task/update/' . $uuid, 'PATCH', [
            'project' => $project
        ]);

        $task = $json->task;
        $output->writeln($this->color()->green($task->uuid) . $this->color()->white($task->title) .
            'has been moved to project ' . $this->color()->cyan($task->project->title) . '.');
    }
}
