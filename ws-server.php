<?php

// This file is used to start the websockets server
// Execute this script before starting the webserver

require 'vendor/autoload.php';


use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use NotificationSystem\Notification;

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new Notification()
        )
    ),
    9000
);

$server->run();
?>