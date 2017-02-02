<?php

    // configuration
    require("../includes/config.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // Render Form
        render("contact_form.php", _("Envoyez nous un courriel"));
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // Sanitize $_POST and check for submit key
        $post = sanitizeForm($_POST);
        if(isset($post['submit']))
        {
            // Check for reCaptcha checkbox
            if (!$post['g-recaptcha-response'])
            {
                $output = [
                    'data' => _('Le reCAPTCHA est obligatoire.')
                ];
                echo(json_encode($output));
                exit;
            }

            // Check for reCaptcha response
            $captcha = $post['g-recaptcha-response'];
            $secretKey = "6LfhxRMUAAAAAFYqudceZepEew8Jz01mlCgJE_29";
            $ip = $_SERVER['REMOTE_ADDR'];
            $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
            $responseKeys = json_decode($response,true);
            if(intval($responseKeys["success"]) !== 1)
            {
                // ERROR
                $output = [
                    'data'      => _('Impossible de traiter votre demande pour le moment.'),
                    'reset'     => true,
                    'modal'     => true,
                    'redirect'  => true,
                    'location'  => 'index.php'
                    // 'error'     => userErrorHandler(0, "register", "reCaptcha error, potential bot")
                ];
                echo(json_encode($output));
                exit;
            }

            $contextRef = '0';
            $uniqueRef = date("U");
            $subject = 'WEB - ' . $post["opt_reason"] . ' - ref: ' . $contextRef . $uniqueRef . '  |  ' . $post["txt_username"];

            //put info into an array to send to the function
            $info = array(
                'locale'            => $_SESSION['lang'],
                'template'          => 'contact_template',
                'subject'           => $subject,
                'username'          => $post["txt_username"],
                'phone'             => $post["txt_phone"],
                'reason'            => $post["opt_reason"],
                'correspondence'    => $post["txt_contact"],
                'bcc_fenplast'   => true
            );

            $output = [
                'data'           => _('

Votre message a bien été reçu!

Prenez note de votre numéro de référence:

') . $contextRef . $uniqueRef . _('

Nous garantissons un retour d\'appel au plus tard dans la prochaine journée ouvrable.

Merci!

'),
                'modal'          => true,
                'redirect'       => true,
                'location'       => 'index.php',
                'notification'   => notificationMail($info)
            ];

            echo(json_encode($output));
            exit;

        }
    }

    // ERROR
    else
    {
        redirect("/index.php");
    }
