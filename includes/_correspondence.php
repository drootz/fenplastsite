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


    require_once("../vendor/PHPMailer/PHPMailerAutoload.php");


    function notificationMail($info) {

        //format each email
        $_body = formatNotificationEmail($info,'html');
        $_body_plain_txt = formatNotificationEmail($info,'txt');

        $mail = new PHPMailer();
        $mail->CharSet = 'UTF-8';
        // $mail->CharSet = 'ISO-8859-15';


        //Set PHPMailer to use SMTP.
        $mail->isSMTP();
        //Set SMTP host name
        $mail->Host = "smtp.gmail.com";
        //Set this to true if SMTP host requires authentication to send email
        $mail->SMTPAuth = true;
        //Provide username and password
        $mail->Username = "noreply.tetsingstuff@gmail.com";
        $mail->Password = "4gFg49CbAuowAC9msKNTyU82CFtdqEP2hcZsEMZU+7Wi8bsC3g";
        //If SMTP requires TLS encryption then set it
        $mail->SMTPSecure = "tls";
        //Set TCP port to connect to
        $mail->Port = 587;

        $mail->setFrom('noreply.tetsingstuff@gmail.com', 'FenplastSite');


        if (isset($info['email']) && isset($info['username']))
        {
            $mail->addAddress($info['email'], $info['username']);
        }
        else
        {
            userErrorHandler(0, '_correspondence.php', 'no email and username specified');
            exit;
        }

        // If this is a "contact us" correspondence, change the reply email
        if (isset($info['bcc_fenplastsite']) && $info['bcc_fenplastsite'])
        {
            $eml = 'mailto.danielracine@gmail.com';
            $mail->addReplyTo($eml, 'FenplastSite');
            $mail->addBCC($eml);
        }


        $mail->isHTML(true);

        if (isset($info['subject']))
        {
            $mail->Subject = $info['subject'];
        }
        else
        {
            $mail->Subject = "Notification";
        }


        $mail->Body    = $_body;
        $mail->AltBody = $_body_plain_txt;


        if(!$mail->send()) {
            // DEBUG
            // echo 'Message could not be sent.';
            // echo 'Mailer Error: ' . $mail->ErrorInfo;
            // exit;
            return false;
        } else {
            return true;
        }
    }

    function formatNotificationEmail($info, $format) {

        //set the root
        // Store DEV server root
        // $server_root = 'http://dracine.local/~dracine/clients/2017_fenplastsite/mail';
        if (isset($info['locale']))
        {
            $server_root = dirname(__FILE__) . '/correspondence/locales/' . $info['locale'];
        }
        else
        {
            $server_root = dirname(__FILE__) . '/correspondence/locales/en_CA';
        }

        //grab the template content
        if (isset($info['template']))
        {
            $template = file_get_contents($server_root.'/' . $info['template'] . '.' . $format);
        }
        else
        {
            userErrorHandler(0, '_correspondence.php', 'no email template specified');
            exit;
        }

        //replace all the tags
        if (isset($info['username']))
        {
            $template = preg_replace('/{USERNAME}/', $info['username'], $template);
        }

        if (isset($info['email']))
        {
            $template = preg_replace('/{EMAIL}/', $info['email'], $template);
        }

        if (isset($info['key']))
        {
            $template = preg_replace('/{KEY}/', $info['key'], $template);
        }

        if (isset($info['psw']))
        {
            $template = preg_replace('/{PSW}/', $info['psw'], $template);
        }

        if (isset($info['altemail']))
        {
            $template = preg_replace('/{ALTEMAIL}/', $info['altemail'], $template);
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

        $template = preg_replace('/{SITEPATH}/','http://dracine.local/~dracine/clients/2017_fenplastsite/public', $template);
        $template = preg_replace('/{SITEPATH_ROOT}/','http://dracine.local/~dracine/clients/2017_fenplastsite', $template);
        $template = preg_replace('/{YEAR}/', date('Y'), $template);
        $template = preg_replace('/{ADMIN_EMAIL}/', 'mailto.danielracine@gmail.com', $template);

        //return the html of the template
        return $template;

    }
