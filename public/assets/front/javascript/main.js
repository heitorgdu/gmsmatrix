  /**
    * isMobile
    * responsiveMenu
    * headerFixed 
    * ajaxContactForm
    * alertBox
    * blog_slider
    * detectViewport
    * flatIconboxCarousel
    * blogCarousel
    * flatClient
    * googleMap
    * videoPopup
    * testimonialSlide
    * onepage_nav
    * Comment-respond 
    * flatClient
    * responsiveVideo
    * swClick
    * goTop
    * toggleExtramenu
    * retinaLogos
    * parallax
    * popupGallery
    * removePreloader
    * flatSearch
    * flatAccordion
    * flatCountdown
    * portfolioIsotope
    * projectSingle
    * flatFilterPrice
    * tabs
    * flatCarousel
    * flatClient
    * counter
    * flatServicesCarouselv1
    * flatServicesCarouselv2
    * flatServicesCarouselArrow
    * flatServicesCarouselArrowThin
    * flatServicesCarouselv3
    * flatServicesCarouselv4
    * toggleExtramenu
   */

;(function($) {

   'use strict'

    var isMobile = {
        Android: function() {
            return navigator.userAgent.match(/Android/i);
        },
        BlackBerry: function() {
            return navigator.userAgent.match(/BlackBerry/i);
        },
        iOS: function() {
            return navigator.userAgent.match(/iPhone|iPad|iPod/i);
        },
        Opera: function() {
            return navigator.userAgent.match(/Opera Mini/i);
        },
        Windows: function() {
            return navigator.userAgent.match(/IEMobile/i);
        },
        any: function() {
            return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
        }
    };

	var responsiveMenu = function() {
        var menuType = 'desktop';
        var mainnav_mobi = $('#mainnav-mobi');
        var header = $("#header");

       $(window).on('load resize', function() {
            var currMenuType = 'desktop';
            if ( matchMedia( 'only screen and (max-width: 990px)' ).matches ) {
                currMenuType = 'mobile';
            }

            if ( currMenuType !== menuType ) {
                menuType = currMenuType;

                if ( currMenuType === 'mobile' ) {
                    var $mobileMenu = $('#mainnav').attr('id', 'mainnav-mobi').hide();
                    var hasChildMenu = $('#mainnav-mobi').find('li:has(ul)');

                    $('.mega-menu .mega-menu-sub').hide();
                    $('.has-mega-menu .submenu.mega-menu').hide();

                    $('#header').after($mobileMenu);
                    hasChildMenu.children('ul').hide();
                    hasChildMenu.children('a:not(.has-mega)').after('<span class="btn-submenu"></span>');
                    $('.btn-menu').removeClass('active');
                } else {
                    var $desktopMenu = $('#mainnav-mobi').attr('id', 'mainnav').removeAttr('style');

                    $desktopMenu.find('.submenu').removeAttr('style');
                    $('#header').find('.nav-wrap').append($desktopMenu);
                    $('.btn-submenu').remove();
                }
            }
        });

        $('.btn-menu').on('click', function() {  
            var mainnav_mobi = $("#mainnav-mobi");
            mainnav_mobi.slideToggle(300);
            mainnav_mobi.css("top",header.offset().top + header.height());
            $(this).toggleClass('active');
        });

        $(document).on('click', '#mainnav-mobi li .btn-submenu', function(e) {
            $(this).toggleClass('active').next('ul').slideToggle(300);
            e.stopImmediatePropagation()
        });
    }

    var headerFixed = function() {
        if ( $('body').hasClass('header_sticky') ) {
            var nav = $('.header');
            if ( nav.size() != 0 ) {
                var offsetTop = $('.header').offset().top,
                    headerHeight = $('.header').height(),
                    injectSpace = $('<div />', { height: headerHeight }).insertAfter(nav);   
                    injectSpace.hide();  
                $(window).on('load scroll', function(){
                    if ( $(window).scrollTop() > offsetTop + 120 ) {
                        nav.addClass('downscrolled');
                        injectSpace.show();
                    } else {
                        nav.removeClass('header-small downscrolled');
                        injectSpace.hide();
                    }

                    if ( $(window).scrollTop() > 500 ) {
                        nav.addClass('header-small upscrolled');
                    } else {
                        nav.removeClass('upscrolled');
                    }
                })
            }
        }     
    };

    var ajaxContactForm = function() {  
        $('.contact-form').each(function() {
            $(this).validate({
                submitHandler: function( form ) {
                    var $form = $(form),
                        str = $form.serialize(),
                        loading = $('<div />', { 'class': 'loading' });

                    $.ajax({
                        type: "POST",
                        url:  $form.attr('action'),
                        data: str,
                        beforeSend: function () {
                            $form.find('.form-submit').append(loading);
                        },
                        success: function( msg ) {
                            var result, cls;                            
                            if ( msg == 'Success' ) {                                
                                result = 'Message Sent Successfully To Email Administrator. ( You can change the email management a very easy way to get the message of customers in the user manual )';
                                cls = 'msg-success';
                            } else {
                                result = 'Error sending email.';
                                cls = 'msg-error';
                            }

                            $form.prepend(
                                $('<div />', {
                                    'class': 'flat-alert ' + cls,
                                    'text' : result
                                }).append(
                                    $('<a class="close" href="#"><i class="fa fa-close"></i></a>')
                                )
                            );

                            $form.find(':input').not('.submit').val('');
                        },
                        complete: function (xhr, status, error_thrown) {
                            $form.find('.loading').remove();
                        }
                    });
                }
            });
        }); // each contactform
    };   

    var alertBox = function() {
        $(document).on('click', '.close', function(e) {
            $(this).closest('.flat-alert').remove();
            e.preventDefault();
        })     
    }  
   
    var blog_slider = function() { 
        if ( $().flexslider ) {            
            $('.flat-blog-slider').each(function() {
                var $this = $(this)
                $this.find('.flexslider').flexslider({
                    animation      :  "slide",
                    direction      :  "horizontal", // vertical
                    pauseOnHover   :  true,
                    useCSS         :  false,
                    easing         :  "swing",
                    animationSpeed :  500,
                    slideshowSpeed :  5000,
                    controlNav     :  false,
                    directionNav   :  true,
                    slideshow      :  true,
                    prevText       :  '<i class="fa fa-angle-left"></i>',
                    nextText       :  '<i class="fa fa-angle-right"></i>',
                    smoothHeight   :  true
                }); // flexslider
            }); // blog-sider
        }
    }; 

    var detectViewport = function() {
        $('[data-waypoint-active="yes"]').waypoint(function() {
            $(this).trigger('on-appear');
        }, { offset: '90%', triggerOnce: true });

        $(window).on('load', function() {
            setTimeout(function() {
                $.waypoints('refresh');
            }, 100);
        });
    };   

    var flatIconboxCarousel = function() {
        $('.flat-iconbox-carosuel-wrap').each(function(){            
            if ( $().owlCarousel ) {
                $(this).find('.flat-iconbox-carosuel').owlCarousel({
                    loop: true,
                    margin: 30,
                    nav: true,
                    dots: false, 
                    auto: true,
                    responsive:{
                        0:{
                            items: 1
                        },
                        480:{
                            items: 2
                        },
                        767:{
                            items: 2
                        },
                        991:{
                            items: 3
                        }, 
                        1200:{
                            items: 3
                        }               
                    }
                });
            }            
        });
    };

    var blogCarousel = function() {
        $('.blog-carosuel-wrap').each(function(){            
            if ( $().owlCarousel ) {
                $(this).find('.blog-carosuel').owlCarousel({
                    loop: true,
                    margin: 30,
                    nav: false,
                    dots: true, 
                    auto:true,
                    responsive:{
                        0:{
                            items: 1
                        },
                        480:{
                            items: 2
                        },
                        767:{
                            items: 2
                        },
                        991:{
                            items: 3
                        }, 
                        1200:{
                            items: 3
                        }               
                    }
                });
            }            
        });
    };     

    var flatClient = function() {
        $('.flat-row').each(function() {            
            if ( $().owlCarousel ) {
                $(this).find('.flat-client').owlCarousel({
                    loop: true,
                    margin: $('.flat-client').data('margin'),
                    nav: $('.flat-client').data('nav'),
                    dots: $('.flat-client').data('dots'),                     
                    autoplay: $('.flat-client').data('auto'),                    
                    responsive:{
                        0:{
                            items: 1
                        },
                        480:{
                            items: next_item($(this).data('item')-1)
                        },
                        767:{
                            items: next_item($(this).data('item'))
                        },
                       
                        1200: {
                            items: $('.flat-client').data('item')
                        }
                    }
                });
            }
        });
    };

    function next_item($item) {
        var $int_item = parseInt($item);
        if ( $int_item -1 > 0) {
            return $int_item -1;
        }
        else {
            return 1;
        }
    }
   
    var googleMap = function() {
        if ( $().gmap3 ) {
            var path = document.location.origin;
            $("#flat-map").gmap3({
                map:{
                    options:{
                        zoom: 11,
                        mapTypeId: 'buildpro_style',
                        mapTypeControlOptions: {
                            mapTypeIds: ['buildpro_style', google.maps.MapTypeId.SATELLITE, google.maps.MapTypeId.HYBRID]
                        },
                        scrollwheel: false
                    }
                },
                getlatlng:{
                    address:  "8 Grand Central Parkway, Jamaica, Queens, Queens County, New York 11432",
                    callback: function(results) {
                        if ( !results ) return;
                        $(this).gmap3('get').setCenter(new google.maps.LatLng(results[0].geometry.location.lat(), results[0].geometry.location.lng()));
                        $(this).gmap3({
                            marker:{
                                latLng:results[0].geometry.location,
                                options:{
                                    icon: 'http://corpthemes.com/html/buildpro/images/marker.png'
                                }
                            }
                        });
                    }
                },
                styledmaptype:{
                    id: "buildpro_style",
                    options:{
                        name: "Buildpro Map"
                    }, 
                    styles: [
                    {
                        "featureType":"administrative.locality",
                        "elementType":"all",
                        "stylers":[
                            {"hue":"#2c2e33"},
                            {"saturation":7},
                            {"lightness":19},
                            {"visibility":"on"}
                        ]},
                    {
                        "featureType":"landscape",
                        "elementType":"all",
                        "stylers":[
                            {"hue":"#ffffff"},
                            {"saturation":-100},
                            {"lightness":100},
                            {"visibility":"simplified"}
                        ]},
                    {
                        "featureType":"poi",
                        "elementType":"all",
                        "stylers":[
                            {"hue":"#ffffff"},
                            {"saturation":-100},
                            {"lightness":100},
                            {"visibility":"off"}
                        ]},
                    {
                        "featureType":"road",
                        "elementType":"geometry",
                        "stylers":[
                            {"hue":"#bbc0c4"},
                            {"saturation":-93},
                            {"lightness":31},
                            {"visibility":"simplified"}
                        ]},
                    {
                        "featureType":"road",
                        "elementType":"labels",
                        "stylers":[
                            {"hue":"#bbc0c4"},
                            {"saturation":-93},
                            {"lightness":31},
                            {"visibility":"on"}
                        ]},
                    {
                        "featureType":"road.arterial",
                        "elementType":"labels",
                        "stylers":[
                            {"hue":"#bbc0c4"},
                            {"saturation":-93},
                            {"lightness":-2},
                            {"visibility":"simplified"}
                        ]},
                    {
                        "featureType":"road.local",
                        "elementType":"geometry",
                        "stylers":[
                            {"hue":"#e9ebed"},
                            {"saturation":-90},
                            {"lightness":-8},
                            {"visibility":"simplified"}
                        ]},
                    {
                        "featureType":"transit",
                        "elementType":"all",
                        "stylers":[
                            {"hue":"#e9ebed"},
                            {"saturation":10},
                            {"lightness":69},
                            {"visibility":"on"}
                        ]},
                    {
                        "featureType":"water",
                        "elementType":"all",
                        "stylers":[
                            {"hue":"#e9ebed"},
                            {"saturation":-78},
                            {"lightness":67},
                            {"visibility":"simplified"}
                        ]}
                    ]                
                },
            });
        }
    }; 
   
    var videoPopup =  function() {
        $(".fancybox").on("click", function(){
            $.fancybox({
              href: this.href,
              type: $(this).data("type")
            }); // fancybox
            return false   
        }); // on
    }

    var testimonialSlide = function() {
        $('.flat-testimonials-slider').each(function(){
            $(this).children('#flat-testimonials-carousel').flexslider({
                animation: "slide",
                controlNav: false,
                animationLoop: false,
                slideshow: false,
                itemWidth: 70,
                itemMargin: 10,
                asNavFor: $(this).children('#flat-testimonials-flexslider')
            });
            $(this).children('#flat-testimonials-flexslider').flexslider({
                animation: "slide",
                controlNav: false,
                animationLoop: false,
                slideshow: false,                
                sync: $(this).children('#flat-testimonials-carousel'),
                prevText: '<i class="fa fa-angle-left"></i>',
                nextText: '<i class="fa fa-angle-right"></i>'
            });
        });
    };  

    var onepage_nav = function () {
        $('.mainnav > ul > li > a').on('click',function() {           
            var anchor = $(this).attr('href').split('#')[1];
            var largeScreen = matchMedia('only screen and (min-width: 992px)').matches;
            var headerHeight = 0;
            headerHeight = $('.header').height();
            if ( anchor ) {
                if ( $('#'+anchor).length > 0 ) {
                   if ( $('.upscrolled').length > 0 && largeScreen ) {
                        headerHeight = headerHeight;
                   } else {
                        headerHeight = 0;
                   }                   
                   var target = $('#'+anchor).offset().top - headerHeight;
                   $('html,body').animate({scrollTop: target}, 1000, 'easeInOutExpo');
                }
            }
            return false;
        })

        $('.mainnav ul > li > a').on( 'click', function() {
            $( this ).addClass('active').parent().siblings().children().removeClass('active');
        });
    }  

    var responsiveVideo= function() {
        if ( $().fitVids ) {
            $('.container').fitVids();
        }
    };

    var swClick = function () {
        function activeLayout () {
            $(".switcher-container" ).on( "click", "a.sw-light", function() {
                $(this).toggleClass( "active" );
                $('body').addClass('home-boxed');  
                $('body').css({'background': '#f6f6f6' });                
                $('.sw-pattern.pattern').css ({ "top": "100%", "opacity": 1, "z-index": "10"});
            }).on( "click", "a.sw-dark", function() {
                $('.sw-pattern.pattern').css ({ "top": "98%", "opacity": 0, "z-index": "-1"});
                $(this).removeClass('active').addClass('active');
                $('body').removeClass('home-boxed');
                $('body').css({'background': '#fff' });
                return false;
            })       
        }        

        function activePattern () {
            $('.sw-pattern').on('click', function () {
                $('.sw-pattern.pattern a').removeClass('current');
                $(this).addClass('current');
                $('body').css({'background': 'url("' + $(this).data('image') + '")', 'background-size' : '30px 30px', 'background-repeat': 'repeat' });
                return false
            })
        }

        activeLayout(); 
        activePattern();
    } 
    
    var goTop = function() {
        $(window).scroll(function() {
            if ( $(this).scrollTop() > 800 ) {
                $('.go-top').addClass('show');
            } else {
                $('.go-top').removeClass('show');
            }
        }); 

        $('.go-top').on('click', function() {            
            $("html, body").animate({ scrollTop: 0 }, 1000 , 'easeInOutExpo');
            return false;
        });
    };

    var toggleExtramenu = function() {
        $('.menu.menu-extra li a').on('click', function() {
            $('body').toggleClass('off-canvas-active');
        });
        $('#site-off-canvas .close').on('click', function() {
            $('body').removeClass('off-canvas-active');
        });
    }

    var retinaLogos = function() {
      var retina = window.devicePixelRatio > 1 ? true : false;

        if(retina) {
            $('.header .logo').find('img').attr({src:'./images/logo@2x.png',width:'210',height:'88'});   
        }
    };    
    
    var parallax = function() {
        if ( $().parallax && isMobile.any() == null ) {
            //$('.parallax1').parallax("50%", 0.2);
           $('.parallax2').parallax("50%", 0.4);  
           // $('.parallax3').parallax("50%", 0.5);
           $('.parallax4').parallax("50%", 0.5);             
        }
    };

    var removePreloader = function() {        
        $('.loading-overlay').fadeOut('slow',function () {
            $(this).remove();
        });
    };

    var flatSearch = function () {
        $(document).on('click', function(e) {   
            var clickID = e.target.id;   
            if ( ( clickID != 's' ) ) {
                $('.top-search').removeClass('show');                
            } 
        });

        $('.show-search').on('click', function(event){
            event.stopPropagation();
        });

        $('.search-form').on('click', function(event){
            event.stopPropagation();
        });        

        $('.show-search').on('click', function () {
            if(!$('.top-search').hasClass( "show" ))
                $('.top-search').addClass('show');
            else
                $('.top-search').removeClass('show');
        });
    }


    var flatAccordion = function() {
        var args = {duration: 600};
        $('.flat-toggle .toggle-title.active').siblings('.toggle-content').show();

        $('.flat-toggle.enable .toggle-title').on('click', function() {
            $(this).closest('.flat-toggle').find('.toggle-content').slideToggle(args);
            $(this).toggleClass('active');
        }); // toggle 

        $('.flat-accordion .toggle-title').on('click', function () {
            if( !$(this).is('.active') ) {
                $(this).closest('.flat-accordion').find('.toggle-title.active').toggleClass('active').next().slideToggle(args);
                $(this).toggleClass('active');
                $(this).next().slideToggle(args);
            } else {
                $(this).toggleClass('active');
                $(this).next().slideToggle(args);
            }     
        }); // accordion
    }; 

    var flatCountdown = function() {
        var anycar_style = function(data) {
         $(this.el).html(
            "<div class='square days'>" +                
                "<div class='numb'>" + this.leadingZeros(data.days, 2) + "</div>" +
                "<div class='text'>Days</div>" +
            "</div>" +
            "<div class='square hours'>" +                
                "<div class='numb'>" + this.leadingZeros(data.hours, 2) + "</div>" +
                "<div class='text'>Hours</div>" +
            "</div>" +
            "<div class='square mins'>" +                
                "<div class='numb'>" + this.leadingZeros(data.min, 2) + "</div>" +
                "<div class='text'>Minutes</div>" +
            "</div>" +
            "<div class='square secs'>" +                
                "<div class='numb'>" + this.leadingZeros(data.sec, 2) + "</div>" +
                "<div class='text'>Seconds</div>" +
            "</div>");
        }

        $('.countdown').each(function() {
            $(this).countdown({
                date: $(this).attr('data-date'),
                render: anycar_style
            });
        });
    };

    var portfolioIsotope = function() {         
        if ( $().isotope ) {           
            var $container = $('.build-portfolio');
            $container.imagesLoaded(function(){
                $container.isotope({
                    itemSelector: '.items',
                    transitionDuration: '1s',
                    percentPosition: true,               
                    masonry: {
                    columnWidth: '.grid-sizer'
                }
                });
            });

            $('.portfolio-filter li').on('click',function() {                           
                var selector = $(this).find("a").attr('data-filter');
                $('.portfolio-filter li').removeClass('active');
                $(this).addClass('active');
                $container.isotope({ filter: selector });
                return false;
            });            
        };

        if ($().fancybox) {
            $(".popup-gallery").fancybox({
                'transitionIn'      : 'none',
                'transitionOut'     : 'none',
                'titlePosition'     : 'over',
                'titleFormat'       : function(title, currentArray, currentIndex, currentOpts) {
                    return '<span id="fancybox-title-over">Image ' +  (currentIndex + 1) + ' / ' + currentArray.length + ' ' + title + '</span>';
                }
            });
        }
    };

    var projectSingle = function() {
        $('.flat-gallery-slider').each(function() { 
            var thumbnail = $(this).data('thumbnail');
            var show_nav = $(this).data('show_nav');
            $(this).children('#flat-gallery-carousel').flexslider({
                animation: "slide",
                controlNav: false,
                directionNav:  true,
                animationLoop: true,
                slideshow: true,
                itemWidth:thumbnail,
                itemMargin: 30,
                prevText       :  '<i class="fa fa-chevron-left"></i>',
                nextText       :  '<i class="fa fa-chevron-right"></i>',
                asNavFor: $(this).children('#flat-gallery-flexslider')
            });
            $(this).children('#flat-gallery-flexslider').flexslider({
                animation: "slide",
                controlNav: false,
                directionNav   :  show_nav,
                animationLoop: true,
                slideshow: true,                
                sync: $(this).children('#flat-gallery-carousel'),
                prevText: '<i class="fa fa-angle-left"></i>',
                nextText: '<i class="fa fa-angle-right"></i>'
            });
        });
    };  

    var flatFilterPrice = function() {
        if( $().slider ) {
            $( ".price_slider" ).slider({
                range: true,
                min: 9,
                max: 35,
                values: [ 9, 35 ],
                slide: function( event, ui ) {
                    $( ".price_label > input " ).val( "$" + ui.values[ 0 ] + "  - £" + ui.values[ 1 ] );
                    }
            });

            $( ".price_label > input " ).val( "$" + $( ".price_slider" ).slider( "values", 0 ) +
            "  -  $" + $( ".price_slider" ).slider( "values", 1 ) );
            $( ".ui-slider-handle").append("<span class='shadow'></span>");
        }
    };

    var tabs = function() {
        $('.flat-tabs').each(function() {

            $(this).children('.content-tab').children().hide();
           
            $(this).children('.content-tab').children().first().show();

            $(this).find('.menu-tab').children('li').on('click', function(e) {
                var liActive = $(this).index(),
                    contentActive = $(this).siblings().removeClass('active').parents('.flat-tabs').children('.content-tab').children().eq(liActive);
                console.log(liActive);
                contentActive.addClass('active').fadeIn('slow');
                contentActive.siblings().removeClass('active');
                $(this).addClass('active').parents('.flat-tabs').children('.content-tab').children().eq(liActive).siblings().hide();
                e.preventDefault();
            });
        });
    };

    var flatCarousel = function() {
        $('.flat-carousel').each(function(){
            if ( $().owlCarousel ) {
                $(this).find('.owl-carousel-testimonial').owlCarousel({
                    loop: true,
                    //margin: 30,
                    auto:true,
                    dots: true,
                    responsive:{
                        0:{
                            items: 1
                        },
                        480:{
                            items: 1
                        },
                        767:{
                            items: 1
                        },
                        991:{
                            items: 1
                        }, 
                        1200:{
                            items: 2
                        }               
                    }
                });
            }
        });
    };

    var flatClient = function() {
        $('.flat-row').each(function() {            
            if ( $().owlCarousel ) {
                $(this).find('.flat-client').owlCarousel({
                    loop: true,
                    margin: $('.flat-client').data('margin'),
                    nav: $('.flat-client').data('nav'),
                    dots: $('.flat-client').data('dots'),                     
                    autoplay: $('.flat-client').data('auto'),                    
                    responsive:{
                        0:{
                            items: 1
                        },
                        480:{
                            items: 2
                        },
                        767:{
                            items: 3
                        },
                        991:{
                            items: 3
                        },
                        1200: {
                            items: $('.flat-client').data('item')
                        }
                    }
                });
            }
        });
    };

    var counter = function() {
        $('.flat-counter').on('on-appear', function() {

            $(this).find('.numb-count').each(function() {
                var to = parseFloat($(this).attr('data-to')), speed = parseFloat($(this).attr('data-speed'));
                if ( $().countTo ) {
                    $(this).countTo({
                        to: to,
                        speen: speed
                    });
                }
            });
        }); //counter
    };

    var flatServicesCarouselv1 = function() {
        $('.flat-carousel-v1').each(function(){
            if ( $().owlCarousel ) {
                $(this).find('.owl-carousel-services-v1').owlCarousel({
                    loop: true,
                    auto:true,
                    dots: false,
                    responsive:{
                        0:{
                            items: 1
                        },
                        480:{
                            items: 2
                        },
                        767:{
                            items: 2
                        },
                        991:{
                            items: 3
                        }, 
                        1200:{
                            items: 3
                        }               
                    }
                });
            }
        });
    }; 

     var flatServicesCarouselv2 = function() {
        $('.flat-carousel-v2').each(function(){
            if ( $().owlCarousel ) {
                $(this).find('.owl-carousel-services-v2').owlCarousel({
                    loop: true,
                    margin: 30,
                    auto:true,
                    smartSpeed: 1500,
                    dots: true,
                    responsive:{
                        0:{
                            items: 1
                        },
                        480:{
                            items: 1
                        },
                        767:{
                            items: 1
                        },
                        991:{
                            items: 1
                        }, 
                        1200:{
                            items: 1
                        }               
                    }
                });
            }
        });
    }; 

    var flatServicesCarouselArrow = function() {
        $('.flat-carousel-arrow').each(function(){
            if ( $().owlCarousel ) {
                $(this).find('.owl-carousel-services-arrow').owlCarousel({
                    loop: true,
                    margin: 30,
                    auto:true,
                    dots: false,
                    nav: true,
                    responsive:{
                        0:{
                            items: 1
                        },
                        480:{
                            items: 1
                        },
                        767:{
                            items: 1
                        },
                        991:{
                            items: 1
                        }, 
                        1200:{
                            items: 1
                        }               
                    }
                });
            }
        });
    };   

    var flatServicesCarouselArrowThin = function() {
        $('.flat-carousel-arrowthin').each(function(){
            if ( $().owlCarousel ) {
                $(this).find('.owl-carousel-services-arrrowthin').owlCarousel({
                    loop: true,
                    margin: 30,
                    auto:true,
                    dots: false,
                    nav: true,
                    responsive:{
                        0:{
                            items: 1
                        },
                        480:{
                            items: 1
                        },
                        767:{
                            items: 1
                        },
                        991:{
                            items: 1
                        }, 
                        1200:{
                            items: 1
                        }               
                    }
                });
            }
        });
    };   

     var flatServicesCarouselv3 = function() {
        $('.flat-carousel-v3').each(function(){
            if ( $().owlCarousel ) {
                $(this).find('.owl-carousel-services-v3').owlCarousel({
                    loop: true,
                    margin: 30,
                    auto: true,
                    dots: false,
                    nav: true,
                    responsive:{
                        0:{
                            items: 1
                        },
                        480:{
                            items: 2
                        },
                        767:{
                            items: 2
                        },
                        991:{
                            items: 3
                        }, 
                        1200:{
                            items: 3
                        }               
                    }
                });
            }
        });
    };

    var flatServicesCarouselv4 = function() {
        $('.flat-carousel-v4').each(function(){
            if ( $().owlCarousel ) {
                $(this).find('.owl-carousel-services-v4').owlCarousel({
                    loop: true,
                    margin: 30,
                    auto: true,
                    dots: true,
                    responsive:{
                        0:{
                            items: 1
                        },
                        480:{
                            items: 2
                        },
                        767:{
                            items: 2
                        },
                        991:{
                            items: 3
                        }, 
                        1200:{
                            items: 3
                        }               
                    }
                });
            }
        });
    };

    var toggleExtramenu = function() {
        $('.menu.menu-extra li.off-canvas-toggle a').on('click', function() {
            $('body').toggleClass('off-canvas-active');
        });
        $('#site-off-canvas .close').on('click', function() {
            $('body').removeClass('off-canvas-active');
        });
    }

    var layout = function() {
        $(".list-grid a").on("click",function(e) {
            e.preventDefault();
            $(".list-grid a").removeClass("active");
            $(this).addClass("active");
            $("body").removeClass("shop-grid shop-list").addClass($(this).data("layout"));
        })
    }
    
                            
   	// Dom Ready
	$(function() { 
        if ( matchMedia( 'only screen and (min-width: 991px)' ).matches ) {
        }  
        responsiveMenu();   
        headerFixed();
        counter();
        parallax();
        flatSearch();
        flatAccordion();
        portfolioIsotope();
        projectSingle();
        flatFilterPrice ();
        tabs();
        flatServicesCarouselv1();
        flatServicesCarouselv2();
        flatServicesCarouselv3();
        flatServicesCarouselv4();
        flatServicesCarouselArrow();
        flatServicesCarouselArrowThin();
        ajaxContactForm();
        alertBox();
        videoPopup();
        flatCarousel();
        flatClient();
        googleMap();
        toggleExtramenu();
        layout();
        detectViewport();
        removePreloader ();
        goTop();
        flatCountdown();

   	});

})(jQuery);