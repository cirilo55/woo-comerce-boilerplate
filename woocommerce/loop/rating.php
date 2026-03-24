<?php
/**
 * Product loop rating.
 *
 * @package MeuTema
 */

defined('ABSPATH') || exit;

global $product;

if (!wc_review_ratings_enabled()) {
	return;
}

$rating_count = $product->get_rating_count();
$average      = $product->get_average_rating();

if ($rating_count <= 0) {
	return;
}
?>

<div class="product-rating" role="img" aria-label="<?php echo esc_attr(sprintf(__('Nota %1$s de 5 (%2$s avaliacoes)', 'meutema'), $average, $rating_count)); ?>">
	<?php echo wc_get_rating_html($average, $rating_count); ?>
	<span class="rating-count">(<?php echo esc_html($rating_count); ?>)</span>
</div>
