<?php
/**
 * Advanced Term Fields: Icons
 *
 * @package Advanced_Term_Fields_Icons
 *
 * @license     http://www.gnu.org/licenses/gpl-2.0.txt GPL-2.0+
 * @version     0.1.1
 *
 * Plugin Name: Advanced Term Fields: Icons
 * Plugin URI:  http://darrinb.com/advanced-term-fields-icons
 * Description: Easily assign dashicon icons for all your terms.
 * Version:     0.1.1
 * Author:      Darrin Boutote
 * Author URI:  http://darrinb.com
 * Text Domain: atf-icons
 * Domain Path: /lang
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */


/**
 * @attribution Inspired by the WP Term Icons Plugin (https://wordpress.org/plugins/wp-term-icons/)
 *              by John James Jacoby (https://profiles.wordpress.org/johnjamesjacoby/)
 */


// No direct access
if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}


/**
 * @internal Nobody should be able to overrule the real version number
 * as this can cause serious issues, so no if ( ! defined() )
 *
 * @since 0.1.1
 */
define( 'ATF_ICONS_VERSION', '0.1.1' );


if ( ! defined( 'ATF_ICONS_FILE' ) ) {
	define( 'ATF_ICONS_FILE', __FILE__ );
}


/**
 * Load Utilities
 *
 * @since 0.1.0
 */
include dirname( __FILE__ ) . '/inc/functions.php';


/**
 * Checks compatibility
 *
 * @since 0.1.0
 */
add_action( 'plugins_loaded', '_atf_icons_compatibility_check', 99 );


/**
 * Instantiates main Advanced Term Fields: Icons class
 *
 * @since 0.1.0
 */
function _atf_icons_init() {

	if ( ! _atf_icons_compatibility_check() ){ return; }

	include dirname( __FILE__ ) . '/inc/class-adv-term-fields-icons.php';

	$Adv_Term_Fields_Icons = new Adv_Term_Fields_Icons( __FILE__ );
	$Adv_Term_Fields_Icons->init();

}
add_action( 'init', '_atf_icons_init', 99 );


/**
 * Run actions on plugin upgrade
 *
 * @since 0.1.1
 */
add_action( "atf__term_icon_version_upgraded", '_atf_icons_version_upgraded_notice', 10, 5 );
add_action( "atf__term_icon_version_upgraded", '_atf_icons_maybe_update_meta_key', 10, 5 );