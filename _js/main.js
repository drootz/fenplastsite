 /**
 * File name: main.js
 *
 * Copyright (c) 2015 Daniel Racine
 */

//@prepros-prepend ../public/js/vendor/jquery-1.10.2.min.js
//@prepros-prepend ../public/js/vendor/jqueryValidate/jquery.validate.min.js
//@prepros-prepend ../public/js/vendor/flickity.pkgd2-0-5.js

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
	var vwLaptop = 1024;
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
			selector.addClass(next);
			selector.removeClass(prev);
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
   * resizeInit()
   *
   * reload size attributes on page resize.
   *
   */
  	function resizeInit() {

        var heroHeaderSection = $('#js-header-hero');
        if ($('body').hasClass('js-laptop') || $('body').hasClass('js-desktop')) {
          // console.log("DESKTOP");
          // top-bar - hero padding values
          var carouselHeight = vh - 107 - 25 - 50;
          $('#js-nav-menu').show();
          fromToClass($('#js-nav'), 'fa-times', 'fa-bars')
          $('#js-header-hero').css('height', vh);
          $('#js-carousel-container').css('height', carouselHeight);
          $('.js-main-carousel').flickity({
            // options
            autoPlay: true,
            setGallerySize: false,
            wrapAround: true,
            prevNextButtons: true
          });
        }
        else {
          $('#js-nav-menu').hide();
          fromToClass($('#js-nav'), 'fa-times', 'fa-bars')
          $('.js-main-carousel').flickity({
            // options
            autoPlay: true,
            wrapAround: true,
            setGallerySize: true,
            prevNextButtons: false
          });
        }

        var carouselButton = document.getElementsByClassName('flickity-prev-next-button');
        carouselButton.clientWidth = 44;

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
  		setQuery("js-phablet")
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

  // $('#js-nav').click(function(){
  //   $('#js-nav-menu').slideToggle(300, function(){
  //     if ($('#js-nav').hasClass('fa-bars')) {
  //       // $('m-nav-primary').css('width', 200 + 'px');
  //       fromToClass($('.m-nav-primary'),'is-opened','is-closed');
  //     } else {
  //       // $('m-nav-primary').css('width', '100%');
  //       fromToClass($('.m-nav-primary'),'is-closed','is-opened');
  //     }
  //   });
  //   switchClass($('#js-nav'), 'fa-bars', 'fa-times');
  // });

  resizeInit();

  $( window ).resize(function() {
    resizeInit();
  });



  // Fluid iframe videos
  // https://css-tricks.com/NetMag/FluidWidthVideo/Article-FluidWidthVideo.php
  // Find all YouTube videos
  // var allVideos = $("iframe[src^='//www.youtube.com']"),
  var allVideos = $("iframe.vimeo"),

      // The element that is fluid width
      $fluidEl = $(".m-slider-vimeo");

  // Figure out and save aspect ratio for each video
  allVideos.each(function() {

    $(this)
      .data('aspectRatio', this.height / this.width)

      // and remove the hard coded width/height
      .removeAttr('height')
      .removeAttr('width');

  });

  // When the window is resized
  $(window).resize(function() {

    var newWidth = $fluidEl.width();

    // Resize all videos according to their own aspect ratio
    allVideos.each(function() {

      var $el = $(this);
      $el
        .width(newWidth)
        .height(newWidth * $el.data('aspectRatio'));

    });

  // Kick off one resize to fix all videos on page load
  }).resize();




	// // Manage state of input fields if contains value.
	// $("[type='text'], [type='password'], [type='email'], [type='url'], [type='tel'], textarea").focusout( function() {
	// 	var thisInput = $(this);
	// 	if (thisInput.val() != "")
	// 	{
	// 		if(!thisInput.hasClass('has-value'))
	// 		{
	// 			thisInput.addClass('has-value');
	// 		}
	// 	}
	// 	else
	// 	{
	// 		if(thisInput.hasClass('has-value'))
	// 		{
	// 			thisInput.removeClass('has-value');
	// 		}
	// 	}
	// });


    // Smooth link transition
    // http://www.learningjquery.com/2007/10/improved-animated-scrolling-script-for-same-page-links
    $(function() {
      $('a[href*=#]:not([href=#])').click(function() {
        if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
          var target = $(this.hash);
          target = target.length ? target : $('[id=' + this.hash.slice(1) +']');
          var targetId = target.attr("id");
          var targetSelector = $("#"+targetId);
          console.log(targetId);
          if (target.length) {
            $('html,body').animate({
              scrollTop: target.offset().top - 50
            }, 500 , function() {
            	targetSelector.addClass("js-anim-bg");
				setTimeout( function() {
					targetSelector.removeClass("js-anim-bg");
				}, 2000);
            });
            return false;
          }
        }
      });
    });




    // Set tabindex on all input/textarea fields to enable tabs through checkbox
    // var tabCount = 1;
    // $("input, textarea, select").each( function() {
    // 	$(this).attr("tabindex", tabCount);
    // 	tabCount++;
    // });
    // $("#f-submit").attr("tabindex", tabCount);
    // tabCount++;
    // $("#f-reset").attr("tabindex", tabCount);
    // tabCount++;




	/*
	 * FORM VALIDATION SCRIPTS
	 *
	 */

	// // function to get cookie by key
	// function getCookie(key) {
	// 	var regexp = new RegExp("(?:^" + key + "|;\s*"+ key + ")=(.*?)(?:;|$)", "g");
	// 	var result = regexp.exec(document.cookie);
	// 	return (result === null) ? null : result[1];
	// }


  //
	// var spinner = $(".m-loading");
	// $(document).ready(function () {
	//     $(document).ajaxStart(function () {
	//     	if (!spinner.hasClass('isLoading'))
	//     	{
	//     		spinner.addClass('isLoading');
	//     	}
	//     }).ajaxStop(function () {
	//     	if (spinner.hasClass('isLoading'))
	//     	{
	//     		spinner.removeClass('isLoading');
	//     	}
	//     });
	// });


	// Localize the form validation error labels
	// if (getCookie("lang") == 'fr_CA')
	// {
	// 	var ajxFailSignin   =   'Échec de connection';
	// }
	// // Default to english (en_CA)
	// else
	// {
	// 	var ajxFailSignin =   'Sign in Failed';
	// }

	// Declare jQuery Validation custom method
	// $.validator.addMethod("pwdCheck", function(value) {
	// 	return /^[A-Za-z0-9\d=!\-@._*]*$/.test(value) // consists of only these
	// 		&& /[a-z]/.test(value) // has a lowercase letter
	// 		&& /[A-Z]/.test(value) // has a uppercase letter
	// 		&& /\d/.test(value) // has a digit
	// }, v_pwdCheck);

	// $.validator.addMethod("nameCheck", function(value) {
	// 	return /^[a-zA-ZàèìòùÀÈÌÒÙáéíóúýÁÉÍÓÚÝâêîôûÂÊÎÔÛãñõÃÑÕäëïöüÿÄËÏÖÜŸçÇßØøÅåÆæœ\s\-]+$/.test(value);
	// }, v_nameCheck);





	// // Clear form input fields and re-instate their default placeholders (bug fix)
	// function clearForm(el) {
	// 	var inputs = el.find('input');
	// 	el.trigger('reset');
	// 	inputs.each(function() {
	// 		$(this).val("");
	// 		$(this).focus();
	// 	});
	//     inputs.last().blur();
	// }
  //
	// // Reset form (single form on a page)
	// function formFailReset(el) {
	// 	if ($('#captcha').length)
	// 	{
	// 		grecaptcha.reset();
	// 	}
	// 	clearForm(el);
	// 	$(document).scrollTop(el.offset().top);
	// }
  //
  //
	// var formContact = $('#contact');
	// formContact.validate({
	// 	submitHandler: function(form) {
	// 		$.post('contact.php', formContact.serialize())
	// 		.done(function( data ) {
	// 			formDone(formContact, data);
	// 		})
	// 		.fail(function() {
	// 			$('#js-form-output').html("<span>" + ajxFailContact + "</span>");
	// 			formFailReset(formContact);
	// 		});
	// 	}
	// });









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
