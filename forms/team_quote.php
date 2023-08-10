<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 獲取表單提交的數據
    $team_name = $_POST['team_name'];
    $caption_name = $_POST['caption_name'];
    $caption = $_POST['caption'];
    $team_card = $_POST['team_card'];
    $team_mail = $_POST['team_mail'];

    $team_a_id = $_POST['team_a_id'];
    $team_a_br = $_POST['team_a_br'];
    $team_a_discord_id = $_POST['team_a_discord_id'];
    $team_a_city = $_POST['team_a_city'];
    $team_a_card = $_POST['team_a_card'];

    $team_b_id = $_POST['team_b_id'];
    $team_b_br = $_POST['team_b_br'];
    $team_b_discord_id = $_POST['team_b_discord_id'];
    $team_b_city = $_POST['team_b_city'];
    $team_b_card = $_POST['team_b_card'];

    $team_c_id = $_POST['team_c_id'];
    $team_c_br = $_POST['team_c_br'];
    $team_c_discord_id = $_POST['team_c_discord_id'];
    $team_c_city = $_POST['team_c_city'];
    $team_c_card = $_POST['team_c_card'];

    $team_d_id = $_POST['team_d_id'];
    $team_d_br = $_POST['team_d_br'];
    $team_d_discord_id = $_POST['team_d_discord_id'];
    $team_d_city = $_POST['team_d_city'];
    $team_d_card = $_POST['team_d_card'];

    $team_e_id = $_POST['team_e_id'];
    $team_e_br = $_POST['team_e_br'];
    $team_e_discord_id = $_POST['team_e_discord_id'];
    $team_e_city = $_POST['team_e_city'];
    $team_e_card = $_POST['team_e_card'];

    $team_f_id = $_POST['team_f_id'];
    $team_f_br = $_POST['team_f_br'];
    $team_f_discord_id = $_POST['team_f_discord_id'];
    $team_f_city = $_POST['team_f_city'];
    $team_f_card = $_POST['team_f_card'];

    // 使用 Discord Webhook 發送消息
    $webhookUrl = 'https://discord.com/api/webhooks/1110762288694173839/PJnSC9dL9FZ2i_sCmjmZIzoBzCeV9A2RGwvvEW64HQ99g16uf9R1kqhu9FQuuMgyHxaQ';
    
    $embed = [
        'title' => "$team_name 報名表",
        'description' => "隊長：$caption_name\n隊長聯絡方式：$caption\nMail：$team_mail",
        'color' => rand(0, 16777215), // 隨機生成十六進位顏色碼
        'footer' => [
            'text' => 'RS傳說對決公共娛樂聯賽',
        'image' => [
                'url' => "$team_card",
                ]
        ],
        'fields' => [
            [
                'name' => '凱薩路',
                'value' => "傳說ID：$team_a_id\nDiscord ID：$team_a_discord_id\n生日：$team_a_br\n所在城市：$team_a_city",
                'inline' => true,
                'image' => [
                    'url' => "$team_a_card",
                    ]
            ],
            [
                'name' => '打野',
                'value' => "傳說ID：$team_b_id\nDiscord ID：$team_b_discord_id\n生日：$team_b_br\n所在城市：$team_b_city",
                'inline' => true,
                'image' => [
                    'url' => "$team_b_card",
                    ]
            ],
            [
                'name' => '中路',
                'value' => "傳說ID：$team_c_id\nDiscord ID：$team_c_discord_id\n生日：$team_c_br\n所在城市：$team_c_city",
                'inline' => true,
                'image' => [
                    'url' => "$team_c_card",
                    ]
            ],
            [
                'name' => '輔助',
                'value' => "傳說ID：$team_d_id\nDiscord ID：$team_d_discord_id\n生日：$team_d_br\n所在城市：$team_d_city",
                'inline' => true,
                'image' => [
                    'url' => "$team_d_card",
                    ]
            ],
            [
                'name' => '魔龍路',
                'value' => "傳說ID：$team_e_id\nDiscord ID：$team_e_discord_id\n生日：$team_e_br\n所在城市：$team_e_city",
                'inline' => true,
                'image' => [
                    'url' => "$team_e_card",
                    ]
            ],
            [
                'name' => '替補成員',
                'value' => "傳說ID：$team_f_id\nDiscord ID：$team_f_discord_id\n生日：$team_f_br\n所在城市：$team_f_city",
                'inline' => true,
                'image' => [
                    'url' => "$team_f_card",
                    ]
            ],
        ],
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

    if ($response == true) {
        echo '表單提交成功，但發送消息失敗，請立即聯絡RS官方';
    } else {
        echo '報名表已送出！';
    }
} else {
    echo '無效的請求';
}

?>