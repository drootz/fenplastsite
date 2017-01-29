<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?= $_SESSION['html_lang'] ?> prefix="og: http://ogp.me/ns#"> <!--<![endif]-->

<head>

    <!-- Basic Page Needs
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <?php if (isset($title)): ?>
        <title><?= htmlspecialchars($title) ?> - <?= _( 'Distributeur Officiel Fenplast' ); ?> - </title>
    <?php else: ?>
        <title><?= _( 'Distributeur Officiel Fenplast' ); ?></title>
    <?php endif ?>

    <meta name="description" <?= "content=\""._( 'form-htmlmeta-description' )."\""; ?> >
    <link rel="author" href="humans.txt" />

    <!-- Mobile Specific Metas
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <meta name="viewport" content="width=device-width, initial-scale=1, minimal-ui">

    <!-- Schema.org markup for Facebook -->
    <meta property="og:title" <?= "content=\"" . _( 'head-og-title' ) . "\""; ?>/>
    <meta property="og:image" <?= "content=\"" . _( 'head-og-image' ) . "\""; ?>/>
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:image:width" content="2000">
    <meta property="og:image:height" content="1050">
    <meta property="og:url" <?= "content=\"" . _( 'head-og-url' ) . "\""; ?>/> <!-- http://www.fenplastsite.oneprojct.space/?lang=en_CA -->
    <meta property="og:site_name" content="Fenplast Site"/>
    <meta property="og:locale:alternate" <?= "content=\"" . _( 'head-og-fb-locale' ) . "\""; ?>/>
    <meta property="og:description" <?= "content=\"" . _( 'head-og-description' ) . "\""; ?>/>


    <!-- Place favicon.ico and apple-touch-icon.png in the root directory
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <link rel="apple-touch-icon" href="touch-icon-iphone.png">
    <link rel="apple-touch-icon" sizes="76x76" href="touch-icon-ipad.png">
    <link rel="apple-touch-icon" sizes="120x120" href="touch-icon-iphone-retina.png">
    <link rel="apple-touch-icon" sizes="152x152" href="touch-icon-ipad-retina.png">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />

    <!-- FONT
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->

    <!-- CSS
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <script src="https://use.fontawesome.com/57fd7ffc48.js"></script>
    <link rel="stylesheet" href="css/vendor/flickity2-0-5.css">

    <link rel="stylesheet" href="css/page.css">
    <!--[if lt IE 9]>
    <link rel="stylesheet" href="css/style-ie.css"/>
    <![endif]-->

    <script src="js/vendor/modernizr-2.6.2.min.js"></script>

</head>

<body>
    <!--[if lt IE 9]>
        <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->


    <!-- Media queries helper module -->
    <!-- 
    <ul class="breakpoints clearfix">
        <li class="landscape">landscape</li>
        <li class="portrait">portrait</li>
        <li class="mobileonly">mobileonly</li>
        <li class="mobileonly-portrait">mobileonly-portrait</li>
        <li class="mobileonly-landscape">mobileonly-landscape</li>
        <li class="phablet">phablet</li>
        <li class="phablet-portrait">phablet-portrait</li>
        <li class="phablet-landscape">phablet-landscape</li>
        <li class="tablet">tablet</li>
        <li class="tablet-portrait">tablet-portrait</li>
        <li class="tablet-landscape">tablet-landscape</li>
        <li class="laptop">laptop</li>
        <li class="desktop">desktop</li>
        <li class="js-viewport-size"><span id="js-vw"></span> x <span id="js-vh"></span></li>
    </ul> -->

    <!-- Loading Spinner -->
    <!-- <div class="m-loading is-hidden">
        <div><i class="fa fa-circle-o-notch fa-lg fa-spin" aria-hidden="true"></i>&nbsp;&nbsp;<?= _( 'please wait...' ) ?></div>
    </div> -->

    <div class="l-container">



      <div class="m-header">


        <div class="m-top-bar clearfix">

          <div class="l-wrapper">

            <div class="m-logo">
              <img src="img/logos/logo_fenplast_small_600.png" alt="Logo Distributeur Officiel Fenplast" />
            </div>

            <div class="m-menu-toggle">
              <i id="js-nav" class="fa fa-bars fa-2x"></i>
            </div>

            <nav class="m-nav-primary">

              <!-- Mobile/Device Menu -->
              <ul id="js-nav-menu" class="clearfix">
                <li><a href="index.php">Acceuil</a></li>
                <li><a href="produit-portes.php">Portes</a></li>
                <li><a href="produit-fenetres.php">Fenêtres</a></li>
                <li><a href="produit-balcons.php">Rampes et Balcons</a></li>
                <li><a href="#nous-joindre-fenplast">Nous Joindre</a></li>
              </ul>

            </nav>

            <div class="m-fixed-phone">
              <div>
                <a href="tel:+14389999999"><i class="fa fa-phone fa-lg l-mobile-inline"></i></span>&nbsp;&nbsp;<span class="phone-number">+1 (438) 999-9999</span></a>
              </div>
              <div class="l-laptop">
                <span>67 rue des Croquettes, Montréal</span>
              </div>
            </div>

          </div>

      </div>

    </div>
