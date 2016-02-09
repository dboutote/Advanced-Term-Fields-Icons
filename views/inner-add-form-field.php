<?php
/**
 * Add form view
 *
 * Displays the form fields for adding terms.
 *
 * @uses 'do_action' "adv_term_fields_show_inner_field_add_{$this->meta_key}" filter.
 *
 * @package Advanced_Term_Fields
 * @subpackage Adv_Term_Fields_Icons\Views
 *
 * @since 0.1.0
 */
?>
<input class="regular-text" name="<?php echo esc_attr( $this->meta_key ); ?>" id="<?php echo esc_attr( $this->meta_slug ); ?>" type="text" value="" size="20"  />
<input type="button" data-target="#<?php echo esc_attr( $this->meta_slug ); ?>" class="button dashicons-picker" value="<?php esc_html_e( 'Choose Icon', 'adv-term-fields' ); ?>" />