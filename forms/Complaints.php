<?php
function generateRandomColor() {
    // 生成隨機的 R、G、B 值
    $red = mt_rand(0, 255);
    $green = mt_rand(0, 255);
    $blue = mt_rand(0, 255);

    // 將 R、G、B 值轉換為十進制的顏色值
    $color = ($red << 16) | ($green << 8) | $blue;
    
    // 返回十進制的顏色值
    return $color;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 獲取表單提交的數據
    $cp_mail = $_POST['cp_mail'];
    $cp_discord_id = $_POST['cp_discord_id'];
    $cp_message = $_POST['cp_message'];
    $cp_Contact = $POST['cp_Contact'];
    $cp_people = $POST['cp_people'];

    // 使用 Discord Webhook 發送消息
    $webhookUrl = 'https://discord.com/api/webhooks/1115812607341895720/mHqSIzJGFwvtWXxII82VBqhlSP0uLKDXr6iq-jYb8EV4Q2dgPuw_dfh2F6CJ6Is7DO0k';
    
    // 嵌入式訊息資料
    $embedData = array(
        'title' => '(投)客訴',
        'description' => '',
        'color' => generateRandomColor(), // 設定顏色 (十進制)
        'author' => [
            'name' => '(投)客訴表',
            ],

        'footer' => [
                'text' => 'RS傳說對決公共娛樂聯賽',
            ],

        'fields' => array(
            array(
                'name' => 'Discord ID',
                'value' => $cp_discord_id,
                'inline' => true
            ),
            array(
                'name' => 'mail',
                'value' => $cp_mail,
                'inline' => true
            ),
            array(
                'name' => '其他聯絡方式',
                'value' => $cp_message,
                'inline' => true
            ),
            array(
                'name' => '(投)客訴對象)',
                'value' => $cp_people,
                'inline' => true
            ),
            array(
                'name' => '訊息',
                'value' => $cp_message,
                'inline' => true
            ),
        )
    );

    // 組合訊息資料
    $data = array(
        'embeds' => array($embedData)
    );

    // 將資料轉換成 JSON 格式
    $payload = json_encode($data);

    // 發送 POST 請求到 Discord Webhook
    $ch = curl_init($webhookUrl);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    if ($response === false) {
        echo '表單提交成功，但發送消息失敗，請立即聯絡RS官方';
    } else {
        echo '報名表已送出！';
    }
} else {
    echo '無效的請求';
}
?>