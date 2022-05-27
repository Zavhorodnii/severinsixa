<?php


add_action('wp_ajax_ajax_visit_kindergarten', 'ajax_visit_kindergarten');
add_action('wp_ajax_nopriv_ajax_visit_kindergarten', 'ajax_visit_kindergarten');


function ajax_visit_kindergarten(){
    if(!isset($_POST['name']) || !isset($_POST['phone']) || !isset($_POST['title'])){
        $result = array(
            'result'    => 'error1',
        );
        echo json_encode($result);
        die();
    }
    $name = $_POST[ 'name' ];
    $phone = $_POST[ 'phone' ];
    $title = $_POST[ 'title' ];

    $mail = get_field('email_order', 'options');

    $add_info = '';

    if($title !== 'none')
        $add_info = "\r\n" . 'Оглавление: ' . $title;

    $mail_massage = 'Сайт: ' . get_site_url() . "\r\n" .'Имя: ' . $name . "\r\n" . 'Номер телефона: ' . $phone . $add_info;

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