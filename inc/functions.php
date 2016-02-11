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
function _atf_icons_compatibility_check() {

	if ( ! class_exists( 'Advanced_Term_Fields' ) ) {
		add_action( 'admin_init', '_atf_icons_plugin_deactivate');
		add_action( 'admin_notices', '_atf_icons_plugin_compatibility_notice');
		return false;
	};

	return true;
}


/**
 * Deactivates plugin
 *
 * @since 0.1.0
 *
 * @return void
 */
function _atf_icons_plugin_deactivate() {
	deactivate_plugins( plugin_basename( ATF_ICONS_FILE ) );
}


/**
 * Displays deactivation notice
 *
 * @since 0.1.0
 *
 * @return void
 */
function _atf_icons_plugin_compatibility_notice() {

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
 * Displays upgrade notice
 *
 * @since 0.1.1
 *
 * @param bool   $updated        True|False flag for option being updated.
 * @param string $db_version_key The database key for the plugin version.
 * @param string $plugin_version The most recent plugin version.
 * @param string $db_version     The plugin version stored in the database pre upgrade.
 * @param string $meta_key       The meta field key.
 *
 * @return void
 */
function _atf_icons_version_upgraded_notice( $updated, $db_version_key, $plugin_version, $db_version, $meta_key ){

	if ( $updated ) {

		$display_msg = sprintf(
			'<div class="updated notice is-dismissible"><p><b>%1$s</b> has been upgraded to version <b>%2$s</b></p></div>',
			__( 'Advanced Term Fields: Icons', 'atf-icons' ),
			$plugin_version
		);

		add_action('admin_notices', function() use ( $display_msg ) {
			echo $display_msg;
		});

	}

}


/**
 * Updates meta key to protected on upgrade
 *
 * Prior to v0.1.1 meta keys were stored non-protected i.e., "term_icon".  As of v0.1.1 meta keys
 * were stored as protected i.e., "_term_icon" with a prefixed underscore "_".  This function
 * updates all old versions of the stored meta key. It will only be run once, on upgrade to any version
 * higher than 0.1.0.
 *
 * @since 0.1.1
 *
 * @return mixed bool|integer False on failure, number of rows affected on success.
 */
function _atf_icons_maybe_update_meta_key( $updated, $db_version_key, $plugin_version, $db_version, $meta_key )
{

	$old_key = 'term_icon';

	if ( ! $updated ) {
		return;
	}

	if( get_option( "{$meta_key}_key_updated" ) ){
		return;
	}

	global $wpdb;

	$updated_keys = $wpdb->update(
		$wpdb->termmeta,
		array( 'meta_key' => $meta_key ),
		array( 'meta_key' => $old_key ),
		array( '%s' ),
		array( '%s' )
	);

	if ( false !== $updated_keys ) {
		$now = time();
		update_option( "{$meta_key}_key_updated", $updated_keys . ':' . $now );
	}
	
	return $updated_keys;

}


