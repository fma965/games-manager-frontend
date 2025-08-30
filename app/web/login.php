<?php
    require_once 'init.php';
    
    if(isset($_GET['code'])) {
        header("Location: /");
    } else {
        header("Location: https://discord.com/api/oauth2/authorize?client_id=".DISCORD_CLIENT_ID."&redirect_uri=" . urlencode(HOST . "/login.php"). "&response_type=code&scope=identify");
        exit; 
    }
    $access_token = "";
    $discord_code = $_GET['code'];

    $payload = [
        'code'=>$discord_code,
        'client_id'=>DISCORD_CLIENT_ID,
        'client_secret'=>DISCORD_CLIENT_SECRET,
        'grant_type'=>'authorization_code',
        'redirect_uri'=> HOST.'/login.php',
        'scope'=>'identify',
    ];

    $payload_string = http_build_query($payload);
    $discord_token_url = "https://discordapp.com/api/oauth2/token";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $discord_token_url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($ch);
    $result = json_decode($result,true);
    
    if($result && isset($result['access_token'])) {
        $access_token = $result['access_token'];

        $discord_users_url = "https://discordapp.com/api/users/@me";
        $header = ["Authorization: Bearer $access_token", "Content-Type: application/x-www-form-urlencoded"];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_URL, $discord_users_url);
        curl_setopt($ch, CURLOPT_POST, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        $result = json_decode($result, true);

        if(!$result) {
            exit;
        }

        $_SESSION['logged_in'] = true;
        $_SESSION['userData'] = [
            'name'=>$result['username'],
            'discord_id'=>$result['id'],
            'avatar'=>$result['avatar']
        ];
    } else {
        exit;
    }
?>