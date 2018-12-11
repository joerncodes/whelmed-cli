<?php

namespace WhelmedCli\Command;

use Symfony\Component\Console\Output\OutputInterface;

class ProjectListCommand extends AbstractCommand
{
    public function __invoke(OutputInterface $output)
    {
        $json = $this->request('/project/list');

        $projects = $json->projects;
        usort($projects, function($a, $b) {
            if($a->title == $b->title)
            {
                return 0;
            }

            return $a->title > $b->title;
        });

        foreach($projects as $project) {
            $output->writeln(
                $this->color()->green($project->uuid) .
                $this->color->white($project->title) . 
                $this->color->darkgray('(' . $project->taskCount->undone . ' undone)')
            );
        }
    }
}
