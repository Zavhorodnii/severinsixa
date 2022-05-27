<?php

add_action('wp_ajax_ajax_send_contact_form', 'ajax_send_contact_form');
add_action('wp_ajax_nopriv_ajax_send_contact_form', 'ajax_send_contact_form');

function ajax_send_contact_form()
{

    if (!isset($_POST['first_name']) ||
        !isset($_POST['last_name']) ||
        !isset($_POST['email']) ||
        !isset($_POST['phone']) ||
        !isset($_POST['select']) ||
        !isset($_POST['theme']) ||
        !isset($_POST['message'])
    ) {
        $result = array(
            'status' => 'error',
        );
        echo json_encode($result);
        die();
    }

    $mail = get_field('mail_for_contact', 'option');

    $mail_massage = [
        'Site: ' . get_site_url(),
        'VORNAME: ' . $_POST['first_name'],
        'NACHNAME: ' . $_POST['last_name'],
        'E-MAIL ADRESSE: ' . $_POST['email'],
        'TELEFON: ' . $_POST['phone'],
        'GRUND DER KONTAKTAUFNAHME: ' . $_POST['select'],
        'BETREFF, PRODUKTNAME ODER ARTIKELNUMMER: ' . $_POST['theme'],
        'NACHRICHT: ' . $_POST['message'],
    ];

        //send_to_telegram($mail_massage);

    $headers = 'From: <'. $_POST['email'] .'>' . "\r\n";
    $success = wp_mail($mail, $_POST['theme'], implode("\r\n", $mail_massage), $headers);

    if($success){
        $result = array(
            'status' => 'ok',
        );
    }else{
        $result = array(
            'status' => 'error',
        );
    }

    echo json_encode($result);
    die();
}