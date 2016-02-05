<?php
/**
 * Advanced Term Fields: Icons
 *
 * @package Advanced_Term_Fields_Icons
 *
 * @license     http://www.gnu.org/licenses/gpl-2.0.txt GPL-2.0+
 * @version     0.1.0
 *
 * Plugin Name: Advanced Term Fields: Icons
 * Plugin URI:  http://darrinb.com/advanced-term-fields-icons
 * Description: Easily assign dashicon icons for categories, tags, and custom taxonomy terms.
 * Version:     0.1.0
 * Author:      Darrin Boutote
 * Author URI:  http://darrinb.com
 * Text Domain: atf-icons
 * Domain Path: /lang
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

// No direct access
if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}


/**
 * Checks compatibility
 *
 * @uses _atf_icons_plugin_deactivate()
 * @uses _atf_icons_plugin_admin_notice()
 *
 * @since 0.1.0
 *
 * @return void
 */
function _atf_icons_compatibility_check(){
	if ( ! class_exists( 'Advanced_Term_Fields' ) ) :
		add_action( 'admin_init', '_atf_icons_plugin_deactivate');
		add_action( 'admin_notices', '_atf_icons_plugin_admin_notice');
		return;
	endif;

	define( 'ATF_ICONS_COMPAT', true );
}
add_action( 'plugins_loaded', '_atf_icons_compatibility_check', 99 );


/**
 * Deactivates plugin
 *
 * @since 0.1.0
 *
 * @return void
 */
function _atf_icons_plugin_deactivate() {
	deactivate_plugins( plugin_basename( __FILE__ ) );
}


/**
 * Displays deactivation notice
 *
 * @since 0.1.0
 *
 * @return void
 */
function _atf_icons_plugin_admin_notice() {
	echo '<div class="error"><p>'
		. sprintf(
			__( '%1$s requires the %2$s plugin to function correctly. Unable to activate at this time.', 'atf-icons' ),
			'<strong>' . esc_html( 'Advanced Term Fields: Icons' ) . '</strong>',
			'<strong>' . esc_html( 'Advanced Term Fields' ) . '</strong>'
			)
		. '</p></div>';

	if ( isset( $_GET['activate'] ) ) {
		unset( $_GET['activate'] );
	}
}


/**
 * Instantiates main Advanced Term Fields: Icons class
 *
 * @since 0.1.0
 */
function _atf_icons_init() {

	if( ! defined( 'ATF_ICONS_COMPAT' ) ){ return; }

	include dirname( __FILE__ ) . '/inc/class-adv-term-fields-icons.php';

	$Adv_Term_Fields_Icons = new Adv_Term_Fields_Icons( __FILE__ );
	$Adv_Term_Fields_Icons->init();

}
add_action( 'init', '_atf_icons_init', 99 );
