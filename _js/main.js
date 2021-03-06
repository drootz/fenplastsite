 /**
 * File name: main.js
 *
 * Copyright (c) 2015 Daniel Racine
 */

//@prepros-prepend ../public_html/js/vendor/jquery-1.10.2.min.js
//@prepros-prepend ../public_html/js/vendor/jqueryValidate/jquery.validate.min.js
//@prepros-prepend ../public_html/js/vendor/flickity.pkgd2-0-5.js

//@prepros-append plugins.js


/*=======================================================================================
	GLOBAL VARIABLES DECLARATION SECTION
=======================================================================================*/


/*
 * GLOBAL VARIABLES
 *
 */
 	// Global variables on load...
 	var vh, vw, scrollPostion;
	var heightTrigger = 0.4; // define % of animPosition variable
	var animPosition; // set % height to trigger animation from vh

	// variables to know scroll position before/after animPosition
	var ps = 1 - heightTrigger + 0.20;
	var pe = 1 - heightTrigger - 0.20;
	var st, nd;

	// mQuery viewport width size parameters
	var vwDesktop = 1440;
	var vwLaptop = 1040;
	var vwTablet = 768;
	var vwPhablet = 600;









/*=======================================================================================
	FUNCTION DECLARATION SECTION
=======================================================================================*/

/*
 * FUNCTION
 * fromToClass()
 *
 * switch from one specific .class to another specific .class on the specified selector.
 *
 * takes 3 parameters:
 * selector -> object, pass the targeted selector
 * prev -> string, pass the class name to be switch
 * next -> string, pass the class name to switch to
 *
 */
	function fromToClass(selector, prev, next) {

		if (selector.hasClass(prev))
		{
      selector.removeClass(prev);
			selector.addClass(next);
		}

	} // fromToClass() END




