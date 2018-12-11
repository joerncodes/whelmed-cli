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
use WhelmedCli\Command\TodayCommand;

$dotEnv = new Dotenv();
$dotEnv->load(__DIR__.'/.env');

$app = new Silly\Edition\PhpDi\Application();

$app->command('today', new TodayCommand());
$app->command('move uuid project', new TaskMoveCommand(), ['m']);
$app->command('project:show uuid', new ProjectShowCommand(), ['p:show','p:s']);
$app->command('project:list', new ProjectListCommand(), ['p:ls']);
$app->command('list', new TaskListCommand(), ['ls']);
$app->command('do uuid', new TaskDoCommand(), ['d']);
$app->command('show uuid', new TaskShowCommand(), ['s']);
$app->command('create title [dueDate] [-p|--project=]*', new TaskCreateCommand(), ['c']);
$app->run();
