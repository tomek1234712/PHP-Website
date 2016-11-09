<?php

require INCLUDE_SCRIPT_DIR . DS . 'support.php';
require INCLUDE_SCRIPT_DIR . DS . 'register_css_js.php';
require INCLUDE_SCRIPT_DIR . DS . 'acf.php';
require INCLUDE_SCRIPT_DIR . DS . 'custom_css_admin.php';
require INCLUDE_SCRIPT_DIR . DS . 'filters.php';
require INCLUDE_SCRIPT_DIR . DS . 'media.php';
require INCLUDE_SCRIPT_DIR . DS . 'menus.php';
require INCLUDE_SCRIPT_DIR . DS . 'other.php';
//require INCLUDE_SCRIPT_DIR . DS . 'pagination.php';
require INCLUDE_SCRIPT_DIR . DS . 'widgets.php';
require INCLUDE_SCRIPT_DIR . DS . 'clearnup.php';
require INCLUDE_SCRIPT_DIR . DS . 'custom_css_frontend.php';

/*
 * Include actions
 */

//require ACTIONSDIR . DS . 'lex_contact_form.php';
//require ACTIONSDIR . DS . 'lex_calculator.php';

/*
 *  Include plugins
 */

//include(INC_PLUGIN_DIR . DS . "post-type-archive-links" . DS . "post-type-archive-links.php");
//include(INC_PLUGIN_DIR . DS . "post-types-order" . DS . "post-types-order.php");
//include(INC_PLUGIN_DIR . DS . "taxonomy-terms-order" . DS . "taxonomy-terms-order.php");
//include(INC_PLUGIN_DIR . DS . "elastic-slider" . DS . "elastic-slider.php");
//include(INC_PLUGIN_DIR . DS . "wp-mail-smtp" . DS . "wp_mail_smtp.php");
include(INC_PLUGIN_DIR . DS . "regenerate-thumbnails" . DS . "regenerate-thumbnails.php");
//include(INC_PLUGIN_DIR . DS . "codepress-admin-columns" . DS . "codepress-admin-columns.php");

//include(INC_PLUGIN_DIR . DS . "wp-session-manager" . DS . "wp-session-manager.php");