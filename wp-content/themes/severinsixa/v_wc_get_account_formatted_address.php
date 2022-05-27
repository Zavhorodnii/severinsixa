<?php
function v_wc_get_account_formatted_address($address, $name){
    if ($name == 'billing'){
        $address['billing_email']['priority'] = 20;
        $address['billing_email']['label_class'] =  array( 'none', );
        $address['billing_email']['input_class'] = array('input', );
        $address['billing_email']['placeholder'] = 'E-Mail-Adresse';

        $address['billing_first_name']['priority'] = 30;
        $address['billing_first_name']['label_class'] = array( 'none', );
        $address['billing_first_name'] ['input_class'] = array('input',);
        $address['billing_first_name']['placeholder'] = 'Vorname';

        $address['billing_last_name']['priority'] = 40;
        $address['billing_last_name']['label_class'] = array( 'none', );
        $address['billing_last_name']['input_class'] = array('input',);
        $address['billing_last_name']['placeholder'] = 'Nachname';

        $address['billing_address_1']['priority'] = 50;
        $address['billing_address_1']['label_class'] = array( 'none', );
        $address['billing_address_1']['input_class'] = array('input',);
        $address['billing_address_1']['placeholder'] = 'Strasse';

        $address['billing_address_2']['priority'] = 60;
        $address['billing_address_2']['label_class'] = array( 'none', );
        $address['billing_address_2']['input_class'] = array('input', );
        $address['billing_address_2']['placeholder'] = 'Nummer';

        $address['billing_city']['priority'] = 70;
        $address['billing_city']['label_class'] = array( 'none', );
        $address['billing_city']['input_class'] = array('input', );
        $address['billing_city']['placeholder'] = 'Ort/Stadt';

        $address['billing_postcode']['priority'] = 80;
        $address['billing_postcode']['label_class'] = array( 'none', );
        $address['billing_postcode']['input_class'] = array('input', );
        $address['billing_postcode']['placeholder'] = 'Postleitzahl';

        $address['billing_country']['priority'] = 90;
        $address['billing_country']['label_class'] = array( 'none', );
        $address['billing_country']['input_class'] = array('select', );
        $address['billing_country']['required'] = true;
        $address['billing_country']['autocomplete'] = 'Country';

        $address['billing_phone']['priority'] = 90;
        $address['billing_phone']['label_class'] = array( 'none', );
        $address['billing_phone']['input_class'] = array('input', );
        $address['billing_phone']['placeholder'] = 'Telefonnummer';

        unset($address['billing_state']);
        unset($address['billing_company']);
    }
    else{
        $address['shipping_email']['priority'] = 20;
        $address['shipping_email']['label_class'] =  array( 'none', );
        $address['shipping_email']['input_class'] = array('input', );
        $address['shipping_email']['placeholder'] = 'E-Mail-Adresse';

        $address['shipping_first_name']['priority'] = 30;
        $address['shipping_first_name']['label_class'] = array( 'none', );
        $address['shipping_first_name'] ['input_class'] = array('input',);
        $address['shipping_first_name']['placeholder'] = 'Vorname';

        $address['shipping_last_name']['priority'] = 40;
        $address['shipping_last_name']['label_class'] = array( 'none', );
        $address['shipping_last_name']['input_class'] = array('input',);
        $address['shipping_last_name']['placeholder'] = 'Nachname';

        $address['shipping_address_1']['priority'] = 50;
        $address['shipping_address_1']['label_class'] = array( 'none', );
        $address['shipping_address_1']['input_class'] = array('input',);
        $address['shipping_address_1']['placeholder'] = 'Strasse';

        $address['shipping_address_2']['priority'] = 60;
        $address['shipping_address_2']['label_class'] = array( 'none', );
        $address['shipping_address_2']['input_class'] = array('input', );
        $address['shipping_address_2']['placeholder'] = 'Nummer';

        $address['shipping_city']['priority'] = 70;
        $address['shipping_city']['label_class'] = array( 'none', );
        $address['shipping_city']['input_class'] = array('input', );
        $address['shipping_city']['placeholder'] = 'Ort/Stadt';

        $address['shipping_postcode']['priority'] = 80;
        $address['shipping_postcode']['label_class'] = array( 'none', );
        $address['shipping_postcode']['input_class'] = array('input', );
        $address['shipping_postcode']['placeholder'] = 'Postleitzahl';

        $address['shipping_country']['priority'] = 90;
        $address['shipping_country']['label_class'] = array( 'none', );
        $address['shipping_country']['input_class'] = array('select', );
        $address['shipping_country']['required'] = true;
        $address['shipping_country']['autocomplete'] = 'Country';

        $address['shipping_phone']['priority'] = 90;
        $address['shipping_phone']['label_class'] = array( 'none', );
        $address['shipping_phone']['input_class'] = array('input', );
        $address['shipping_phone']['placeholder'] = 'Telefonnummer';

        unset($address['shipping_state']);
        unset($address['shipping_company']);
    }

    return $address;
}