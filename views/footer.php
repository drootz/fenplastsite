  <div id="nous-joindre-fenplast" class="l-section m-footer">
    <div class="l-wrapper">
      <h5>Section "Nous Joindre" et "Bas de Page"</h5>
    </div>
  </div>


</div> <!-- .l-container END -->




<!-- End Document –––––––––––––––––––––––––––––––––––––––––––––––––– -->

    <!-- All libraries concatenated and minified in main-min.js -->
    <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script> -->
    <!-- <script src="http://cdn.jsdelivr.net/jquery.validation/1.13.1/jquery.validate.js"></script> -->
    <!-- <script src="js/plugins-min.js" async></script> -->
    <!-- <script src="js/vendor/flickity.pkgd2-0-5.js"></script> -->

    <script src="js/main-min.js"></script>


    <script type="text/javascript">

        var htmltag = document.getElementsByTagName('html');
        var langAttr = htmltag[0].getAttribute('lang');
        if (langAttr === "fr_CA")
        {
            document.write('<script src="js/vendor/jqueryValidate/localization/messages_fr.min.js" async defer><\/script>')
        }
        // Default jQuery Validate labels to english


        // reCAPTCHA api
        if($('#captcha').length)
        {
            var widgetId1;
            var c_theme = $("body").hasClass("th-light") ? "light" : "dark";
            var onloadCallback = function() {
                widgetId1 = grecaptcha.render('captcha', {
                    'sitekey' : '6LfS5ggTAAAAAERF8SrqqTaWKt4nYpvh0nCwiEmT',
                    'theme' : c_theme
                });
            };

            if (langAttr === "fr_CA")
            {
                document.write('<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit&hl=fr-CA" async defer><\/script>')
            }
            // Default ot english
            else
            {
                document.write('<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer><\/script>')
            }
        }

    </script>

</body>
</html>
