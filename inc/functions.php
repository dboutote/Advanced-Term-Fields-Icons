<?php

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


function _atf_icons_version_upgraded( $updated, $plugin_version, $db_version, $db_version_key ){
	if( $updated ) {
		// displayed message
		$display_msg = sprintf(
			'<div class="updated notice is-dismissible"><p><b>%1$s</b> has been upgraded to version <b>%2$s</b></p></div>',
			__( 'Advanced Term Fields: Icons', 'atf-icons' ),
			$db_version
		);
		// let the user know
		add_action('admin_notices', function() use ( $display_msg ) {
			echo $display_msg;
		});
	}
}


