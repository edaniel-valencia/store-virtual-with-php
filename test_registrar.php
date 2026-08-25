<?php
$_SERVER['REQUEST_METHOD'] = 'POST';
$json = json_encode(['idCliente' => '', 'pago' => 15]);
$stream = fopen('php://memory', 'r+');
fwrite($stream, $json);
rewind($stream);
// Mock php://input? Can't easily do that.
