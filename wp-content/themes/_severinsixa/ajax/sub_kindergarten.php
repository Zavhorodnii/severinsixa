<?php

add_action('wp_ajax_ajax_sub_kindergarten', 'ajax_sub_kindergarten');
add_action('wp_ajax_nopriv_ajax_sub_kindergarten', 'ajax_sub_kindergarten');


function ajax_sub_kindergarten(){
    if(!isset($_POST['email']) ){
        $result = array(
            'result'    => 'error1',
        );
        echo json_encode($result);
        die();
    }
    $email = $_POST[ 'email' ];
    $title = $_POST[ 'title' ];

    $mail = get_field('email_order', 'options');

    $add_info = '';

    if($title !== 'none')
        $add_info = "\r\n" . 'Оглавление: ' . $title;

    $mail_massage = 'Сайт: ' . get_site_url() . "\r\n" .'Email: ' . $email . "\r\n" . $add_info;


    send_to_telegram($mail_massage);
    $headers = 'From: Сообщение с  <kindergarten/@kindergarten.com>' . "\r\n";
    $success = wp_mail($mail, 'Сообщене с формы', $mail_massage, $headers);

    if ($success){
        $result = array(
            'result'    => 'ok',
        );
    } else{
        $result = array(
            'result'    => 'error2',
        );
    }
    echo json_encode($result);
//    var_export($result);
    die();
}