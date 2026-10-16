<?php

require __DIR__ . '/vendor/autoload.php';

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use App\Libraries\TicketServer;
use React\EventLoop\Loop;
use React\Socket\SocketServer;
use React\Socket\ConnectionInterface;

$loop = Loop::get();
$ticketServer = new TicketServer();

// ==========================================
// SERVER 1: untuk browser (client) - port 8081
// ==========================================
$webSocket = new SocketServer('0.0.0.0:8081', [], $loop);
$webServer = new IoServer(
    new HttpServer(
        new WsServer($ticketServer)
    ),
    $webSocket,
    $loop
);
echo "[OK] WebSocket untuk browser jalan di ws://localhost:8081\n";

// ==========================================
// SERVER 2: pintu belakang internal untuk CI4 - port 8090
// Hanya bisa diakses dari 127.0.0.1 (localhost), aman dari luar
// ==========================================
$pushServer = new SocketServer('0.0.0.0:8090', [], $loop);
$pushServer->on('connection', function (ConnectionInterface $conn) use ($ticketServer) {
    $buffer = '';

    $conn->on('data', function ($chunk) use (&$buffer) {
        $buffer .= $chunk;
    });

    $conn->on('close', function () use (&$buffer, $ticketServer) {
        if (!empty($buffer)) {
            $ticketServer->broadcast($buffer);
        }
    });
});
echo "[OK] Internal push server untuk CI4 jalan di 127.0.0.1:8090\n";

$loop->run();
