<?php declare(strict_types=1);

header('Content-Type: application/json');
http_response_code(200);

echo json_encode([
    'status' => 'success',
    'data' => [
        'hostname' => gethostname(),
    ],
]);
