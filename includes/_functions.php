<?php
/**
 * File name: functions.php
 *
 *
 * @author Daniel Racine <mailto.danielracine@gmail.com>
 * @link --
 * @package Fenplast Distributor Site
 * @version 1
 *
 * Copyright (c) 2016 Daniel Racine
 */


    /**
     * Apologizes to user with message.
     */
    function apologize($message)
    {
        render("_apology.php", "Ouppps!", ["message" => $message]);
    }

    /**
     * Facilitates debugging by dumping contents of argument(s)
     * to browser.
     */
    function dump()
    {
        $arguments = func_get_args();
        require("../views/_dump.php");
        exit;
    }

    /**
     * Redirects user to location, which can be a URL or
     * a relative path on the local host.
     *
     * http://stackoverflow.com/a/25643550/5156190
     *
     * Because this function outputs an HTTP header, it
     * must be called before caller outputs any HTML.
     */
    function redirect($location)
    {
        if (headers_sent($file, $line))
        {
            trigger_error("HTTP headers already sent at {$file}:{$line}", E_USER_ERROR);
        }

        // dev environemnt root
        if (isset($_SESSION["server_root"]))
        {
            $redirect = $_SESSION["server_root"] . $location;
        }
        else
        {
            $redirect = $location;
        }

        header("Location: {$redirect}", true);
        // echo "<script>window.top.location='". $redirect ."'</script>";
        exit;
    }

    /**
     * Renders view, passing in values.
     */
    function render($view, $pagename, $values = [])
    {
        // if view exists, render it
        if (file_exists("../views/{$view}"))
        {
            $s_displayname = empty($_SESSION["id"]) ? "<a class=\"login_link\" href=\"login.php\">" . _("Sign in") . "</a><span class=\"register_link\"> " . _("or") . " <a href=\"register.php\">" . _("Register") . "</a></span>" : $_SESSION["user_name"];

            $_SESSION["view"] = substr($view, 0, -4);
            $title = $pagename;

            // extract variables into local scope
            extract($values);

            // render view (between header and footer)
            if ($view == "activation.php" || $view == "registered.php")
            {
                require("../views/header_registration.php");
            }
            else
            {
                require("../views/header.php");
            }
            require("../views/{$view}");
            require("../views/footer.php");
            exit;
        }

        // else err
        else
        {
            trigger_error("Invalid view: {$view}", E_USER_ERROR);
        }
    }




    #########################################################
    # Copyright © 2008 Darrin Yeager                        #
    # https://www.dyeager.org/                               #
    # Licensed under BSD license.                           #
    # https://www.dyeager.org/downloads/license-bsd.txt    #
    #########################################################
    function parseDefaultLanguage($http_accept, $deflang = "en") {
       if(isset($http_accept) && strlen($http_accept) > 1)  {
          # Split possible languages into array
          $x = explode(",",$http_accept);
          foreach ($x as $val) {
             #check for q-value and create associative array. No q-value means 1 by rule
             if(preg_match("/(.*);q=([0-1]{0,1}.\d{0,4})/i",$val,$matches))
                $lang[$matches[1]] = (float)$matches[2];
             else
                $lang[$val] = 1.0;
          }

          #return default language (highest q-value)
          $qval = 0.0;
          foreach ($lang as $key => $value) {
             if ($value > $qval) {
                $qval = (float)$value;
                $deflang = $key;
             }
          }
       }
       return strtolower($deflang);
    }




    function getDefaultLanguage() {
       if (isset($_SERVER["HTTP_ACCEPT_LANGUAGE"]))
          return parseDefaultLanguage($_SERVER["HTTP_ACCEPT_LANGUAGE"]);
       else
          return parseDefaultLanguage(NULL);
    }




    function setLanguage($lang) {

        // Extract language value from browser $locale
        $re_lang = '/^\p{L}{1,2}/u';
        if (preg_match($re_lang, $lang, $match))
        {
            $lang_code = $match[0];
        }
        else
        {
            $lang_code = "fr";
        }

        // Extract locale value from browser $locale
        $re_locale = '/(?<=\p{Pd})\p{L}+$/u';
        if (preg_match($re_locale, $lang, $match))
        {
            $locale_code = $match[0];
        }
        else
        {
            $locale_code = "CA";
        }

        // Check if L18N exist for user locale, if not default to $default_locale
        $po_lang = $lang_code."_".$locale_code;
        if ( !in_array( $po_lang, $_SESSION['form_PO_support'] ) )
        {
            $po_lang = $_SESSION['default_locale'];
        }

        // register the session and set the cookie
        $_SESSION['lang'] = $po_lang;
        $_SESSION['htmllang'] = $lang;

        // PO I18N support information here
        putenv("LANG=".$_SESSION['lang']);
        setlocale(LC_ALL, $_SESSION['lang']);

    }




    function setLanguageMenu() {

    	if (isset($_SESSION['form_PO_support']) && count($_SESSION['form_PO_support']) != 0)
    	{
    		$codeBloc = "<ul class=\"is-not-toggled\">";

            // // Debug Language Menu
            //     $codeBloc .=        "<li>";
            //     $codeBloc .=            "<a href=\"?lang=" . "en_CA" . "\">"."Checkoslovac ( Comrad Testing )"."<span class=\"fa fa-globe fa-lg\"></span>"."</a>";
            //     $codeBloc .=        "</li>";

    		foreach ($_SESSION['form_PO_support'] as $display => $code) {
    			$codeBloc .= "<li>";
    			// $codeBloc .= "<a href=\"?lang=" . $code . "\">" . $display ."</a>";
                $codeBloc .= "<a href=\"?lang=" . $code . "\">" . $display . "&nbsp;<span class=\"fa fa-globe fa-lg\"></span>"."</a>";
    			$codeBloc .= "</li>";
    		}
    		$codeBloc .= "</ul>";
    		return $codeBloc;
    	}
    	else
    	{
    		return;
    	}
    }



    function reCheck($pattern, $value)
    {
    	if (preg_match($pattern, $value, $matches))
        {
          return $matches[0];
        }
        else
        {
          return "invalid_data";
        }
    }




    function checkboxCheck($value)
    {
        if ($value)
        {
          return "true";
        }
        else
        {
          return "invalid_data";
        }
    }




    function validateValue($value, $flag)
    {
    	switch ($flag) {
    	    case "EMAIL":
        		$pattern = '/^[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})$/';
    	        break;
    	    case "PHONE":
        		$pattern = '/^((([0-9]{1})*[- .(]*([0-9]{3})[- .)]*[0-9]{3}[- .]*[0-9]{4})+)*$/';
    	        break;
    	    case "ALPHA":
        		$pattern = '/^[[:space:]\p{L}\p{Pd}()]*$/u';
    	        break;
    	    case "ALPHANUMERIC":
        		$pattern = '/^[[:space:]\p{L}\p{Pd}\p{P}()0-9!]*$/u';
    	        break;
    	    case "BOX":
    	    	return checkboxCheck($value);
    	        break;
    	}
    	return reCheck($pattern, $value);
    }




    function sanitizeForm($_postArray)
    {
    	$sanitizedForm = array();
    	foreach ($_postArray as $key => $value)
        {
    		$xxx = strpos($key, 'xxx_');
    		if ($xxx === false) {
        		$sanitizedForm[$key] = isset( $value )
    	           					   ? strip_tags( nl2br(trim( $value )), "<br>" )
    	           					   : NULL;
    		}
    	}
    	return $sanitizedForm;
    }



    function validateForm($_postArray)
    {
        $sanitizedValues = sanitizeForm($_postArray);
        $_required = [
            "Project Name"
                => validateValue( $sanitizedValues['fld_project_name'], "ALPHANUMERIC" ),
            "Primary Contact First Name"
                => validateValue( $sanitizedValues['fld_contact_primary_fn'], "ALPHA" ),
            "Primary Contact Last Name"
                => validateValue( $sanitizedValues['fld_contact_primary_ln'], "ALPHA" ),
            "Primary Contact Phone Number"
                => validateValue( $sanitizedValues['tel_contact_primary_tel'], "PHONE" ),
            "Primary Contact Email"
                => validateValue( $sanitizedValues['eml_contact_primary_email'], "EMAIL" ),
            "Primary Contact Email Verification"
                => validateValue( $sanitizedValues['eml_contact_primary_email_verification'], "EMAIL" ),
            // "Terms & Condition"
            //     => validateValue( $sanitizedValues['bol_t_and_c_reviewed'], "BOX" ),
            "captcha"
                => $sanitizedValues['g-recaptcha-response']
        ];

        $ajaxMsg  = "<h4>Submission Error</h4><p>Please review the following field(s):</p>";
        $ajaxMsg .= "<ul>";

        $requiredCheck = 0;
        foreach ($_required as $key => $value) {
            if (!$value)
            {
                $requiredCheck++;
                switch ($key) {
                    case "Project Name":
                        $ajaxMsg .= "<li>The <a href=\"#f-project-name\">".htmlspecialchars($key)."</a> is required.</li>";
                        break;
                    case "Primary Contact First Name":
                        $ajaxMsg .= "<li>The <a href=\"#f-contact-firstname-1\">".htmlspecialchars($key)."</a> is required.</li>";
                        break;
                    case "Primary Contact Last Name":
                        $ajaxMsg .= "<li>The <a href=\"#f-contact-lastname-1\">".htmlspecialchars($key)."</a> is required.</li>";
                        break;
                    case "Primary Contact Phone Number":
                        $ajaxMsg .= "<li>The <a href=\"#f-contact-phone-1\">".htmlspecialchars($key)."</a> is required.</li>";
                        break;
                    case "Primary Contact Email":
                        $ajaxMsg .= "<li>The <a href=\"#f-contact-email-verification-1\">".htmlspecialchars($key)."</a> is required.</li>";
                        break;
                    case "Primary Contact Email Verification":
                        $ajaxMsg .= "<li>The <a href=\"#f-contact-email-validator-1\">".htmlspecialchars($key)."</a> is required.</li>";
                        break;
                    // case "Terms & Condition":
                    //     $ajaxMsg .= "<li>The <a href=\"#f-condition\">".htmlspecialchars($key)."</a> checkbox is required.</li>";
                    //     break;
                    case "captcha":
                        $ajaxMsg .= "<li>The <a href=\"#captcha\">".htmlspecialchars($key)."</a> checkbox is required.</li>";
                        break;
                }
            }
            else if ($value == "invalid_data")
            {
                $requiredCheck++;
                switch ($key) {
                    case "Project Name":
                        $ajaxMsg .= "<li>The <a href=\"#f-project-name\">".htmlspecialchars($key)."</a> is not valid.</li>";
                        break;
                    case "Primary Contact First Name":
                        $ajaxMsg .= "<li>The <a href=\"#f-contact-firstname-1\">".htmlspecialchars($key)."</a> is not valid.</li>";
                        break;
                    case "Primary Contact Last Name":
                        $ajaxMsg .= "<li>The <a href=\"#f-contact-lastname-1\">".htmlspecialchars($key)."</a> is not valid.</li>";
                        break;
                    case "Primary Contact Phone Number":
                        $ajaxMsg .= "<li>The <a href=\"#f-contact-phone-1\">".htmlspecialchars($key)."</a> is not valid.</li>";
                        break;
                    case "Primary Contact Email":
                        $ajaxMsg .= "<li>The <a href=\"#f-contact-email-verification-1\">".htmlspecialchars($key)."</a> is not valid.</li>";
                        break;
                    case "Primary Contact Email Verification":
                        $ajaxMsg .= "<li>The <a href=\"#f-contact-email-validator-1\">".htmlspecialchars($key)."</a> is not valid.</li>";
                        break;
                    // case "Terms & Condition":
                    //     $ajaxMsg .= "<li>The <a href=\"#f-condition\">".htmlspecialchars($key)."</a> checkbox is not properly checked.</li>";
                    //     break;
                }
            }
        }

        $ajaxMsg .= "</ul>";

        if ($requiredCheck != 0) {

            echo($ajaxMsg);

            // DEBUG
            labelvalueSplit($sanitizedValues);
            debug_SubmitTable(labelvalueSplit($sanitizedValues));
            debug_rawTable($sanitizedValues);
            exit;
        }

        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LfS5ggTAAAAAKR6w3mDTrT9i7edXNxnmhBl4Kl9&response=".$_required['captcha']."&remoteip=".$_SERVER['REMOTE_ADDR']);
        if($response==false)
        {
            echo('<h4>Unable to proceed with your request.</h4>');
            exit;
        }
        else
        {
            // submitEmail($sanitizedValues);
            return $sanitizedValues;
        }
    }
