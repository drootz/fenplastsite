<?php
/**
 * File name: session.php
 *
 *
 * @author Daniel Racine <mailto.danielracine@gmail.com>
 * @link --
 * @package Fenplast Distributor Site
 * @version 1
 *
 * Copyright (c) 2016 Daniel Racine
 */

    if (!(isset($_SESSION)))
    {
        session_start();
        header('Cache-control: private'); // IE 6 FIX
        header('Vary: Accept-Language'); // might have IE issues

	    // Current L18N lanuage support -> The first item of this array = default locale
	    $_SESSION['form_PO_support'] = array(
	        "Français (Canada)"     => "fr_CA",
    	    "English (Canada)"      => "en_CA"
	    );
	    $_SESSION['default_locale'] = reset($_SESSION['form_PO_support']);

        // DEV environemnt root:
        // var_dump($_SESSION["server_root"]);
        // $_SESSION["server_root"] = "/~dracine/clients/2017_fenplastsite/public";
        // $_SESSION["server_root"] = "C:\xampp\htdocs\Sites\fenplastsite";


    }


    if ( isset( $_GET['lang'] ) )
    {
        $lang = $_GET['lang'];
        setLanguage( $lang );
        setcookie('lang', $lang, time() + (3600 * 24 * 30));
    }
    if ( isset( $_SESSION['lang'] ) )
    {
        $lang = $_SESSION['lang'];
        setLanguage( $lang );
        setcookie('lang', $lang, time() + (3600 * 24 * 30));
    }
    else if ( isset( $_COOKIE['lang'] ) )
    {
        $lang = $_COOKIE['lang'];
        setLanguage( $lang );
        setcookie('lang', $lang, time() + (3600 * 24 * 30));
    }
    else
    {
        $locale = getDefaultLanguage();
        setLanguage( $locale );
        setcookie('lang', $_SESSION['lang'], time() + (3600 * 24 * 30));
    }

    // Current Language Variable -> To display on site language menu
    $_SESSION['currentLanguage'] = array_key_exists( array_search($_SESSION['lang'], $_SESSION['form_PO_support']), $_SESSION['form_PO_support'] ) ? array_search($_SESSION['lang'], $_SESSION['form_PO_support']) : _( 'header-menuli-lang' );

    // Flush gettext cache fix in development environment -> remove for production
    // $domain = "nothing";
    // bindtextdomain($domain, "nothing");
    // bind_textdomain_codeset($domain, "UTF-8");
    // textdomain($domain);

    // PO gettext() ini
    $domain = "fenplastsite";
    // bindtextdomain($domain, "../locales/nocache");
    bindtextdomain($domain, "../locales");
    bind_textdomain_codeset($domain, "UTF-8");
    textdomain($domain);

    // Define html lang attribute
    $_SESSION['html_lang'] = "lang=\"".$_SESSION['htmllang']."\"";

    // Set your default timezone here
    // http://php.net/manual/en/timezones.php
    $timezone = 'America/Montreal';
    date_default_timezone_set($timezone);
