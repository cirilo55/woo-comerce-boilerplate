<?php
/**
 * Product loop item.
 *
 * @package MeuTema
 */

defined('ABSPATH') || exit;

global $product;

if (!$product || !$product->is_visible()) {
	return;
}

$is_on_sale = $product->is_on_sale();
$is_in_stock = $product->is_in_stock();
?>

<li <?php wc_product_class('product-item', $product); ?>>
	<div class="product-card-wrapper">
		<?php do_action('woocommerce_before_shop_loop_item'); ?>

		<div class="product-image-container">
			<?php do_action('woocommerce_before_shop_loop_item_title'); ?>

			<?php if (!$is_in_stock) : ?>
				<div class="product-badge out-of-stock"><span class="badge-text"><?php esc_html_e('Indisponivel', 'meutema'); ?></span></div>
			<?php elseif ($is_on_sale) : ?>
				<div class="product-badge sale"><span class="badge-text"><?php esc_html_e('Oferta', 'meutema'); ?></span></div>
			<?php endif; ?>
		</div>

		<div class="product-info-container">
			<div class="product-category">
				<?php echo wc_get_product_category_list(get_the_ID(), ', ', '<span class="cat">', '</span>'); ?>
			</div>

			<?php do_action('woocommerce_shop_loop_item_title'); ?>

			<div class="product-rating">
				<?php do_action('woocommerce_after_shop_loop_item_title'); ?>
			</div>

			<div class="product-links">
				<?php do_action('woocommerce_after_shop_loop_item'); ?>
			</div>
		</div>
	</div>
</li>
