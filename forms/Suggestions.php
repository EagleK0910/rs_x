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
    $sg_mail = $_POST['sg_mail'];
    $sg_discord_id = $_POST['sg_discord_id'];
    $sg_message = $_POST['sg_message'];
    $sg_Contact = $POST['sg_Contact'];

    // 使用 Discord Webhook 發送消息
    $webhookUrl = 'https://discord.com/api/webhooks/1115809712135475253/MhmDGWasowmn_KahV7bg5h_irwOxOr6PBml1VCaVMDxmzIplIBo3aeVCmEIGP4A5vXFY';
    
    // 嵌入式訊息資料
    $embedData = array(
        'title' => '建議與回饋',
        'description' => '',
        'color' => generateRandomColor(), // 設定顏色 (十進制)
        'author' => [
            'name' => '建議與回饋表',
            ],

        'footer' => [
                'text' => 'RS傳說對決公共娛樂聯賽',
            ],

        'fields' => array(
            array(
                'name' => 'Discord ID',
                'value' => $sg_discord_id,
                'inline' => true
            ),
            array(
                'name' => 'mail',
                'value' => $sg_mail,
                'inline' => true
            ),
            array(
                'name' => '其他聯絡方式',
                'value' => $sg_message,
                'inline' => true
            ),
            array(
                'name' => '訊息',
                'value' => $sg_message,
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