<?php

namespace App\Traits;

trait BroadcastTrait
{
    protected function broadcastWs(string $type, array $payload)
    {
        $host = getenv('WEBSOCKET_HOST') ?: 'websocket';
        $port = getenv('WEBSOCKET_PUSH_PORT') ?: 8090;

        $fp = @fsockopen($host, $port, $errno, $errstr, 1);

        if (!$fp) {
            log_message('error', "Gagal kirim ke WebSocket server: {$errstr} ({$errno})");
            return;
        }

        $data = json_encode([
            'type' => $type,
            'data' => $payload,
        ]);

        fwrite($fp, $data);
        fclose($fp);
    }
}
