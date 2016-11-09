<?php

/*
 * Admin CSS
 */

add_action('admin_head', 'my_custom_fonts');

function my_custom_fonts() {
    echo '<style>';
    echo '#cpt_info_box {
      display: none;
    }
    .notice-msg.updated{
      display: none;
    }
    .acf-postbox h3{
        background: #222;
        color: #FFF;
        padding: 8px 12px;
        text-transform: uppercase;
        font-weight: 900;
    }
    #postbox-container-1 .inside .cml-override-flags.cml-override,
    #postbox-container-1 .inside > h4:last-of-type{display: none;}';
    echo '</style>';
}

if( function_exists('acf_add_options_page') ) {

    function my_acf_admin_head()
    {
        if(get_field('show_authorlogo','option')):
            ?>
            <style type="text/css">
                #postbox-container-1{
                    background-image: url(<?php echo ASSETS_DIR . DS . 'images/authorlogo.png'; ?>);
                    background-size: 100%;
                    background-position: top center;
                    background-repeat: no-repeat;
                    padding-top: 180px;
                }
            </style>
        <?php endif;
    }

    add_action('acf/input/admin_head', 'my_acf_admin_head');

}

/*
 * Login Screen
 */

function freshitlab_admin_theme_style() {
    wp_enqueue_style('freshitlab-admin-theme',  ASSETS_DIR . '/css/admin-login-screen.css');
}
add_action('admin_enqueue_scripts', 'freshitlab_admin_theme_style');
add_action('login_enqueue_scripts', 'freshitlab_admin_theme_style');

function freshitlab_admin_screen() {

    $bg = array('admin_design_1.jpg', 'admin_design_2.jpg', 'admin_design_3.jpg', 'admin_design_4.jpg', 'admin_design_5.jpg', 'admin_design_6.jpg', 'admin_design_7.jpg' );

    $i = rand(0, count($bg)-1); // generate random number size of the array
    $selectedBg = "$bg[$i]";

    echo '<style>';
    echo 'body.login{background: url('.get_template_directory_uri().'/assets/admin/'.$selectedBg.');}';
    echo '#login:after{background-image: url('.ASSETS_DIR . DS .'images/authorlogo.png);}';
    echo '</style>';
}
add_action('admin_enqueue_scripts', 'freshitlab_admin_screen');
add_action('login_enqueue_scripts', 'freshitlab_admin_screen');