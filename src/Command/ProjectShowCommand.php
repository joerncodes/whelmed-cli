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

        $this->printTasks($project->tasks, $output, "\t");
    }
}
