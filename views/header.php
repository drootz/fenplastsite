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
        <title><?= htmlspecialchars($title) ?> - <?= _( 'Le Marchand de Fenêtres' ); ?></title>
    <?php else: ?>
        <title><?= _( 'Le Marchand de Fenêtres' ); ?></title>
    <?php endif ?>

    <meta name="description" <?= "content=\""._( 'Votre détaillant autorisé Fenplast. Portes, Fenêtres, Rampes, Balcons, Revêtement, Installation, Perçage de béton, Garantie' )."\""; ?> >

    <!-- Mobile Specific Metas
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <meta name="viewport" content="width=device-width, initial-scale=1, minimal-ui">

    <!-- Schema.org markup for Facebook -->
    <meta property="og:title" <?= "content=\"" . _( 'Le Marchand de Fenêtres' ) . "\""; ?>/>
    <meta property="og:image" <?= "content=\"" . _( 'http://www.lemarchanddefenetres.ca/img/og/og.jpg' ) . "\""; ?>/>
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:image:width" content="2000">
    <meta property="og:image:height" content="1050">
    <meta property="og:url" <?= "content=\"" . _( 'http://www.lemarchanddefenetres.ca/' ) . "\""; ?>/> <!-- http://www.lemarchanddefenetres.ca/public_html/?lang=fr_CA -->
    <meta property="og:site_name" content="Le Marchand de Fenêtres"/>
    <meta property="og:locale:alternate" <?= "content=\"" . _( 'fr_CA' ) . "\""; ?>/>
    <meta property="og:description" <?= "content=\"" . _( 'Votre détaillant autorisé Fenplast' ) . "\""; ?>/>


    <!-- Place favicon.ico in the root directory
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <link rel="apple-touch-icon" sizes="120x120" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="/manifest.json">
    <link rel="mask-icon" href="/safari-pinned-tab.svg">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- FONT
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->

    <!-- CSS
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <script src="https://use.fontawesome.com/57fd7ffc48.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700,900" rel="stylesheet">
    <link rel="stylesheet" href="css/page.css">
    <!--[if lt IE 9]>
    <link rel="stylesheet" href="css/style-ie.css"/>
    <![endif]-->

    <script async src="js/vendor/modernizr-2.6.2.min.js"></script>

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

    <div id="fb-root"></div>

    <div class="l-container">

      <div class="l-wrapper">
      </div>

      <div class="m-header">


        <div class="m-top-bar clearfix">

          <div class="l-wrapper">

            <div class="m-logo">
              <a href="http://www.lemarchanddefenetres.ca/"><img src="img/logos/logo_lemarchanddefenetres_small_400.png" <?= "alt=\"" . _( 'Le Marchant de Fenêtres - Détaillant Autorisé Fenplast' ) . "\""; ?> <?= "title=\"" . _( 'Le Marchant de Fenêtres - Détaillant Autorisé Fenplast' ) . "\""; ?> width="200px" height="auto"/></a>
            </div>

            <div class="m-menu-toggle">
              <i id="js-nav" class="fa fa-bars fa-2x"></i>
            </div>

            <nav class="m-nav-primary is-closed">

              <!-- Mobile/Device Menu -->
              <ul id="js-nav-menu" class="clearfix">
                <li><a href="http://www.lemarchanddefenetres.ca/"><?= gettext( 'ACCEUIL' ); ?></a></li>
                <li class="js-sub-nav-btn"><span><?= _( 'PRODUITS' ); ?></span>
                    <ul class="m-sub-nav clearfix is-collapsed">
                      <li><a href="portes.php"><?= _( 'PORTES' ); ?></a></li>
                      <li><a href="fenetres.php"><?= _( 'FENÊTRES' ); ?></a></li>
                      <li><a href="rampes-et-balcons.php"><?= _( 'RAMPES ET BALCONS' ); ?></a></li>
                      <li><a href="revetement-exterieur.php"><?= _( 'REVÊTEMENT EXTÉRIEUR' ); ?></a></li>
                    </ul>
                </li>
                <li class="js-sub-nav-btn"><span><?= _( 'SERVICES' ); ?></span>
                    <ul class="m-sub-nav clearfix is-collapsed">
                      <li><a href="services.php"><?= _( 'INSTALLATION PROFESSIONELLE' ); ?></a></li>
                      <li><a href="services.php"><?= _( 'CLÉ EN MAIN' ); ?></a></li>
                      <li><a href="services.php"><?= _( 'PERÇAGE DE BÉTON' ); ?></a></li>
                      <li><a href="services.php"><?= _( 'MODIFICATION DE DIMENSIONS' ); ?></a></li>
                      <li><a href="services.php"><?= _( 'GARANTIE' ); ?></a></li>
                    </ul>
                </li>
                <li><a href="realisations.php"><?= _( 'RÉALISATIONS' ); ?></a></li>
                <li><a href="faq.php"><?= _( 'F.A.Q.' ); ?></a></li>
                <li><a href="#nous-joindre-fenplast"><?= _( 'NOUS JOINDRE' ); ?></a></li>
              </ul>

            </nav>

            <div class="m-fixed-phone">
              <div>
                <a href="tel:&#43;&#49;&#53;&#49;&#52;&#51;&#55;&#57;&#49;&#51;&#51;&#52;"><i class="fa fa-phone fa-lg fa-fw l-mobile-inline"></i>&nbsp;&nbsp;<span class="phone-number">&#40;&#53;&#49;&#52;&#41; &#51;&#55;&#57;&#45;&#49;&#51;&#51;&#52;</span></a>
              </div>
              <div class="l-laptop">
                <span><?= _( '3247 rue Dandurand, Montréal' ); ?></span>
              </div>
            </div>

            <!--
            <div class="m-langage">
              <ul>
                <li><a href="?lang=fr_CA"><span class="l-laptop-inline">FRANÇAIS</span><span class="l-mobile-inline">FR&nbsp;</span></a></li>
                <li><a href="?lang=en_CA"><span class="l-laptop-inline">ENGLISH</span><span class="l-mobile-inline">&nbsp;EN</span></a></li>
              </ul>
            </div>
             -->

          </div>

      </div>

    </div>
