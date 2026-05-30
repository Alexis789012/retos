<?php
// Intentar cargar la API Key desde el archivo .env en la raíz del proyecto
$envPath = __DIR__ . '/../.env';
$apiKey = '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'; // Clave de respaldo por si falla

if (file_exists($envPath)) {
    $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        if (strpos($line, '=') !== false) {
            list($name, $value) = explode('=', $line, 2);
            if (trim($name) === 'GROQ_API_KEY') {
                $apiKey = trim($value, " \t\n\r\0\x0B\"");
                break;
            }
        }
    }
}

return [
    "api_key" => $apiKey
];