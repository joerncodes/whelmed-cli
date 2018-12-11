<?php

namespace WhelmedCli\Command;

use Symfony\Component\Console\Output\OutputInterface;

class ProjectShowCommand extends AbstractCommand
{
    public function __invoke($uuid, OutputInterface $output)
    {
        $json = $this->request('/project/' . $uuid);

        $project = $json->project;

        $output->writeln($this->color()->white($project->title));
        $output->writeln("\t" . 
            $this->color()->cyan('Uuid: ') .
            $this->color()->green($project->uuid)
        );
        $output->writeln("\t" . 
            $this->color()->cyan('Type: ') . 
            $this->color()->white($project->type)
        );
        $output->writeln("");
        $output->writeln("\t" . $this->color()->cyan('Tasks: '));

        usort($project->tasks, function($a, $b) {
            if($a->done && $b->done)
            {
                return 0;
            }
            if($a->done && !$b->done)
            {
                return 1;
            }

            return -1;
        });

        foreach($project->tasks as $task) {
            $taskString = $task->done ?
                $this->color()->darkgray($task->title) :
                $this->color()->white($task->title);

            $output->writeln("\t\t" .
                $this->color()->green($task->uuid) .
                $taskString
            );
        }
    }
}
