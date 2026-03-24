<?php
/**
 * Mini-cart.
 *
 * @package MeuTema
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_mini_cart');
?>

<?php if (!WC()->cart->is_empty()) : ?>
	<ul class="woocommerce-mini-cart cart_list product_list_widget <?php echo esc_attr($args['list_class']); ?>">
		<?php foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) : ?>
			<?php
			$_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
			$product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

			if (!$_product || !$_product->exists() || $cart_item['quantity'] <= 0 || !apply_filters('woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key)) {
				continue;
			}

			$product_name = apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key);
			$thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);
			$product_price = apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key);
			$product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
			?>

			<li class="woocommerce-mini-cart-item mini_cart_item">
				<?php
				echo apply_filters(
					'woocommerce_cart_item_remove_link',
					sprintf(
						'<a href="%s" class="remove remove_from_cart_button" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s">&times;</a>',
						esc_url(wc_get_cart_remove_url($cart_item_key)),
						esc_attr(sprintf(__('Remover %s do carrinho', 'meutema'), wp_strip_all_tags($product_name))),
						esc_attr($product_id),
						esc_attr($cart_item_key),
						esc_attr($_product->get_sku())
					),
					$cart_item_key
				);
				?>

				<?php if (empty($product_permalink)) : ?>
					<?php echo $thumbnail . wp_kses_post($product_name); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				<?php else : ?>
					<a href="<?php echo esc_url($product_permalink); ?>">
						<?php echo $thumbnail . wp_kses_post($product_name); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</a>
				<?php endif; ?>

				<?php echo wc_get_formatted_cart_item_data($cart_item); ?>
				<span class="quantity"><?php echo esc_html(sprintf('%d x ', $cart_item['quantity'])) . wp_kses_post($product_price); ?></span>
			</li>
		<?php endforeach; ?>
	</ul>

	<p class="woocommerce-mini-cart__total total"><strong><?php esc_html_e('Subtotal:', 'meutema'); ?></strong> <?php echo wp_kses_post(WC()->cart->get_cart_subtotal()); ?></p>

	<p class="woocommerce-mini-cart__buttons buttons">
		<?php do_action('woocommerce_widget_shopping_cart_buttons'); ?>
	</p>
<?php else : ?>
	<p class="woocommerce-mini-cart__empty-message"><?php esc_html_e('Seu carrinho esta vazio.', 'meutema'); ?></p>
<?php endif; ?>

<?php do_action('woocommerce_after_mini_cart'); ?>
