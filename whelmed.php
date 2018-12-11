<?php

chdir(__DIR__);

require_once('vendor/autoload.php');

use Symfony\Component\Dotenv\Dotenv;

use WhelmedCli\Command\TaskDoCommand;
use WhelmedCli\Command\TaskShowCommand;
use WhelmedCli\Command\TaskListCommand;
use WhelmedCli\Command\TaskMoveCommand;
use WhelmedCli\Command\TaskCreateCommand;
use WhelmedCli\Command\ProjectListCommand;
use WhelmedCli\Command\ProjectShowCommand;

$dotEnv = new Dotenv();
$dotEnv->load(__DIR__.'/.env');

$app = new Silly\Edition\PhpDi\Application();

$app->command('move uuid project', new TaskMoveCommand());
$app->command('project:show uuid', new ProjectShowCommand());
$app->command('project:list', new ProjectListCommand());
$app->command('list', new TaskListCommand());
$app->command('do uuid', new TaskDoCommand());
$app->command('show uuid', new TaskShowCommand());
$app->command('create title [dueDate] [-p|--project=]*', new TaskCreateCommand());
$app->run();
