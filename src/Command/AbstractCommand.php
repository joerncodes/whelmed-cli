<?php

namespace WhelmedCli\Command;

use GuzzleHttp\Client as Guzzle;
use WhelmedCli\Color;

use Symfony\Component\Console\Output\OutputInterface;

abstract class AbstractCommand 
{
    protected $color;

    public function color() {
        if($this->color === null)
        {
            $this->color = new Color();
        }

        return $this->color;
    }

    protected function printTasks($tasks, OutputInterface $output, $prefix = "")
    {
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
                    $prefix . 
                    $this->color()->green($task->uuid) .
                    $this->color()->cyan($task->project->title) .
                    $taskString 
                ); 
            } 
            else
            {
                $output->writeln(
                    $prefix . 
                    $this->color()->green($task->uuid) . $this->color()->white($task->title)
                );
            }
        }
    }

    protected function request($url, $method = 'GET', $payload = [])
    {
        $url = getenv('BASE_URL') . $url;

        if($method == 'GET') {
            $client = new Guzzle();
            $result = $client->request($method, $url, [
                'headers' => [
                    'Authorization' => 'Bearer ' . getenv('API_TOKEN')
                ]
            ]);
        } elseif ($method == 'PATCH') {
            $client = new Guzzle();
            $headers = [ 'Authorization' => 'Bearer ' . getenv('API_TOKEN')];
            $headers = array_merge($headers, $payload);
            $result = $client->request($method, $url, [
                'headers' => $headers
            ]);
             
        } else {
            $client = new Guzzle();
            $result = $client->request($method, $url, [
                'headers' => [
                    'Authorization' => 'Bearer ' . getenv('API_TOKEN')
                ],
                'form_params' => $payload
            ]);
        }
        return json_decode((string)$result->getBody());
    }
}
