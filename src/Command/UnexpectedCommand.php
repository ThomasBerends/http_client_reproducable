<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

#[AsCommand(
    name: 'app:unexpected',
)]
class UnexpectedCommand extends Command
{
    public function __construct(
        private readonly HttpClientInterface $httpClient,
    )
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // Perform the request
        $response = $this->httpClient->request('GET', "https://www.php.net/notfound");

        // Do not fetch content
        // $response->getContent();

        // Get the correct (redirected) url
        dump($response->getInfo()['url']);

        return Command::SUCCESS;
    }
}