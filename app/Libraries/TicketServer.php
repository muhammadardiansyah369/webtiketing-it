<?php

namespace App\Libraries;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class TicketServer implements MessageComponentInterface
{
    protected $clients;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
    }

    // Dipanggil otomatis saat ada browser baru connect ke ws://
    public function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
        echo "[+] Client connect: {$conn->resourceId} | Total: " . count($this->clients) . "\n";
    }

    // Browser kita di sini cuma "dengar", jadi ini boleh kosong
    public function onMessage(ConnectionInterface $from, $msg)
    {
        // Tidak dipakai untuk sekarang
    }

    public function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);
        echo "[-] Client disconnect: {$conn->resourceId} | Total: " . count($this->clients) . "\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "[!] Error: {$e->getMessage()}\n";
        $conn->close();
    }

    // Fungsi ini dipanggil dari websocket.php saat ada sinyal masuk dari CI4
    public function broadcast(string $jsonData)
    {
        foreach ($this->clients as $client) {
            $client->send($jsonData);
        }
        echo "[>] Broadcast ke " . count($this->clients) . " client: {$jsonData}\n";
    }
}
