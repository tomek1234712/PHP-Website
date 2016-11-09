<?php


class AppCustomPostType {
    function __construct() {
        $this->init();
    }

    public function init() {
        //add_action('init', array($this, 'registerCustomPostTypes') ) ;
        //add_action('init', array($this, 'registerCustomTaxonomies') ) ;
    }


    public function registerCustomPostTypes() {
        
        //Uczestnicy
        
        $labels = array(
            'name'               => __( 'Uczestnicy', 'hello' ),
            'singular_name'      => __( 'Uczestnicy', 'hello' ),
            'menu_name'          => __( 'Uczestnicy', 'hello' ),
            'name_admin_bar'     => __( 'Uczestnicy', 'hello' ),
            'add_new'            => __( 'Dodaj', 'hello' ),
            'add_new_item'       => __( 'Dodaj', 'hello' ),
            'new_item'           => __( 'Dodaj', 'hello' ),
            'edit_item'          => __( 'Edytuj', 'hello' ),
            'view_item'          => __( 'Pokaż', 'hello' ),
            'all_items'          => __( 'Wszystkie', 'hello' ),
            'search_items'       => __( 'Szukaj', 'hello' ),
            'parent_item_colon'  => __( 'Rodzic:', 'hello' ),
            'not_found'          => __( 'Nie znaleziono.', 'hello' ),
            'not_found_in_trash' => __( 'Nie znaleziono w koszu', 'hello' )
        );

        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'taxonomies'         => array(),
            'rewrite'            => array( 'slug' => 'uczestnicy' ),
            'capability_type'    => 'post',
            'menu_icon'          => 'dashicons-image-filter',
            'has_archive'        => true,
            'hierarchical'       => true,
            'menu_position'      => null,
            'supports'           => array( 'title')
        );

        register_post_type( 'uczestnicy', $args );
        
        
        //Kalkulator
        
        $labels = array(
            'name'               => __( 'Kalkulator', 'hello' ),
            'singular_name'      => __( 'Kalkulator', 'hello' ),
            'menu_name'          => __( 'Kalkulator', 'hello' ),
            'name_admin_bar'     => __( 'Galerie', 'hello' ),
            'add_new'            => __( 'Dodaj pytanie', 'hello' ),
            'add_new_item'       => __( 'Dodaj pytanie', 'hello' ),
            'new_item'           => __( 'Dodaj pytanie', 'hello' ),
            'edit_item'          => __( 'Edytuj', 'hello' ),
            'view_item'          => __( 'Pokaż', 'hello' ),
            'all_items'          => __( 'Wszystko', 'hello' ),
            'search_items'       => __( 'Szukaj', 'hello' ),
            'parent_item_colon'  => __( 'Rodzic:', 'hello' ),
            'not_found'          => __( 'Nie znaleziono.', 'hello' ),
            'not_found_in_trash' => __( 'Nie znaleziono w koszu', 'hello' )
        );

        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'taxonomies'         => array(),
            'rewrite'            => array( 'slug' => 'kalkulator' ),
            'capability_type'    => 'post',
            'menu_icon'          => 'dashicons-calendar-alt',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'supports'           => array( 'title', 'editor')
        );

        register_post_type( 'kalkulator', $args );

    }
    
    public function registerCustomTaxonomies() {


        $labels = array(
            'name'              => __( 'Zestawy'),
            'singular_name'     => __( 'Zestawy'),
            'search_items'      => __( 'Zestawy' ),
            'all_items'         => __( 'Zestawy' ),
            'parent_item'       => __( 'Rodzic' ),
            'parent_item_colon' => __( 'Rodzic:' ),
            'edit_item'         => __( 'Edytuj' ),
            'update_item'       => __( 'Zaktualizuj' ),
            'add_new_item'      => __( 'Dodaj' ),
            'new_item_name'     => __( 'Dodaj' ),
            'menu_name'         => __( 'Zestawy' ),
        );

        $args = array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'zestawy' ),
        );

        register_taxonomy( 'kalkulator_cat', array( 'kalkulator' ), $args );


    }
}