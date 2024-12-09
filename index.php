<?php
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if (strpos($uri, '/assets/') === 0) {
    return false; // Serve static files directly
}

if (file_exists(__DIR__ . "/api$uri")) {
    include __DIR__ . "/api$uri";
} else {
    http_response_code(404);
    echo "404 Not Found";
}
