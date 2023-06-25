<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 獲取表單提交的數據
    $a_team = $_POST['a_team'];
    $a_score = $_POST['a_score'];
    $b_team = $_POST['b_team'];
    $b_score = $_POST['b_score'];
    $mvp = $_POST['MVP'];
    $game = $_POST['game'];

    // 使用 Discord Webhook 發送消息
    $webhookUrl = 'https://discord.com/api/webhooks/1121809146623307836/7WfX96jGsPwAXJjX-s0u0HUlSQ5y6nf5bpOQFtNzHEQ0knHyfJUgP5svdWpcWrxIPVRp';

    // 組合訊息資料
    $data = array(
        'embeds' => array(
            array(
                'title' => $game,
                'color' => rand(0, 16777215), // 設定顏色 (十進制)
                'fields' => array(
                    array(
                        'name' => '主隊',
                        'value' => "隊伍名: $a_team\n最終分數: $a_score",
                        'inline' => true
                    ),
                    array(
                        'name' => '客隊',
                        'value' => "隊伍名: $b_team\n最終分數: $b_score",
                        'inline' => true
                    ),
                    array(
                        'name' => '更多資訊',
                        'value' => "單場MVP: $mvp",
                        'inline' => false
                    )
                )
            )
        )
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
        echo '比分登錄表單已送出！';
    }
} else {
    echo '無效的請求';
}
?>
