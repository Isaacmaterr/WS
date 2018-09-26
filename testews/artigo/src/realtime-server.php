<?php
require dirname(__FILE__).'/../../Vendor/autoload.php';

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use Realtime\SocketService;

$socket = new SocketService();
$port = 8080;
$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            $socket
        )
    ),
    $port
);
$mypid = getmypid();
shell_exec("echo {$mypid} > /home/felipe/pid_chat_server");
$loop = $server->loop;
$server->run();
