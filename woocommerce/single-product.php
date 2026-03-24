<?php
/**
 * Single Product.
 *
 * @package MeuTema
 */

defined('ABSPATH') || exit;

get_header('shop');
?>

<main class="section single-product-template">
	<div class="container">
		<?php while (have_posts()) : ?>
			<?php the_post(); ?>

			<?php do_action('woocommerce_before_single_product'); ?>

			<?php if (post_password_required()) : ?>
				<?php echo get_the_password_form(); ?>
				<?php return; ?>
			<?php endif; ?>

			<article id="product-<?php the_ID(); ?>" <?php wc_product_class('card', wc_get_product(get_the_ID())); ?>>
				<header class="section-subtitle">
					<?php woocommerce_breadcrumb(); ?>
				</header>

				<div class="product-layout">
					<div class="product-gallery-section">
						<?php do_action('woocommerce_before_single_product_summary'); ?>
					</div>

					<div class="product-details-section summary entry-summary">
						<?php do_action('woocommerce_single_product_summary'); ?>
					</div>
				</div>

				<div class="product-tabs-section">
					<?php do_action('woocommerce_after_single_product_summary'); ?>
				</div>
			</article>

			<?php do_action('woocommerce_after_single_product'); ?>
		<?php endwhile; ?>
	</div>
</main>

<?php get_footer('shop'); ?>
