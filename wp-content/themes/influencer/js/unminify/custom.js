jQuery(document).ready(function ($) {

	var tickerHeight = $('.site-header .header-ticker').height();
	$('body').css('margin-top', tickerHeight);

	$('.header-ticker span.ticker-close').on('click', function () {
		$('.ticker-title-wrap').slideToggle();
		$('body').toggleClass('ticker-off');
		if ($('body').hasClass('ticker-off')) {
			$('body.ticker-off').css('margin-top', 0);
		} else {
			$('body').css('margin-top', tickerHeight);
		}
	});

	var headerheight = $('.site-header').height();
	$('.site-content > .page-header.has-bgimg').css('padding-top', headerheight);

	$('.scroll-to-top button').on('click', function () {
		$('html, body').animate({
			scrollTop: 0
		}, 600);
	});

	$(document).on('click', 'a.scroll-down', function (event) {
		//console.log($.attr(this, 'href').indexOf('#'));
		if ($.attr(this, 'href').indexOf('#') == 0) {
			event.preventDefault();

			$('html, body').animate({
				scrollTop: $($.attr(this, 'href')).offset().top
			}, 600);
		}
	});

	// Stat Counter
	$('.counter').counterUp({
		delay: 20,
		time: 1000
	});

	var winWidth = $(window).width();
	var wrapWidth = $('.cm-wrapper').width();
	var subTotal = parseInt(winWidth) - parseInt(wrapWidth);
	var halfVal = parseInt(subTotal) / 2;
	$('.story-feat-wrap .featlist-block-wrap').css('padding-right', halfVal);

	//stiky social share

	if (winWidth > 980) {
		var pageHeaderHeight = $('.single .page-header').innerHeight();
		var totalPHeight = parseInt(pageHeaderHeight) + 60;
		$('.side-social-share').css('top', totalPHeight);

		$(window).on('scroll', function () {
			if ($(this).scrollTop() > totalPHeight) {
				$('.side-social-share').css('position', 'fixed');
				$('.side-social-share').css('top', 60);
			} else {
				$('.side-social-share').css('position', 'absolute');
				$('.side-social-share').css('top', totalPHeight);
			}
		});

		//dropdown menu for eadge
		$("#site-navigation ul li a").on('focus', function () {
			$(this).parents("li").addClass("focus");
		}).on('blur', function () {
			$(this).parents("li").removeClass("focus");
		});
	}


	$('window').on('resize load', function () {
		if (winWidth < 980) {
			$('.toggle-button').on('click', function () {
				$(".toggle-button").css("display", "none");
				$(".mobile-menu-wrapper .close").css("display", "block");
				$('.main-navigation .nav-menu').slideToggle();
				$('.mobile-navigation').toggleClass('menu-active');
			});
			$(' .mobile-menu-wrapper .close').on('click', function () {
				$(".toggle-button").css("display", "block");
				$(".mobile-menu-wrapper .close").css("display", "none");
				$('.main-navigation .nav-menu').slideToggle();
				$('.mobile-navigation').toggleClass('menu-active');
			});

		}
	});
	//responsive menu
	$('.toggle-button').on('click', function () {
		$(".toggle-button").css("display", "none");
		$(".mobile-menu-wrapper .close").css("display", "block");
		$('#mobile-site-navigation .nav-menu').slideToggle();
		$('.mobile-navigation').toggleClass('menu-active');
	});
	
	$(' .mobile-menu-wrapper .close').on('click', function () {
		$(".toggle-button").css("display", "block");
		$(".mobile-menu-wrapper .close").css("display", "none");
		$('#mobile-site-navigation .nav-menu').slideToggle();
		$('.mobile-navigation').toggleClass('menu-active');
	});


	$('.main-navigation ul li.menu-item-has-children').append('<span><i class="fa fa-chevron-down"></i></span>');

	$('<button class="angle-down"> <i class = "fa fa-chevron-down"> </i></button>').insertAfter($('.mobile-menu ul .menu-item-has-children > a'));
	$('.mobile-menu ul li .angle-down').on('click', function () {
		$(this).next().slideToggle();
		$(this).toggleClass('submenu-toggle');
	});

});
