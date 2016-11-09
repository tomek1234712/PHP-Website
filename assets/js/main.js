"use strict";
var $ = jQuery;
var startCounter = null;

/*
 *  Init =====
 */

jQuery( document ).ready(function($){
    initMap();
    initScrollContent();
    animateCounter();
});
jQuery( window ).scroll(function($){
    fixedTopBar();
    pseudoParalax();
    animateCounter();
});
jQuery( window ).load(function($){
    fixedTopBar();
    pseudoParalax();
});
jQuery( window ).resize(function($){
    initMap();
    pseudoParalax();
    fixedTopBar();
});

/*
 *  Functions =====
 */

function initMap() {

    if( $('#gMap').length > 0 ){

        var styleArray = [
            {
                "featureType": "water",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#d3d3d3"
                    }
                ]
            },
            {
                "featureType": "transit",
                "stylers": [
                    {
                        "color": "#808080"
                    },
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "road.highway",
                "elementType": "geometry.stroke",
                "stylers": [
                    {
                        "visibility": "on"
                    },
                    {
                        "color": "#b3b3b3"
                    }
                ]
            },
            {
                "featureType": "road.highway",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#ffffff"
                    }
                ]
            },
            {
                "featureType": "road.local",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "visibility": "on"
                    },
                    {
                        "color": "#ffffff"
                    },
                    {
                        "weight": 1.8
                    }
                ]
            },
            {
                "featureType": "road.local",
                "elementType": "geometry.stroke",
                "stylers": [
                    {
                        "color": "#d7d7d7"
                    }
                ]
            },
            {
                "featureType": "poi",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "visibility": "on"
                    },
                    {
                        "color": "#ebebeb"
                    }
                ]
            },
            {
                "featureType": "administrative",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#a7a7a7"
                    }
                ]
            },
            {
                "featureType": "road.arterial",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#ffffff"
                    }
                ]
            },
            {
                "featureType": "road.arterial",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#ffffff"
                    }
                ]
            },
            {
                "featureType": "landscape",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "visibility": "on"
                    },
                    {
                        "color": "#efefef"
                    }
                ]
            },
            {
                "featureType": "road",
                "elementType": "labels.text.fill",
                "stylers": [
                    {
                        "color": "#696969"
                    }
                ]
            },
            {
                "featureType": "administrative",
                "elementType": "labels.text.fill",
                "stylers": [
                    {
                        "visibility": "on"
                    },
                    {
                        "color": "#737373"
                    }
                ]
            },
            {
                "featureType": "poi",
                "elementType": "labels.icon",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "poi",
                "elementType": "labels",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "road.arterial",
                "elementType": "geometry.stroke",
                "stylers": [
                    {
                        "color": "#d6d6d6"
                    }
                ]
            },
            {
                "featureType": "road",
                "elementType": "labels.icon",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {},
            {
                "featureType": "poi",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#dadada"
                    }
                ]
            }
        ];

        var mapLocation = jQuery.parseJSON($('#gMap').attr('data-location'));

        var myLatlng = {lat: parseFloat(mapLocation.lat), lng: parseFloat(mapLocation.lng)};

        var map = new google.maps.Map(document.getElementById('gMap'), {
            zoom: 16,
            styles: styleArray,
            center: myLatlng
        });

        var marker = new google.maps.Marker({
            position: myLatlng,
            map: map,
            title: mapLocation.address,
            icon : myLocalized.images + 'map_marker.png'
        });

    }

}

function scrollerTo(target){
    $('html,body').animate({
        scrollTop: target.offset().top - 105
    }, 500);
}

function initScrollContent(){
    $('a[href^="#"]').on('click',function(e){
        e.preventDefault();
        var target = $(this).attr('href');
        $('#menu-menu-top li').removeClass('current');
        $('#menu-menu-top a[href="'+target+'"]').parent('li').addClass('current');
        if(target == '#start'){
            $('html,body').animate({
                scrollTop: 0
            }, 500);
        }else{
            scrollerTo($(target));
        }
    })
}

function pseudoParalax(){
    var $paralaxBox = $('.grafika_z_haslem');
    var scrollTop = $(window).scrollTop();
    var pictureOffset = scrollTop * .2;
    $paralaxBox.css('background-position', 'center ' + pictureOffset + 'px');
}

function setCurrentMenuPage(slug){
    jQuery('#menu-menu-top a[href="/#'+slug+'"]').parent('li').addClass('current');
}

function animateCounter(){
    if(jQuery('.tabelaBox .tabela .t-c i').length > 0){
        var scrollTop = $(window).scrollTop();
        var start = $('.tabelaBox').position().top - $(window).height();
        if(scrollTop >= start && startCounter == null) {
            startCounter = 1;
            jQuery('.tabelaBox .tabela .t-c i').each(function () {
                jQuery(this).prop('Counter', 0).animate({
                    Counter: jQuery(this).text()
                }, {
                    duration: 4000,
                    easing: 'swing',
                    step: function (now) {
                        jQuery(this).text(Math.ceil(now));
                    }
                });
            });
        }
    }
}

function fixedTopBar(){
    var scrollTop = $(window).scrollTop();
    //var staticBarHeight = $('.top-bar.static-bar').outerHeight() +50; // after header section end
    var staticBarHeight = 135; // after menu end
    if(scrollTop >= staticBarHeight){
        $('body').addClass('fixed-menu');
    }else{
        $('body').removeClass('fixed-menu');
        //if(jQuery.browser.mobile){
        //    $('#menu-glowne-menu-1 li:not(.current_page_item, .menu-item-object-uczestnicy.current-menu-item)').slideUp();
        //}
    }
}
//function hamburder(){
//    $('.menu-hamburger').on(click_event,function(e){
//        e.preventDefault();
//        var $menu = $('#menu-glowne-menu-1 li:not(.current_page_item, .menu-item-object-uczestnicy.current-menu-item)');
//        $menu.slideToggle();
//    })
//}