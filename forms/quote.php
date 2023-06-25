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
    $solo_mail = $_POST['solo_mail'];
    $solo_id = $_POST['solo_id'];
    $solo_br = $_POST['solo_br'];
    $solo_discord_id = $_POST['solo_discord_id'];
    $solo_city = $_POST['solo_city'];
    $solo_Levels = $_POST['solo_Levels'];
    $solo_line = $_POST['solo_line'];
    $solo_Contact = $_POST['solo_Contact'];
    $solo_card = $_POST['solo_card'];

    // 使用 Discord Webhook 發送消息
    $webhookUrl = 'https://discord.com/api/webhooks/1110768228038348831/N2ScSIGAafS5pN_OWymcRZuO5l0Duqc4PWAcsK5z-HRlq8jhlmU3csesG_HpGSrHzcIE';
    
    // 嵌入式訊息資料
    $embedData = array(
        'title' => '個人報名',
        'description' => '',
        'color' => generateRandomColor(), // 設定顏色 (十進制)
        'author' => [
            'name' => '個人報名表',
            ],
        'image' => [
                'url' => $solo_card,
            ],

        'footer' => [
                'text' => 'RS傳說對決公共娛樂聯賽',
            ],

        'fields' => array(
            array(
                'name' => '傳說ID',
                'value' => $solo_id,
                'inline' => true
            ),
            array(
                'name' => 'Discord ID',
                'value' => $solo_discord_id,
                'inline' => true
            ),
            array(
                'name' => '生日',
                'value' => $solo_br,
                'inline' => true
            ),
            array(
                'name' => '所在城市',
                'value' => $solo_city,
                'inline' => true
            ),
            array(
                'name' => '段位',
                'value' => $solo_Levels,
                'inline' => true
            ),
            array(
                'name' => '路線',
                'value' => $solo_line,
                'inline' => true
            ),
            array(
                'name' => 'mail',
                'value' => $solo_mail,
                'inline' => true
            ),
            array(
                'name' => '聯絡方式',
                'value' => $solo_Contact,
                'inline' => true
            )
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
