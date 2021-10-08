<?php
/*
 * Plugin Name: Boosted comments
 * Description: Make comments more powerful
 * Author: xareyli
 */

defined( 'ABSPATH' ) || exit;

define('BC_PATH_ROOT', dirname(__FILE__) . '/');
define('BC_URI_ROOT', '/wp-content/plugins/boosted-comments/');

require_once BC_PATH_ROOT . 'comments-ajax.php';
