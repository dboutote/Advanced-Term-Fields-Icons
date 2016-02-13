<?php
/**
 * Quick-edit form view
 *
 * Displays the form fields for quick-editing terms.
 *
 * @uses 'do_action' "adv_term_fields_show_inner_field_qedit_{$this->meta_key}" filter.
 *
 * @package Advanced_Term_Fields
 * @subpackage Adv_Term_Fields_Icons\Views
 *
 * @since 0.1.0
 */
?>
<input id="inline-<?php echo esc_attr( $this->meta_slug ); ?>" type="text" class="ptitle" name="<?php echo esc_attr( $this->meta_key ); ?>" value="" size="20" />
<input type="button" data-target="#inline-<?php echo esc_attr( $this->meta_slug ); ?>" class="button dashicons-picker" value="<?php esc_html_e( 'Choose Icon', 'adv-term-fields' ); ?>" />