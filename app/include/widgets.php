<?php

function freshitlab_widgets_init() {

    register_sidebar( array(
        'name' => 'Stopka strony kolumna lewa',
        'id' => 'footer_left',
        'before_widget' => '<div id="footer_left" class="footer_column_widget">',
        'after_widget' => '</div>',
        'before_title' => '<div class="f-title">',
        'after_title' => '</div>',
    ) );
    register_sidebar( array(
        'name' => 'Stopka strony kolumna lewa',
        'id' => 'footer_right',
        'before_widget' => '<div id="footer_right" class="footer_column_widget">',
        'after_widget' => '</div>',
        'before_title' => '<div class="f-title">',
        'after_title' => '</div>',
    ) );

}
//add_action( 'widgets_init', 'freshitlab_widgets_init' );



function pulawska_icon_func( $atts ) {
    $atts = shortcode_atts( array(
        'type' => 'no foo',
        'content' => 'default baz'
    ), $atts, 'pulawska_icon' );

    switch($atts['type']){
        case 'email':
            $a = '<a href="mailto:'.$atts['content'].'" title="'.$atts['content'].'">';
            break;
        case 'phone':
        case 'fax':
            $a = '<a href="tel:'.$atts['content'].'" title="'.$atts['content'].'">';
            break;
        default:
            $a = '<a href="#" title="">';
    }

    return "<div class='pulawska_icon {$atts['type']}'>".$a."{$atts['content']}</a></div>";
}
add_shortcode( 'pulawska_icon', 'pulawska_icon_func' );