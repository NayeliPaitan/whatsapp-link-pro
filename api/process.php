<?php
session_start();

// Inicializar el historial de enlaces en sesión si no existe
if (!isset($_SESSION['history'])) {
    $_SESSION['history'] = [];
}

//  borrar el historial si el usuario lo solicita
if (isset($_GET['action']) && $_GET['action'] === 'clear_history') {
    $_SESSION['history'] = [];
    header('Location: ' . strtok($_SERVER["REQUEST_URI"], '?'));
    exit;
}

$generatedUrl = '';
$qrCodeUrl = '';
$error = '';

// Procesar formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $countryCode = trim($_POST['country_code'] ?? '');
    $phoneRaw = trim($_POST['phone'] ?? '');
    $message = trim($_POST['message'] ?? '');

    // Limpiar el número de teléfono dejando solo dígitos
    $phoneClean = preg_replace('/[^0-9]/', '', $phoneRaw);
    $fullPhone = $countryCode . $phoneClean;

    if (empty($phoneClean)) {
        $error = 'Por favor, ingresa un número de teléfono válido.';
    } else {
        // Construir la URL de WhatsApp
        $encodedMessage = urlencode($message);
        $generatedUrl = "https://wa.me/{$fullPhone}" . (!empty($encodedMessage) ? "?text={$encodedMessage}" : '');

        // Generar Código QR usando la API gratuita de QR Server
        $qrCodeUrl = "https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=" . urlencode($generatedUrl);

        // Guardar historial (máximo 5 elementos)
        array_unshift($_SESSION['history'], [
            'phone' => '+' . $fullPhone,
            'message' => $message ? (mb_strimwidth($message, 0, 35, "...")) : 'Sin mensaje',
            'url' => $generatedUrl,
            'date' => date('H:i')
        ]);
        $_SESSION['history'] = array_slice($_SESSION['history'], 0, 5);
    }
}