/*
 * FUNCTION
 * switchClass()
 *
 * switch between two classes on the specified selector.
 *
 * takes 3 parameters:
 * selector -> object, pass the targeted selector
 * prev -> string, pass the class name to be switch
 * next -> string, pass the class name to switch to
 *
 */
	function switchClass(selector, prev, next) {

		if (selector.hasClass(prev))
		{
			selector.addClass(next);
			selector.removeClass(prev);
		}
		else if (selector.hasClass(next))
		{
			selector.addClass(prev);
			selector.removeClass(next);
		}

	} // switchClass() END





  /*
   * FUNCTION
   * pageLoadInit()
   *
   * reload size attributes on page resize.
   *
   */
  	function pageLoadInit() {

      // var bgHeroClass = ['hero-01','hero-02','hero-03','hero-04'];
      // var activeHero = bgHeroClass[Math.floor(Math.random()*bgHeroClass.length)];
      //
      // if ($('.m-hero').length) {
      //   fromToClass($('.m-hero'), "hero-02", activeHero);
      // }
      //
      // if ($('.js-hero-bg').length) {
      //
      //   fromToClass($('.js-hero-bg'),"hero-02", activeHero);
      // }

      // if ($('body').hasClass('js-laptop') || $('body').hasClass('js-desktop')) {
      //
      // } else {
      //
      // }

    }



  /*
   * FUNCTION
   * resizeInit()
   *
   * reload size attributes on page resize.
   *
   */
  	function resizeInit() {

        // TODO separate what is resize vs what is init


        var heroHeaderSection = $('#js-header-hero');
        if ($('body').hasClass('js-laptop') || $('body').hasClass('js-desktop')) {

          // top-bar - hero padding values
          var carouselHeight = vh - 107 - 25 - 50;
          $('#js-nav-menu').show();
          $('#js-header-hero').css('height', vh);
          $('#js-carousel-container').css('height', carouselHeight);

          if ($('.js-main-carousel').length) {
            $('.js-main-carousel').flickity({
              // options
              autoPlay: 5000,
              setGallerySize: false,
              wrapAround: true,
              prevNextButtons: true
            });
          }

          if ($('.main-gallery').length) {
            $('.main-gallery').flickity({
              // options
              autoPlay: 2500,
              wrapAround: true,
              prevNextButtons: true
            });
          }

          if ($('.js-slider-realisation').length) {
            $('.js-slider-realisation').flickity({
              // options
              autoPlay: false,
              wrapAround: true,
              prevNextButtons: true,
              pageDots: false,
              lazyLoad: 1
            });
            $('.js-slider-realisation-nav').flickity({
              asNavFor: '.js-slider-realisation',
              // contain: true,
              pageDots: false,
              prevNextButtons: true,
              wrapAround: true,
              lazyLoad: 3
            });
          }
        }
        else {
          $('#js-nav-menu').hide();
          fromToClass($('#js-nav'), 'fa-times', 'fa-bars');

          if ($('.js-main-carousel').length) {
            $('.js-main-carousel').flickity({
              // options
              autoPlay: 5000,
              wrapAround: true,
              setGallerySize: true,
              prevNextButtons: false,
              // selectedAttraction: 0.01,
              friction: 0.4
            });
          }

          if ($('.main-gallery').length) {
            $('.main-gallery').flickity({
              // options
              autoPlay: 4000,
              wrapAround: true,
              prevNextButtons: false,
              friction: 0.4
            });
          }

          if ($('.js-slider-realisation').length) {
            $('.js-slider-realisation').flickity({
              // options
              autoPlay: false,
              wrapAround: true,
              prevNextButtons: false,
              pageDots: false,
              lazyLoad: 1,
              friction: 0.4
            });
            $('.js-slider-realisation-nav').flickity({
              asNavFor: '.js-slider-realisation',
              // contain: true,
              pageDots: false,
              prevNextButtons: false,
              wrapAround: true,
              freeScroll: true,
              freeScrollFriction: 0.03,
              lazyLoad: 3,
              friction: 0.4
            });
          }
        }

        // Margon for absolute el in carousel
        $('.js-promo-carousel').each(function(index, el) {
          var marginCarousel = $(this).parent().height();
          $(this).css('margin-top', (marginCarousel/2));
        });
        // var marginCarousel = $('.js-promo-carousel').parent().height();
        // $('.js-promo-carousel').css('margin-top', (marginCarousel/2));

        var allVideos = $("iframe.vimeo");
        // Resize all videos according to their own aspect ratio
        allVideos.each(function() {
          var newWidth = $(this).parent('div').width();
          var $el = $(this);
          $el
            // .width(newWidth)
            // .height(newWidth * $el.data('aspectRatio'));
            .width(newWidth)
            .height(newWidth * $el.data('aspectRatio'));

        });

  	} // resizeInit() END




/*=======================================================================================
	PURE JS SCRIPT
=======================================================================================*/

// Get window width/height
function setWindowDimension() {
	// the more standards compliant browsers (mozilla/netscape/opera/IE7) use window.innerWidth and window.innerHeight
	if (typeof window.innerWidth != 'undefined')
	{
		vw = window.innerWidth;
		vh = window.innerHeight;
    scrollPostion = vw < vwLaptop ? 0 : 83;
		// console.log(vw + "x" + vh);
	}
}




// Set viewport scalabilty depending of screen width -> Block user zoom capabilities on mobile/tablet
function setViewportScale() {
	if (vw < 1050)
	{
 		var viewport;
		viewport = document.getElementsByName("viewport");
		viewport[0].setAttribute("content", "width=device-width, initial-scale=1, maximum-scale=1");
	}
}




// Add class to the body element depending of screen width ( matching CSS media queries)
function jsMediaQ(){
 	var body = document.getElementsByTagName("body")[0];

	function setQuery(name) {
		body.className = name;
	}

    if (vw >= vwDesktop)
    {
  		setQuery("js-desktop");
    }
    else if (vw >= vwLaptop)
    {
  		setQuery("js-laptop");

    }
    else if (vw >= vwTablet)
    {
  		setQuery("js-tablet");
    }
    else if (vw >= vwPhablet)
    {
  		setQuery("js-phablet");
    }
    else
    {
  		setQuery("js-mobile");
    }

}




