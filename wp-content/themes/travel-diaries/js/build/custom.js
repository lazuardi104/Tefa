jQuery(document).ready(function ($) {    
    jcf.replaceAll();

    //mobile-menu
    // $('.mobile-menu').prepend('<div class="btn-close-menu"></div>');

    // $('.primary-menu ul .menu-item-has-children').append('<div class="angle-down"></div>');
    // $('.secondary-menu ul .menu-item-has-children').append('<div class="angle-down"></div>');

    // $('.primary-menu ul li .angle-down').click(function(){
    //     $(this).prev().slideToggle();
    //     $(this).toggleClass('active');
    // });


    $('<button class="angle-down"></button>').insertAfter($('.mobile-menu ul .menu-item-has-children > a'));
    $('.mobile-menu ul li .angle-down').on( 'click', function() {
        $(this).next().slideToggle();
        $(this).toggleClass('active');
    });

    $('.secondary-menu ul li .angle-down').on( 'click', function(){
        $(this).prev().slideToggle();
        $(this).toggleClass('active');
    });

    $('.menu-opener').on( 'click', function(){
        $('body').addClass('menu-open');
        $('.primary-menu-list').addClass('toggled');
    });

    $('.btn-close-menu').on( 'click', function(){
        $('body').removeClass('menu-open');
        $('.primary-menu-list').removeClass('toggled');
    });

    $('.overlay').on( 'click', function(){
        $('body').removeClass('menu-open');
        $('.primary-menu-list').removeClass('toggled');
    });


    //accessibilty dropdown menu in edge
    $("#site-navigation ul li a").on( 'focus', function() {
        $(this).parents("li").addClass("focus");
    }).on( 'blur', function() {
        $(this).parents("li").removeClass("focus");
    });

    $(".top-menu ul li a").on( 'focus', function() {
        $(this).parents("li").addClass("focus");
    }).on( 'blur', function() {
        $(this).parents("li").removeClass("focus");
    });

    $(window).on("load, resize", function() {
        var viewportWidth = $(window).width();
        if (viewportWidth < 1025) {
            $('.overlay').on( 'click', function () {
                $('body').removeClass('menu-open');
        $('.primary-menu-list').removeClass('toggled');
            });
    

        } else if(viewportWidth >  1025) {
            $('body').removeClass('menu-open');
        }
    });
});
