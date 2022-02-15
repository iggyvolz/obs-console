<?php

namespace iggyvolz\obsconsole;

use Amp\Http\Server\Request;
use Amp\Http\Server\Response;
use Amp\Websocket\Client;
use Amp\Websocket\Server\ClientHandler;
use Amp\Websocket\Server\Gateway;

class WebsocketHandler implements ClientHandler
{
    public function handleHandshake(Gateway $gateway, Request $request, Response $response): Response
    {
        return $response;
    }

    public function handleClient(Gateway $gateway, Client $client, Request $request, Response $response): void
    {
        $client->send("alert('foo');");
    }
}