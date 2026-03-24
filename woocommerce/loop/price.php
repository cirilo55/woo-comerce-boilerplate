<?php
/**
 * Product loop price.
 *
 * @package MeuTema
 */

defined('ABSPATH') || exit;

global $product;

if (empty($product) || !$product->get_price_html()) {
	return;
}
?>

<div class="product-price-box">
	<span class="price-current"><?php echo wp_kses_post($product->get_price_html()); ?></span>
</div>
