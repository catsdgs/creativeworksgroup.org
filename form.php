<?php
    $your_secret = 6LdvhUUUAAAAAF1wEgnuzYuhLQ98nvYYSwSMlMp-";
    $client_captcha_response = $_POST['g-recaptcha-response'];
    $user_ip = $_SERVER['REMOTE_ADDR'];

    $captcha_verify = open_https_url("https://www.google.com/recaptcha/api/siteverify?secret=$6LdvhUUUAAAAAF1wEgnuzYuhLQ98nvYYSwSMlMp-t&response=$client_captcha_response&remoteip=$user_ip");
    $captcha_verify_decoded = json_decode($captcha_verify);
    if(!$captcha_verify_decoded->success)
      die('Captcha Not Completed');

    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $from = 'From: My Website';
    $to = 'therealcatsdgs@gmail.com';
    $subject = 'Contact Form';

    $body = "Name: $name \n E-Mail: $email \nMessage:\n$message";

    if ($_POST['submit']) {
        if ($email != '') {
            {                 
                if (mail ($to, $subject, $body, $from)) { 
                    echo '<p>You have successfully submitted your information.</p>';
                } else { 
                    echo '<p>Something went wrong, go back and try again!</p><p><input type="button" value="Go Back" onclick="history.back(-1)" class="goback" /></p>'; 
                } 
        } else {
            echo '<p>You need to fill in all required fields!!</p><p><input type="button" value="Go Back" onclick="history.back(-1)" class="goback" /></p>';
        }

