<?php

namespace WhelmedCli\Command;

use Symfony\Component\Console\Output\OutputInterface;

class TaskCreateCommand extends AbstractCommand
{
    public function __invoke($title, $dueDate = null, $project = null, OutputInterface $output)
    {
        if(is_array($project)) {
            $project = $project[0];
        }

        if(!is_null($dueDate)) {
            $dateObject = new \DateTime($dueDate);
            $dueDate = $dateObject->format('Y-m-d H:i:s');
        }

        $title = explode('/', $title);

        foreach($title as $taskTitle)
        {
            $json = $this->request('/task/create', 'POST', [
                'title' => $taskTitle,
                'dueDate' => $dueDate,
                'project' => $project
            ]);
            if($json->status == 'success') {
                $output->writeln($this->color()->green('Created task ' . $json->task->title . ' (' . $json->task->uuid . ')'));
            } else {
                $output->writeln($this->color()->red($json->message));
            }
        }

    }
}