// Page load/reload/resize initializer
function viewportIni() {

	setWindowDimension();
	setViewportScale();
	jsMediaQ();

  // Google Map Browser Detection
  detectBrowser();

  animPosition = vh * heightTrigger;

	// scroll listening postion
	st = vh * ps;
	nd = vh * pe;
}




// Window resize initialiser
(function(){

	viewportIni();

	// Older version of IE -> < 9
	if(window.attachEvent)
	{
	    window.attachEvent('onresize', function() {
			viewportIni();
	    });
	}
	else if(window.addEventListener)
	{
	    window.addEventListener('resize', function() {
			viewportIni();
	    }, true);
	}
	// Event listener not supported
	else
	{
	    viewportIni();
	}

})();




// Google Map Integration
function initMap() {
  var posFenplast = {lat: 45.5518806, lng: -73.5786761};
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 15,
    center: {lat: 45.5535, lng: -73.5786761}
  });
  var markerFenplast = new google.maps.Marker({
    position: posFenplast,
    map: map
  });

  var directionurl = "https://www.google.ca/maps/dir//3247+Rue+Dandurand,+Montreal,+QC";

  var infoWindowFenplast = new google.maps.InfoWindow({
    content: '<div class="l-gmap-row row clearfix"><div class="col-02 m-gmap-logo"><img src="favicon-32x32.png" alt="logo" width="16px" height="auto"></div><div class="col-10 m-gmap-name">Le Marchand de Fenêtres</div><div class="col-10 m-gmap-address">3247, rue Dandurand<br />Montreal QC &nbsp;H1Y 1V6</div><div class="col-10 m-gmap-direction"><a href="'+ directionurl +'" target="_BLANK">Direction</a></div></div>'
  });

  markerFenplast.addListener('click', function() {
      infoWindowFenplast.open(map, markerFenplast);
  });

  var transitLayer = new google.maps.TransitLayer();
  transitLayer.setMap(map);

  infoWindowFenplast.open(map, markerFenplast);

}


function handleLocationError(browserHasGeolocation, infoWindowFenplast, posFenplast) {
  infoWindowFenplast.setPosition(posFenplast);
  infoWindowFenplast.setContent(browserHasGeolocation ?
                        'Error: The Geolocation service failed.' :
                        'Error: Your browser doesn\'t support geolocation.');
}

function detectBrowser() {
  var useragent = navigator.userAgent;
  var mapdiv = document.getElementById("map");

  if (useragent.indexOf('iPhone') != -1 || useragent.indexOf('Android') != -1 ) {
    mapdiv.style.width = '100%';
    mapdiv.style.height = '100%';
  } else {
    mapdiv.style.width = '100%';
    mapdiv.style.height = '100%';
  }
}









/*=======================================================================================
	DOCUMENT READY SCRIPT
=======================================================================================*/

