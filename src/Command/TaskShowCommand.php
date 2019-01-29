<?php

namespace WhelmedCli\Command;

use Symfony\Component\Console\Output\OutputInterface;

class TaskShowCommand extends AbstractCommand
{
    public function __invoke($uuid, OutputInterface $output)
    {
        $json = $this->request('/task/show/' . $uuid);

        $task = $json->task;

        $output->writeln($this->color()->white($task->title));
        $output->writeln($this->color()->green($task->uuid));
        $output->writeln("");

        if ($task->dueDate) {
            $output->writeln($this->color()->cyan("\tDue:") .
                $this->color()->white($task->dueDate) . '(' . $task->dueDateReadable . ')');
        }

        if ($task->deferredUntil) {
            $output->writeln($this->color()->cyan("\tDeferred until:") .
                $this->color()->white($task->deferredUntil) . '(' . $task->deferredUntilReadable. ')');
        }

        if ($task->dueDate) {
            $output->writeln($this->color()->cyan("\tDue:") .
                $this->color()->white($task->dueDate));
        }

        if ($task->project) {
            $output->writeln($this->color()->cyan("\tProject:") .
                $this->color()->white($task->project->title));
        }

        if ($task->contexts) {
            $output->writeln($this->color()->cyan("\tContexts:"));
            foreach ($task->contexts as $context) {
                $output->writeln("\t\t" . $this->color()->green($context->uuid) .
                    $this->color()->white('@' . $context->title));
            }
        }

        $output->writeln($this->color()->cyan("\tFlagged:") .
            $this->color()->white($task->flagged ? 'yes' : 'no'));
        $output->writeln($this->color()->cyan("\tDone:") .
            $this->color()->white($task->done ? 'yes' : 'no'));

        if ($task->note_markdown) {
            $output->writeln($this->color()->cyan("\tNote:") .
                $this->color()->white($task->note_markdown));
        }
    }
}
