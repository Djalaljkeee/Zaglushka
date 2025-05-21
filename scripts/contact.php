<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = strip_tags(trim($_POST["contactname"]));
    $email = filter_var(trim($_POST["contactemail"]), FILTER_SANITIZE_EMAIL);
    $message = trim($_POST["contactmessage"]);

    if (empty($name) || !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($message)) {
        http_response_code(400);
        echo "Пожалуйста, заполните все поля корректно.";
        exit;
    }

    // Email настройки
    $to = "you@example.com"; // Замените на ваш email
    $subject = "Новое сообщение с сайта";
    $content = "Имя: $name\n";
    $content .= "Email: $email\n\n";
    $content .= "Сообщение:\n$message\n";

    $headers = "From: $name <$email>";

    if (mail($to, $subject, $content, $headers)) {
        http_response_code(200);
        echo "Спасибо! Ваше сообщение отправлено.";
    } else {
        http_response_code(500);
        echo "Ошибка отправки. Попробуйте позже.";
    }
} else {
    http_response_code(403);
    echo "Запрос не был POST.";
}
?>
