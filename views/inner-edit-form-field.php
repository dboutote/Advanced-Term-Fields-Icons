<?php
/**
 * Edit form view
 *
 * Displays the form fields for editing terms.
 *
 * @uses 'do_action' "adv_term_fields_show_inner_field_edit_{$this->meta_key}" filter.
 *
 * @package Advanced_Term_Fields
 * @subpackage Adv_Term_Fields_Icons\Views
 *
 * @since 0.1.0
 */

$meta_value = $this->get_meta( $term->term_id );
$icon = sprintf(
	'<i data-icon="%1$s" class="term-icon dashicons %1$s"></i>',
	esc_attr( $meta_value )
);
?>
<div id="atf-icon-meta-wrap" class="icon-meta-wrap">
	<div class="icon-utils">
		<div class="icon-img">
			<?php echo $icon;?>
		</div>
		<input name="<?php echo esc_attr( $this->meta_key ); ?>" id="<?php echo esc_attr( $this->meta_slug ); ?>" type="text" value="<?php echo esc_attr( $meta_value ); ?>" size="20" />
		<input type="button" data-target="#<?php echo esc_attr( $this->meta_slug ); ?>" class="button dashicons-picker" value="<?php esc_html_e( 'Choose Icon', 'adv-term-fields' ); ?> " />
	</div>
</div>