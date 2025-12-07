<?php
ini_set('display_errors', 'Off');
ini_set('error_reporting', E_ALL);
define('GENERATE_VERSION', '1.1.5');
$GLOBALS['CANHCAM'] = array();

// File header.php
// $body_class = get_field('add_class_body', get_the_ID());
// $body_class .= isset($GLOBALS['CANHCAM']['bg_body']) ? $GLOBALS['CANHCAM']['bg_body'] : '';

// File Template
// $GLOBALS['CANHCAM']['bg_body'] = 'has-menu-background';


require get_template_directory() . '/inc/function-acf.php';
require get_template_directory() . '/inc/function-root.php';
require get_template_directory() . '/inc/function-custom.php';
require get_template_directory() . '/inc/function-field.php';
require get_template_directory() . '/inc/function-setup.php';
require get_template_directory() . '/inc/function-ajax.php';
require get_template_directory() . '/inc/function-pagination.php';
require get_template_directory() . '/inc/function-form.php';

