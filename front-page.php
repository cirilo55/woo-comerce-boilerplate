<?php get_header(); ?>

<main>
	<section class="hero-carousel">
		<div class="carousel-container">
			<div class="carousel-wrapper">
				<div class="carousel-slide carousel-slide-active">
					<?php 
					$template_dir = '';
					if (function_exists('get_template_directory_uri')) {
						$template_dir = call_user_func('get_template_directory_uri');
					}
					?>
					<div class="slide-bg" style="background-image: url('<?php echo esc_url($template_dir . '/images/slide-1.jpg'); ?>'); background-size: cover; background-position: center;"></div>
					<div class="slide-overlay"></div>
					<div class="slide-content">
						<h2>Bem-vindo à Arqfy</h2>
						<p>Produtos de qualidade que transformam seu dia</p>
						<?php if (class_exists('WooCommerce') && function_exists('wc_get_page_permalink')) : ?>
							<a class="btn btn-primary" href="<?php echo esc_url(call_user_func('wc_get_page_permalink', 'shop')); ?>">Explorar loja</a>
						<?php else : ?>
							<a class="btn btn-primary" href="/loja/">Explorar loja</a>
						<?php endif; ?>
					</div>
				</div>

				<div class="carousel-slide">
					<div class="slide-bg" style="background-image: url('<?php echo esc_url($template_dir . '/images/slide-2.jpg'); ?>'); background-size: cover; background-position: center;"></div>
					<div class="slide-overlay"></div>
					<div class="slide-content">
						<h2>Frete grátis em todo Brasil</h2>
						<p>Entrega rápida com rastreamento completo</p>
						<?php if (class_exists('WooCommerce') && function_exists('wc_get_page_permalink')) : ?>
							<a class="btn btn-primary" href="<?php echo esc_url(call_user_func('wc_get_page_permalink', 'shop')); ?>">Ver ofertas</a>
						<?php else : ?>
							<a class="btn btn-primary" href="/loja/">Ver ofertas</a>
						<?php endif; ?>
					</div>
				</div>

				<div class="carousel-slide">
					<div class="slide-bg" style="background-image: url('<?php echo esc_url($template_dir . '/images/slide-3.jpg'); ?>'); background-size: cover; background-position: center;"></div>
					<div class="slide-overlay"></div>
					<div class="slide-content">
						<h2>Produtos exclusivos</h2>
						<p>Seleção cuidada com garantia de satisfação</p>
						<?php if (class_exists('WooCommerce') && function_exists('wc_get_page_permalink')) : ?>
							<a class="btn btn-primary" href="<?php echo esc_url(call_user_func('wc_get_page_permalink', 'shop')); ?>">Descobrir</a>
						<?php else : ?>
							<a class="btn btn-primary" href="/loja/">Descobrir</a>
						<?php endif; ?>
					</div>
				</div>
			</div>

			<div class="carousel-nav">
				<button class="carousel-dot active" data-slide="0"></button>
				<button class="carousel-dot" data-slide="1"></button>
				<button class="carousel-dot" data-slide="2"></button>
			</div>
		</div>
	</section>

	<?php if (class_exists('WooCommerce')) : ?>
	<section id="destaques" class="section shop-featured">
		<div class="container">
			<div class="featured-header">
				<h2 class="featured-title">MAIS VENDIDOS</h2>
				<p class="featured-subtitle">Confira nossos produtos mais procurados e promoções especiais.</p>
			</div>

			<?php
			if (class_exists('WP_Query')) {
				if (function_exists('have_posts') && call_user_func('have_posts')) : ?>
					<div class="products-carousel-wrapper">
						<ul class="products-carousel">
							<?php while (call_user_func('have_posts')) : call_user_func('the_post');
								global $product;
								$has_thumb = function_exists('has_post_thumbnail') ? call_user_func('has_post_thumbnail') : false;
								$on_sale = is_object($product) && method_exists($product, 'is_on_sale') ? $product->is_on_sale() : false;
								?>
								<li class="product-card">
									<a href="<?php the_permalink(); ?>" class="product-image">
										<?php if ($has_thumb) : ?>
											<?php if (function_exists('the_post_thumbnail')) call_user_func('the_post_thumbnail', 'medium'); ?>
										<?php else : ?>
											<div class="no-image">Sem imagem</div>
										<?php endif; ?>
										<?php if ($on_sale) : ?>
											<span class="sale-badge">PROMOÇÃO</span>
										<?php endif; ?>
									</a>
									<div class="product-info">
										<h3 class="product-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
										<div class="product-price">
											<?php if (is_object($product) && method_exists($product, 'get_price_html')) {
												echo wp_kses_post($product->get_price_html());
											} ?>
										</div>
										<?php
										$excerpt = function_exists('get_the_excerpt') ? call_user_func('get_the_excerpt') : '';
										if (function_exists('wp_trim_words')) {
											$excerpt = call_user_func('wp_trim_words', $excerpt, 10);
										}
										?>
										<p class="product-excerpt"><?php echo esc_html($excerpt); ?></p>
										<a href="<?php the_permalink(); ?>" class="btn btn-primary btn-sm">Ver detalhes</a>
									</div>
								</li>
							<?php endwhile; ?>
						</ul>
					</div>
					<?php if (function_exists('wp_reset_postdata')) call_user_func('wp_reset_postdata'); ?>
				<?php else : ?>
					<div class="no-products">
						<p>Nenhum produto cadastrado ainda. <a href="<?php if (function_exists('admin_url')) echo esc_url(call_user_func('admin_url', 'post-new.php?post_type=product')); ?>">Adicione produtos agora</a>.</p>
					</div>
				<?php endif;
			} else {
				echo '<div class="no-products"><p>WP_Query não disponível.</p></div>';
			}
			?>
		</div>
	</section>

	<section class="shop-benefits">
		<div class="container benefits-grid">
			<div class="benefit-card">
				<div class="benefit-icon">📦</div>
				<h3>Envio rápido</h3>
				<p>Entrega em até 2 dias úteis para a maioria dos produtos.</p>
			</div>
			<div class="benefit-card">
				<div class="benefit-icon">🔒</div>
				<h3>Seguro na compra</h3>
				<p>Seus dados pessoais são protegidos com criptografia SSL.</p>
			</div>
			<div class="benefit-card">
				<div class="benefit-icon">💳</div>
				<h3>Formas de pagamento</h3>
				<p>Cartão, PIX, boleto e parcelamento direto em até 12x.</p>
			</div>
			<div class="benefit-card">
				<div class="benefit-icon">↩️</div>
				<h3>Devolução fácil</h3>
				<p>Não gostou? Devolvemos seu dinheiro em 7 dias úteis.</p>
			</div>
		</div>
	</section>
	<?php endif; ?>
</main>

<?php get_footer(); ?>
