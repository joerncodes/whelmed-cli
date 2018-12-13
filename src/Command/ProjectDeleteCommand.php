<?php

namespace WhelmedCli\Command;

use Symfony\Component\Console\Output\OutputInterface;

class ProjectDeleteCommand extends AbstractCommand
{
    public function __invoke($uuid, OutputInterface $output)
    {
        $json = $this->request('/project/delete/' . $uuid, 'DELETE');

        $output->writeln(
            $this->color()->white($json->message)
        );
    }
}
