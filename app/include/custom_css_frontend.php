<?php

/*
 * Style for ACF settings
 * Printed in wp_footer
 */

function dynamic_frontend_css() {
     ?><style type="text/css"><?php if(get_field('page_width','option') != ""): ?>.page-wrap{width: <?php echo (get_field('page_width','option') == "0") ? '100%' : get_field('page_width','option') . 'px'; ?>;}<?php endif; ?></style><?php
}
add_action('wp_footer', 'dynamic_frontend_css');


/*
 * Fonts
 * Printed in wp_footer
 */

function dynamic_frontend_js() {
    ?><script src="https://use.typekit.net/nmj8gyt.js"></script><script>try{Typekit.load({ async: true });}catch(e){}</script><?php
}
//add_action('wp_footer', 'dynamic_frontend_js');