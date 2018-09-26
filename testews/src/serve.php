<?php
   
require dirname(__DIR__) . '/vendor/autoload.php';
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use MyApp\Chat;
$socket = new Chat();
$port = 8080;
$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            $socket
        )
    ),
    $port
);

 $server->run();