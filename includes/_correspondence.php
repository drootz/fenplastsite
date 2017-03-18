<?php
/**
 * File name: functions.php
 *
 *
 *
 * @author Daniel Racine <mailto.danielracine@gmail.com>
 * @link --
 * @package Fenplast Distributor Site
 * @version 1
 *
 * Copyright (c) 2016 Daniel Racine
 */


    require_once(__DIR__ . "/../vendor/PHPMailer/PHPMailerAutoload.php");


    function notificationMail($info) {

        //format each email
        $_body = formatNotificationEmail($info,'html');
        $_body_plain_txt = formatNotificationEmail($info,'txt');

        $mail = new PHPMailer();
        $mail->CharSet = 'UTF-8';

        //Set PHPMailer to use SMTP.
        $mail->isSMTP();
        //Set SMTP host name
        $mail->Host = "smtp.gmail.com";
        //Set this to true if SMTP host requires authentication to send email
        $mail->SMTPAuth = true;
        //Provide username and password
        //P
        $mail->Username = "email@gmail.com";
        $mail->Password = "password";

        //If SMTP requires TLS encryption then set it
        $mail->SMTPSecure = "tls";
        //Set TCP port to connect to
        $mail->Port = 587;

        // $mail->setFrom('siteweb@lemarchanddefenetres.ca', 'Web');
        // $mail->addAddress("info@lemarchanddefenetres.ca", 'Service à la clientèle');
        $mail->setFrom('email@gmail.com', 'Web');
        $mail->addAddress("email@gmail.com", 'Name');
        $mail->isHTML(true);
        $mail->Subject = $info['subject'];
        $mail->Body    = $_body;
        $mail->AltBody = $_body_plain_txt;

        if(!$mail->send()) {
            return false;
        } else {
            return true;
        }
    }

    function formatNotificationEmail($info, $format) {

        if (isset($info['locale']))
        {
            $server_root = dirname(__FILE__) . '/correspondence/locales/' . $info['locale'];
        }
        else
        {
            $server_root = dirname(__FILE__) . '/correspondence/locales/fr_CA';
        }

        $template = file_get_contents($server_root.'/' . $info['template'] . '.' . $format);

        //replace all the tags
        if (isset($info['username']))
        {
            $template = preg_replace('/{USERNAME}/', $info['username'], $template);
        }

        if (isset($info['email']))
        {
            $template = preg_replace('/{EMAIL}/', $info['email'], $template);
        }

        if (isset($info['phone']))
        {
            $template = preg_replace('/{PHONE}/', $info['phone'], $template);
        }

        if (isset($info['locale']))
        {
            $template = preg_replace('/{LOCALE}/', $info['locale'], $template);
        }

        if (isset($info['reason']))
        {
            $template = preg_replace('/{REASON}/', $info['reason'], $template);
        }

        if (isset($info['correspondence']))
        {
            $template = preg_replace('/{CORR}/', $info['correspondence'], $template);
        }

        $template = preg_replace('/{SITEPATH}/','http://www.lemarchanddefenetres.ca/public', $template);
        $template = preg_replace('/{SITEPATH_ROOT}/','http://www.lemarchanddefenetres.ca/public', $template);
        $template = preg_replace('/{YEAR}/', date('Y'), $template);

        //return the html of the template
        return $template;

    }
