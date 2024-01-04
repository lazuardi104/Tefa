jQuery(document).ready(function($) {

    var rtl;
    
    if( the_ultralight_data.rtl == '1' ){
        rtl = true;
    }else{
        rtl = false;
    }

	$('.header-search').click(function(event){
		$(this).toggleClass('search-toggle');
		event.stopPropagation();
	});
	$(window).on('click', function(event){
		$('.header-search').removeClass('search-toggle');
	});

	$('.header-search-form').click(function(event){
        event.stopPropagation();
    });

	//menu toggle js
	$('.main-navigation .toggle-button').click(function(event){
		$(this).parent('.main-navigation').toggleClass('menu-toggled');
		event.stopPropagation();
	});
	$('.main-navigation ul').click(function(event){
		$(this).parent('.main-navigation').addClass('menu-toggled');
		event.stopPropagation();
	});
	$(window).click(function(event){
		$('.main-navigation').removeClass('menu-toggled');
	});
	if($(window).width() <= 800) {
		$('.main-navigation ul li.menu-item-has-children').prepend('<span class="angle-down"><span class="fa fa-chevron-down"></span></span>');
		$('.main-navigation ul li ul').hide();
		$('.main-navigation ul li .angle-down').click(function(){
			$(this).toggleClass('active');
			$(this).siblings('ul').slideToggle();
		});
	}

	//back to top js

	var winWidth = $(window).width();
	//console.log(winWidth);
	$(window).scroll(function(){
		if($(this).scrollTop() > 200) {
			$('.back-to-top').addClass('show');
		}else {
			$('.back-to-top').removeClass('show');
		}
	});

	$('.back-to-top').click(function(){
		$('html, body').animate({
			scrollTop:0
		}, 1000);
	});

	if($(window).width() > 800) {
		var pageHHeight = $('.has-bg header.entry-header').height();
		var articleHeight = $('.single .article-holder').height();
		$(window).scroll(function(){
			if($(this).scrollTop() > pageHHeight & $(this).scrollTop() < articleHeight) {
				$('.single .nosidebar .entry-header .article-share').addClass('sticky');
			}else {
				$('.single .nosidebar .entry-header .article-share').removeClass('sticky');
			}
		});

		var wrapWidth = $('.tc-wrapper').innerWidth();
		var subTotal = parseInt(winWidth) - parseInt(wrapWidth);
		var fTotal = parseInt(subTotal) / 2;
		$('.single .nosidebar .entry-header .article-share').css('top', pageHHeight);
		$('.single .nosidebar .entry-header .article-share').css('left', fTotal);
	}

	if($(window).width() > 800){
		$(".main-navigation ul li a").focus(function() {
		    $(this).parents("li").addClass("focus");
		}).blur(function() {
		    $(this).parents("li").removeClass("focus");
		});
	}
	
}); //document close
