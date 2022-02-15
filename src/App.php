<?php

namespace iggyvolz\obsconsole;

use Amp\Http\Server\HttpServer;
use Amp\Websocket\Server\Websocket;
use Psr\Log\LoggerInterface;
use function Amp\trapSignal;
use const SIGINT;
use const SIGTERM;

class App
{
    public function __construct(
        Websocket $websocket,
        private readonly HttpServer $httpServer,
        private readonly LoggerInterface $logger
    )
    {
        $httpServer->attach($websocket);
    }
    public function run(): void
    {
        $this->httpServer->start();
        // Await SIGINT or SIGTERM to be received.
        $signal = trapSignal([SIGINT, SIGTERM]);

        $this->logger->info(\sprintf("Received signal %d, stopping HTTP server", $signal));

        $this->httpServer->stop();

    }
}