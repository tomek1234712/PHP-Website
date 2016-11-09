<?php

function get_elasticslider_id(){

    $sliderTermID = false;
    $page_id = get_the_ID();
    $queriedObject = get_queried_object();

    if ( ! defined('ICL_LANGUAGE_CODE' ) ) {
        define('ICL_LANGUAGE_CODE', '');
    }

    $sliders = get_option( 'slider_relationships_'.ICL_LANGUAGE_CODE );

    if(is_page()){

        if( isset($sliders['page'][$page_id]) && $sliders['page'][$page_id] != 0){

            $sliderTermID = $sliders['page'][$page_id];

        }

    }

    if(is_post_type_archive()){

        if ( class_exists( 'WooCommerce' ) && is_shop()) {

            $post_type = 'product';

        }else{

            $post_type = get_post_type($page_id);

        }

        if( isset($sliders['post_type'][$post_type]) &&  $sliders['post_type'][$post_type]!= 0){

            $sliderTermID = $sliders['post_type'][$post_type];

        }

    }

    if(is_tax()){

        $taxonomyName = $queriedObject->taxonomy;

        if( isset($sliders['taxonomy'][$taxonomyName]) &&  $sliders['taxonomy'][$taxonomyName]!= 0){

            $sliderTermID = $sliders['taxonomy'][$taxonomyName];

        }

        if(!$sliderTermID){

            if(is_tax($taxonomyName) && isset($queriedObject->term_id)){

                if( isset($sliders['term'][$queriedObject->taxonomy][$queriedObject->term_id]) &&  $sliders['term'][$queriedObject->taxonomy][$queriedObject->term_id] != 0){

                    $sliderTermID = $sliders['term'][$queriedObject->taxonomy][$queriedObject->term_id];

                }

            }

        }

    }


    return (int)$sliderTermID;

}