<?php

function send_to_telegram($mail_massage){
    $bot_token = get_field('token', 'options');
    $TELEGRAM_CHATID = get_field('chat_id', 'options');

    if($TELEGRAM_CHATID == ''){
        $http = curl_init('https://api.telegram.org/bot'. $bot_token .'/getUpdates');
        curl_setopt($http, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($http);
        curl_close($http);
        $json_result = json_decode($result);

        var_export($json_result);
        $TELEGRAM_CHATID = $json_result->result[count($json_result->result)-1]->message->chat->id;

        update_option( 'options_chat_id', $TELEGRAM_CHATID, 'no' );
    }

    $response = array(
        'chat_id' => $TELEGRAM_CHATID,
        'text' => $mail_massage
    );

    $ch = curl_init('https://api.telegram.org/bot' . $bot_token . '/sendMessage');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $response);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_exec($ch);
    curl_close($ch);

}
