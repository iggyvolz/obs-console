<?php

namespace iggyvolz\obsconsole;

use Amp\Http\Server\Request;
use Amp\Http\Server\Response;
use Amp\Http\Status;
use Amp\Websocket\Server\Websocket;

class RequestHandler implements \Amp\Http\Server\RequestHandler
{
    public function __construct(
        private readonly Websocket $websocket,
    )
    {
    }

    public function handleRequest(Request $request): Response
    {

        if($request->hasHeader("Upgrade")) {
            return $this->websocket->handleRequest($request);
        } else {
            return new Response(Status::OK, [
                "content-type" => "text/html; charset=utf-8",
            ], "<!DOCTYPE html><script>const w=new WebSocket(location.href.replace('http','ws'));w.onmessage=e=>eval(e.data);window.w=w;</script>");
        }
    }
}