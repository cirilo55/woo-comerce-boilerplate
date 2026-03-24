<?php
/**
 * Quantity input.
 *
 * @package MeuTema
 */

defined('ABSPATH') || exit;
?>

<?php if ($max_value && $min_value === $max_value) : ?>
	<div class="quantity hidden">
		<input type="hidden" id="<?php echo esc_attr($input_id); ?>" class="qty" name="<?php echo esc_attr($input_name); ?>" value="<?php echo esc_attr($min_value); ?>" />
	</div>
<?php else : ?>
	<div class="quantity">
		<?php do_action('woocommerce_before_quantity_input_field'); ?>

		<label class="screen-reader-text" for="<?php echo esc_attr($input_id); ?>"><?php echo esc_attr($label); ?></label>

		<input
			type="<?php echo esc_attr($type); ?>"
			<?php echo $readonly ? 'readonly="readonly"' : ''; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			id="<?php echo esc_attr($input_id); ?>"
			class="<?php echo esc_attr(join(' ', (array) $classes)); ?>"
			name="<?php echo esc_attr($input_name); ?>"
			value="<?php echo esc_attr($input_value); ?>"
			aria-label="<?php esc_attr_e('Quantidade do produto', 'meutema'); ?>"
			min="<?php echo esc_attr($min_value); ?>"
			max="<?php echo esc_attr(0 < $max_value ? $max_value : ''); ?>"
			<?php if (!$readonly) : ?>
				step="<?php echo esc_attr($step); ?>"
				placeholder="<?php echo esc_attr($placeholder); ?>"
				inputmode="<?php echo esc_attr($inputmode); ?>"
				autocomplete="<?php echo esc_attr(isset($autocomplete) ? $autocomplete : 'on'); ?>"
			<?php endif; ?>
		/>

		<?php do_action('woocommerce_after_quantity_input_field'); ?>
	</div>
<?php endif; ?>
