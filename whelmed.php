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
use WhelmedCli\Command\ProjectDeleteCommand;
use WhelmedCli\Command\TodayCommand;
use WhelmedCli\Command\InboxCommand;
use WhelmedCli\Command\TaskFlagCommand;
use WhelmedCli\Command\TaskDeferCommand;
use WhelmedCli\Command\TaskUnflagCommand;
use WhelmedCli\Command\TaskArchiveCommand;
use WhelmedCli\Command\TaskArchiveConfirmCommand;

$dotEnv = new Dotenv();
$dotEnv->load(__DIR__.'/.env');

$app = new Silly\Edition\PhpDi\Application();

// Perspectives
$app->command('inbox', new InboxCommand(), ['i']);
$app->command('today', new TodayCommand(), ['t']);

$app->command('archive', new TaskArchiveCommand(), ['a']);
$app->command('archive:confirm', new TaskArchiveConfirmCommand(), ['a:c']);

// Tasks
$app->command('unflag uuid', new TaskUnflagCommand(), ['uf']);
$app->command('flag uuid', new TaskFlagCommand(), ['f']);
$app->command('move uuid project', new TaskMoveCommand(), ['m']);
$app->command('list', new TaskListCommand(), ['ls']);
$app->command('do uuid', new TaskDoCommand(), ['d']);
$app->command('show uuid', new TaskShowCommand(), ['s']);
$app->command('create title [-d|--dueDate=]* [-p|--project=]* [-c|--context=]* [--flag]', new TaskCreateCommand(), ['c', 'add']);
$app->command('defer uuid deferUntil', new TaskDeferCommand());


// Projects
$app->command('project:show uuid', new ProjectShowCommand(), ['p:show','p:s']);
$app->command('project:delete uuid', new ProjectDeleteCommand(), ['p:d']);
$app->command('project:list', new ProjectListCommand(), ['p:ls']);

$app->run();