$( document ).ready(function() {


  $('#js-nav').click(function(){
    $('#js-nav-menu').slideToggle({
        start: function () {
          if ($('#js-nav').hasClass('fa-times')) {
            fromToClass($('.m-nav-primary'),'is-opened','is-closed');
          }
        },
        complete: function () {
          if ($('#js-nav').hasClass('fa-times')) {
            fromToClass($('.m-nav-primary'),'is-closed','is-opened');
          }
      }
    });
    switchClass($('#js-nav'), 'fa-bars', 'fa-times');
  });


  $('.js-sub-nav-btn').hover(function() {
    var subNavEl = $(this).children('.m-sub-nav');
    if (!subNavEl.is(':visible')) {
      subNavEl.slideDown();
      fromToClass(subNavEl, 'is-collapsed', 'is-expanded');
    } else {
      subNavEl.hide();
      fromToClass(subNavEl, 'is-expanded', 'is-collapsed');
    }
  });




  // Fluid iframe videos
  // https://css-tricks.com/NetMag/FluidWidthVideo/Article-FluidWidthVideo.php
  // Find all YouTube videos
  // var allVideos = $("iframe[src^='//www.youtube.com']"),
  var allVideos = $("iframe.vimeo");
      // The element that is fluid width
      // $fluidEl = $(".m-slider-vimeo");

  // Figure out and save aspect ratio for each video
  allVideos.each(function() {

    $(this)
      .data('aspectRatio', this.height / this.width)

      // and remove the hard coded width/height
      .removeAttr('height')
      .removeAttr('width');

  });


  // Resize all videos according to their own aspect ratio
  allVideos.each(function() {
    var newWidth = $(this).parent('div').width();
    var $el = $(this);
    $el
      // .width(newWidth)
      // .height(newWidth * $el.data('aspectRatio'));
      .width(newWidth)
      .height(newWidth * $el.data('aspectRatio'));

  });

  pageLoadInit();
  resizeInit();





	// Manage state of input fields if contains value.
	$("[type='text'], [type='password'], [type='email'], [type='url'], [type='tel'], textarea").focusout( function() {
		var thisInput = $(this);
		if (thisInput.val() !== "")
		{
			if(!thisInput.hasClass('has-value'))
			{
				thisInput.addClass('has-value');
			}
		}
		else
		{
			if(thisInput.hasClass('has-value'))
			{
				thisInput.removeClass('has-value');
			}
		}
	});


    // Smooth link transition
    // http://www.learningjquery.com/2007/10/improved-animated-scrolling-script-for-same-page-links
    $(function() {
      $('a[href*=#]:not([href=#])').click(function() {
        if ($(this).parents('.m-faq').length === 0) {
          if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[id=' + this.hash.slice(1) +']');
            var targetId = target.attr("id");
            var targetSelector = $("#"+targetId);
            // console.log(targetId);
            if (target.length) {
              $('html,body').animate({
                scrollTop: target.offset().top - scrollPostion
              }, 500 , function() {
              	targetSelector.addClass("js-anim-bg");
  				setTimeout( function() {
  					targetSelector.removeClass("js-anim-bg");
  				}, 2000);
              });
              return false;
            }
          }
        }
      });
    });









    if ($('.m-faq').length) {


    	var MqM= 768,
    		  MqL = 1040;

    	var faqsSections = $('.faq-group'),
    		faqTrigger = $('.trigger'),
    		faqsContainer = $('.faq-items'),
    		faqsCategoriesContainer = $('.categories'),
    		faqsCategories = faqsCategoriesContainer.find('a'),
    		closeFaqsContainer = $('.cd-close-panel');

    	//select a faq section
    	faqsCategories.on('click', function(event){
    		event.preventDefault();
    		var selectedHref = $(this).attr('href'),
    			target= $(selectedHref);
    		if( $(window).width() < MqM) {
    			faqsContainer.scrollTop(0).addClass('slide-in').children('ul').removeClass('selected').end().children(selectedHref).addClass('selected');
    			closeFaqsContainer.addClass('move-left');
    			$('body').addClass('cd-overlay');
    		} else {
    	        $('body,html').animate({ 'scrollTop': target.offset().top - 132}, 200);
    		}
    	});

    	//close faq lateral panel - mobile only
    	$('body').bind('click touchstart', function(event){
    		if( $(event.target).is('body.cd-overlay') || $(event.target).is('.cd-close-panel')) {
    			closePanel(event);
    		}
    	});
    	faqsContainer.on('swiperight', function(event){
    		closePanel(event);
    	});


    	faqTrigger.on('click', function(event){
    		event.preventDefault();
    		$(this).next('.faq-content').slideToggle(200).end().parent('li').toggleClass('content-visible');
    	});

    	$(window).on('scroll', function(){
    		if ( $(window).width() > MqL ) {
    			if (!window.requestAnimationFrame) {
            updateCategory();
          } else {
            window.requestAnimationFrame(updateCategory);
          }
    		}
    	});

    	$(window).on('resize', function(){
    		if($(window).width() <= MqL) {
    			faqsCategoriesContainer.removeClass('is-fixed').css({
    				'-moz-transform': 'translateY(0)',
    			    '-webkit-transform': 'translateY(0)',
    				'-ms-transform': 'translateY(0)',
    				'-o-transform': 'translateY(0)',
    				'transform': 'translateY(0)',
    			});
    		}
    		if( faqsCategoriesContainer.hasClass('is-fixed') ) {
    			faqsCategoriesContainer.css({
    				'left': faqsContainer.offset().left,
    			});
    		}
    	});
    }

  	function closePanel(e) {
  		e.preventDefault();
  		faqsContainer.removeClass('slide-in').find('li').show();
  		closeFaqsContainer.removeClass('move-left');
  		$('body').removeClass('cd-overlay');
  	}

  	function updateCategory(){
  		updateCategoryPosition();
  		updateSelectedCategory();
  	}

  	function updateCategoryPosition() {
  		var top = $('.faq').offset().top,
  			height = jQuery('.faq').height() - jQuery('.categories').height(),
  			margin = 132;
  		if( top - margin <= $(window).scrollTop() && top - margin + height > $(window).scrollTop() ) {
  			var leftValue = faqsCategoriesContainer.offset().left,
  				widthValue = faqsCategoriesContainer.width();
  			faqsCategoriesContainer.addClass('is-fixed').css({
  				'left': leftValue,
  				'top': margin,
  				'-moz-transform': 'translateZ(0)',
  			    '-webkit-transform': 'translateZ(0)',
  				'-ms-transform': 'translateZ(0)',
  				'-o-transform': 'translateZ(0)',
  				'transform': 'translateZ(0)',
  			});
  		} else if( top - margin + height <= $(window).scrollTop()) {
  			var delta = top - margin + height - $(window).scrollTop();
  			faqsCategoriesContainer.css({
  				'-moz-transform': 'translateZ(0) translateY('+delta+'px)',
  			    '-webkit-transform': 'translateZ(0) translateY('+delta+'px)',
  				'-ms-transform': 'translateZ(0) translateY('+delta+'px)',
  				'-o-transform': 'translateZ(0) translateY('+delta+'px)',
  				'transform': 'translateZ(0) translateY('+delta+'px)',
  			});
  		} else {
  			faqsCategoriesContainer.removeClass('is-fixed').css({
  				'left': 0,
  				'top': 0,
  			});
  		}
  	}

  	function updateSelectedCategory() {
  		faqsSections.each(function(){
  			var actual = $(this),
  				margin = parseInt($('.faq-title').eq(1).css('marginTop').replace('px', '')),
  				activeCategory = $('.categories a[href="#'+actual.attr('id')+'"]'),
  				topSection = (activeCategory.parent('li').is(':first-child')) ? 0 : Math.round(actual.offset().top);

  			if ( ( topSection - 132 <= $(window).scrollTop() ) && ( Math.round(actual.offset().top) + actual.height() + margin - 138 > $(window).scrollTop() ) ) {
  				activeCategory.addClass('selected');
  			}else {
  				activeCategory.removeClass('selected');
  			}
  		});
  	}











	/*
	 * FORM VALIDATION SCRIPTS
	 *
	 */

	// function to get cookie by key
	function getCookie(key) {
		var regexp = new RegExp("(?:^" + key + "|;\s*"+ key + ")=(.*?)(?:;|$)", "g");
		var result = regexp.exec(document.cookie);
		return (result === null) ? null : result[1];
	}


  if ($('.m-loading').length) {
  	var spinner = $(".m-loading");
  	// $(document).ready(function () {
  	    $(document).ajaxStart(function () {
  	    	if (!spinner.hasClass('isLoading'))
  	    	{
  	    		spinner.addClass('isLoading');
  	    	}
  	    }).ajaxStop(function () {
  	    	if (spinner.hasClass('isLoading'))
  	    	{
  	    		spinner.removeClass('isLoading');
  	    	}
  	    });
  	// });
  }

	// input type="tel" formatting on keyup behavior
	$("[type='tel']").keyup( function() {

		var thisField = $(this);
		var thisValue = thisField.val();

		if (/^\((\b\d{3}\b)\) (\b\d{4}\b)$/g.test(thisValue))
		{
			thisField.val(thisValue.substring(0,thisValue.length - 1) + "-" + thisValue.charAt(thisValue.length - 1));
		}
		else if (/^\((\b\d{3}\b)\)\d$/g.test(thisValue))
		{
			thisField.val(thisValue.substring(0,thisValue.length - 1) + " " + thisValue.charAt(thisValue.length - 1));
		}
		else if (/^(\b\d{3}\b)$/g.test(thisValue))
		{
			thisField.val("(" + thisValue +")");
		}
	});


  var ajxFailContact;
  var v_phoneCheck;
  var v_nameCheck;

	// Localize the form validation error labels
	if (getCookie("lang") == 'en_CA')
	{
		ajxFailContact = 'Unable to submit the email at this time. Please contact us by phone.';
    v_phoneCheck = 'Invalid phone number.';
    v_nameCheck = 'Invalid name format.';
	}
	// Default to english (fr_CA)
	else
	{
		ajxFailContact    = 'Échec de l\'envois du courriel. S\'il vous plaît nous contacter par téléphone.';
    v_phoneCheck      = 'Numéro de téléphone invalide.';
    v_nameCheck       = 'Format du nom invalide.';
	}

	// Clear form input fields and re-instate their default placeholders (bug fix)
	function clearForm(el) {
		var inputs = el.find('input');
		el.trigger('reset');
		inputs.each(function() {
			$(this).val("");
			$(this).focus();
		});
	    inputs.last().blur();
	}

	// Reset form (single form on a page)
	function formFailReset(el) {
		if ($('#captcha').length)
		{
			grecaptcha.reset();
		}
	}

	// Successful AJAX form validation handling
	function formDone(el, data) {
		var form = el;
		var obj = $.parseJSON( data );

		// Display Modal Box Message
		if (obj.modal)
		{
      // alert(obj.notification);
			alert(obj.data);
		}

		// Reset Form
		// if (obj.reset)
		// {
		// 	if($('#captcha').length)
		// 	{
		// 		grecaptcha.reset();
		// 	}
		// 	clearForm(form);
		// }

		// Redirect to another page
		if (obj.redirect)
		{
			window.location.href = obj.location;
		}
		// Output an error message
		else
		{
      // Output an error message
      if ($('#js-form-output').length)
      {
      $('#js-form-output').html('<span>' + obj.data + '</span>');
      }
      // $(document).scrollTop( form.offset().top );
		}
	}

	$.validator.addMethod("nameCheck", function(value) {
		return /^[a-zA-ZàèìòùÀÈÌÒÙáéíóúýÁÉÍÓÚÝâêîôûÂÊÎÔÛãñõÃÑÕäëïöüÿÄËÏÖÜŸçÇßØøÅåÆæœ\s\- ]+$/.test(value);
	}, v_nameCheck);

	$.validator.addMethod("phoneCheck", function(value) {
		return /^[0-9\-\(\) ]+$/.test(value);
	}, v_phoneCheck);

	var formContact = $('#contact');
	formContact.validate({
    rules: {
    	txt_username: {
    	   nameCheck: true
    	},
    	txt_phone: {
    	   phoneCheck: true
    	}
    },
		submitHandler: function(form) {
			$.post('contactez-nous.php', formContact.serialize())
			.done(function( data ) {
				formDone(formContact, data);
			})
			.fail(function() {
				$('#js-form-output').html("<span>" + ajxFailContact + "</span>");
				formFailReset(formContact);
			});
		}
	});


  $( window ).resize(function() {
    resizeInit();
  });






	/*
	 * DEBUG SCRIPTS
	 *
	 */

}); // DOCUMENT.READY END










