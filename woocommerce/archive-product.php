<?php
/**
 * Product archives (shop).
 *
 * @package MeuTema
 */

defined('ABSPATH') || exit;

get_header('shop');

$shop_title = function_exists('woocommerce_page_title') ? woocommerce_page_title(false) : esc_html__('Loja', 'meutema');
?>

<main class="products-archive-template">
	<section class="products-page-hero">
		<div class="container">
			<h1 class="products-page-title"><?php echo esc_html($shop_title); ?></h1>
			<p class="products-page-subtitle"><?php esc_html_e('Escolha pecas com identidade para transformar seu ambiente.', 'meutema'); ?></p>
		</div>
	</section>

	<section class="products-page-content">
		<div class="container">
			<div class="products-layout">
				<aside class="products-sidebar" aria-label="<?php esc_attr_e('Filtros da loja', 'meutema'); ?>">
					<div class="sidebar-widget">
						<h2 class="sidebar-title"><?php esc_html_e('Buscar', 'meutema'); ?></h2>
						<?php get_search_form(); ?>
					</div>

					<?php if (is_active_sidebar('shop-sidebar')) : ?>
						<?php dynamic_sidebar('shop-sidebar'); ?>
					<?php else : ?>
						<?php do_action('woocommerce_sidebar'); ?>
					<?php endif; ?>

					<div class="sidebar-widget promo-widget">
						<h3 class="sidebar-title"><?php esc_html_e('Colecao em destaque', 'meutema'); ?></h3>
						<div class="promo-box">
							<p><?php esc_html_e('Combine funcionalidade e design em pecas selecionadas para seu projeto.', 'meutema'); ?></p>
							<a class="btn btn-outline" href="<?php echo esc_url(home_url('/contato')); ?>"><?php esc_html_e('Falar com consultor', 'meutema'); ?></a>
						</div>
					</div>
				</aside>

				<div class="products-main">
					<?php if (woocommerce_product_loop()) : ?>
						<div class="products-toolbar">
							<div class="toolbar-left">
								<span class="products-count"><?php woocommerce_result_count(); ?></span>
							</div>
							<div class="toolbar-right">
								<div class="sort-by">
									<span><?php esc_html_e('Ordenar por', 'meutema'); ?></span>
									<?php woocommerce_catalog_ordering(); ?>
								</div>
							</div>
						</div>

						<?php do_action('woocommerce_before_shop_loop'); ?>

						<?php woocommerce_product_loop_start(); ?>

						<?php while (have_posts()) : ?>
							<?php the_post(); ?>
							<?php do_action('woocommerce_shop_loop'); ?>
							<?php wc_get_template_part('content', 'product'); ?>
						<?php endwhile; ?>

						<?php woocommerce_product_loop_end(); ?>

						<?php do_action('woocommerce_after_shop_loop'); ?>
					<?php else : ?>
						<?php do_action('woocommerce_no_products_found'); ?>
					<?php endif; ?>
				</div>
			</div>

		</div>
	</section>
</main>

<?php get_footer('shop'); ?>
