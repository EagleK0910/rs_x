<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 獲取表單提交的數據
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $subject = $_POST['subject'];
    $ip = $_SERVER['REMOTE_ADDR'];

    // 使用 Discord Webhook 發送消息
    $webhookUrl = 'https://discord.com/api/webhooks/1110444008431431681/8HZFTY3COWsOv1OaEiVSpAU-dhZrX1WjUwEdk3g666P1UOPeK5fj_1Rn5GLRvVreZG6l';

    $embed = [
        'title' => $subject,
        'description' => "名字：$name\nIP位置：$ip\n電子郵件：$email\n訊息：$message",
        'color' => rand(0, 16777215), // 隨機生成十六進位顏色碼
    ];

    $content = json_encode([
        'embeds' => [$embed],
    ]);

    // 發送 POST 請求到 Discord Webhook
    $ch = curl_init($webhookUrl);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    if ($response === false) {
        echo '表單提交成功，但發送消息失敗，請立即聯絡RS官方';
    } else {
        echo '表單提交成功！';
    }
} else {
    echo '無效的請求';
}
?>