/*=======================================================================================
	ON SCROLL SCRIPT
=======================================================================================*/

$( window ).scroll(function() {

  //
  // scrollPostion = $(document).scrollTop();
  // // console.log("POS: "+scrollPostion+"\n");
  //
	// var hintSel = $(".js-hint");
	// if (hintSel.length) {
	//     // Trigger animation of "more info" block when info button is visible in viewport
	// 	if (!hintSel.hasClass("anim-buzz"))
	// 	{
	//     	var hintPos = hintSel.offset().top;
	// 	    if (scrollPostion > (hintPos - st) && scrollPostion < (hintPos - nd) )
	// 	    {
	// 		    hintSel.each( function() {
	// 		    	var thisButton = $(this);
	// 				if (verge.inY(thisButton, -animPosition))
	// 				{
	// 					thisButton.addClass("anim-buzz");
	// 				}
	// 		    });
	// 	    }
	//     }
	// }
  //
  //
  // // on vwTablet and larger, trigger animation of action-section icons in sequence.
  //
	// var jsActionFirstSel = $(".js-action-first");
	// if (jsActionFirstSel.length)
	// {
	//     if (vw >= vwTablet)
	//     {
	// 		if (!jsActionFirstSel.hasClass("anim-lock"))
	// 		{
	// 			var actionPos = jsActionFirstSel.offset().top;
	// 	    	if ( scrollPostion > (actionPos - st) && scrollPostion < (actionPos - nd) )
	// 	    	{
	// 				if (verge.inY(jsActionFirstSel, -animPosition))
	// 				{
	// 					jsActionFirstSel.addClass("anim-lock");
	// 					var icoSelectors = $("[class*='js-action']");
  //
	// 					var check = 1;
	// 					var x = 0;
	// 		            function spring( ico ) {
  //
	// 						var thisIco = ico.find(".m-ico-wrapper");
  //
	// 		                switch (check !== 0) {
	// 							case (check == 1):
	// 		                    	x = x + 300;
	// 								break;
	// 							case (check == 2):
	// 		                    	x = x + 200;
	// 								break;
	// 							case (check == 3):
	// 		                    	x = x + 100;
	// 								break;
	// 							default:
	// 			                    x = 0;
	// 								break;
	// 		                }
  //
	// 		            	check++;
  //
	// 		                setTimeout( function() {
	// 							if (!thisIco.hasClass("js-in-view"))
	// 							{
	// 							    thisIco.addClass("js-in-view");
	// 							}
	// 		                }, x);
  //
	// 		            }
  //
	// 		            icoSelectors.each( function() {
	// 		            	spring($(this));
	// 		            });
	// 				}
	// 			}
	// 		}
	//     }
	// }
  //
  //   // On mobilish display, trigger animation of action-section icons and action badge in .m-hero as they apear in viewport
  //   if (vw < vwTablet)
  //   {
  //   	if ( scrollPostion < 2000 )
	// 	{
  //
	// 		$(".m-ico-square").each( function() {
	// 			var thisIco = $(this);
	// 			var thisIcoWrapper = thisIco.find(".m-ico-wrapper");
	// 			if (!thisIcoWrapper.hasClass('js-in-view'))
	// 			{
	// 				if (verge.inY(thisIco, -animPosition))
	// 				{
	// 					thisIcoWrapper.addClass('js-in-view');
	// 				}
	// 			}
  //
	// 		});
  //
	// 	}
  //   }
  //
  //
  //
  //
  //   // Triger divider CCS3 animation as they come close to view.
  //   $(".th-divider").each( function() {
  //   	thisSection = $(this);
  //   	var sectionOff = thisSection.offset().top - vh - 200;
  //   	if (scrollPostion > sectionOff && !thisSection.hasClass("animate"))
  //   	{
  //   		thisSection.addClass("animate");
  //   	}
  //   });


});
