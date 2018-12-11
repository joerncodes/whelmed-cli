<?php

namespace WhelmedCli\Command;

use Symfony\Component\Console\Output\OutputInterface;

class TaskListCommand extends AbstractCommand
{
    public function __invoke(OutputInterface $output)
    {
        $json = $this->request('/task/list');

        $tasks = $json->tasks;
        usort($tasks, function($a, $b) {
            if($a->project->title == $b->project->title)
            {
                return 0;
            }

            return $a->project->title > $b->project->title;
        });

        foreach($tasks as $task) {
            $taskString = $task->done ?
                $this->color()->darkgray($task->title) :
                $this->color()->white($task->title);

            if(isset($task->project->title)) {
                $output->writeln(
                    $this->color()->green($task->uuid) .
                    $this->color()->cyan($task->project->title) .
                    $taskString 
                ); 
            } 
            else
            {
                $output->writeln($this->color()->green($task->uuid) . $this->color()->white($task->title));
            }
        }
    }
}
