<?php
/**
 * Template de Arquivo de Produtos (Loja)
 * 
 * @package ArqDeco
 * @subpackage MeuTema
 */

get_header(); ?>

<main>
	<!-- Hero da Página -->
	<section class="products-page-hero">
		<div class="container">
			<h1 class="products-page-title">Nossa Loja</h1>
			<p class="products-page-subtitle">Explore nossa coleção de produtos exclusivos e promocionais</p>
		</div>
	</section>

	<!-- Filtros e Produtos -->
	<section class="products-page-content">
		<div class="container">
			<div class="products-layout">
				<!-- Sidebar com Filtros -->
				<aside class="products-sidebar">
					<div class="sidebar-widget">
						<h3 class="sidebar-title">🔍 Buscar</h3>
						<?php get_search_form(); ?>
					</div>

					<?php if (is_active_sidebar('shop-sidebar')) : ?>
						<?php dynamic_sidebar('shop-sidebar'); ?>
					<?php endif; ?>

					<!-- Filtro de Preço -->
					<div class="sidebar-widget">
						<h3 class="sidebar-title">💰 Faixa de Preço</h3>
						<div class="price-filter">
							<input type="range" min="0" max="10000" value="10000" class="price-range-slider" id="priceRange">
							<div class="price-display">
								<span>Até</span>
								<span class="price-value">R$ 10.000,00</span>
							</div>
						</div>
					</div>

					<!-- Filtro de Avaliação -->
					<div class="sidebar-widget">
						<h3 class="sidebar-title">⭐ Avaliações</h3>
						<div class="rating-filter">
							<label><input type="checkbox"> ⭐⭐⭐⭐⭐ (5 estrelas)</label>
							<label><input type="checkbox"> ⭐⭐⭐⭐ (4+ estrelas)</label>
							<label><input type="checkbox"> ⭐⭐⭐ (3+ estrelas)</label>
							<label><input type="checkbox"> ⭐⭐ (2+ estrelas)</label>
						</div>
					</div>

					<!-- Promoções -->
					<div class="sidebar-widget promo-widget">
						<h3 class="sidebar-title">🎁 Em Promoção</h3>
						<div class="promo-box">
							<p>Fique atento aos nossos descontos especiais!</p>
							<a href="#" class="btn btn-primary btn-sm">Ver Promoções</a>
						</div>
					</div>
				</aside>

				<!-- Lista de Produtos -->
				<div class="products-main">
					<!-- Controles de Exibição -->
					<div class="products-toolbar">
						<div class="toolbar-left">
							<span class="products-count">
								<?php 
								global $wp_query;
								$total = isset($wp_query->found_posts) ? $wp_query->found_posts : 0;
								echo sprintf(__('Mostrando %d produtos', 'meutema'), $total);
								?>
							</span>
						</div>

						<div class="toolbar-right">
							<div class="sort-by">
								<label>Ordenar por:</label>
								<select class="sort-select">
									<option value="menu_order">Recomendados</option>
									<option value="date">Mais Recentes</option>
									<option value="price">Menor Preço</option>
									<option value="price-desc">Maior Preço</option>
									<option value="rating">Mais Avaliados</option>
									<option value="popularity">Mais Vendidos</option>
								</select>
							</div>

							<div class="view-options">
								<button class="view-btn active" data-view="grid" title="Grade">⊞</button>
								<button class="view-btn" data-view="list" title="Lista">≡</button>
							</div>
						</div>
					</div>

					<!-- Grid de Produtos -->
					<?php if (have_posts()) : ?>
						<div class="products-grid">
							<?php 
							while (have_posts()) : the_post();
								global $product;
								$has_thumb = has_post_thumbnail();
								$on_sale = $product->is_on_sale();
								$rating = $product->get_rating_count() > 0 ? $product->get_average_rating() : 0;
								?>
								<div class="product-item">
									<div class="product-card-wrapper">
										<!-- Imagem -->
										<div class="product-image-container">
											<a href="<?php the_permalink(); ?>" class="product-link">
												<?php if ($has_thumb) : ?>
													<?php the_post_thumbnail('woocommerce_thumbnail', array('class' => 'product-image')); ?>
												<?php else : ?>
													<div class="product-placeholder">Sem Imagem</div>
												<?php endif; ?>
											</a>

											<!-- Badge de Promoção -->
											<?php if ($on_sale) : ?>
												<div class="product-badge sale">
													<span class="badge-text">
														<?php 
														$regular = $product->get_regular_price();
														$sale = $product->get_sale_price();
														if ($regular && $sale) {
															$discount = round(((($regular - $sale) / $regular) * 100));
															echo '-' . $discount . '%';
														} else {
															echo 'PROMOÇÃO';
														}
														?>
													</span>
												</div>
											<?php endif; ?>

											<!-- Estoque -->
											<?php if (!$product->is_in_stock()) : ?>
												<div class="product-badge out-of-stock">
													<span class="badge-text">Fora do Estoque</span>
												</div>
											<?php endif; ?>

											<!-- Quick View -->
											<div class="product-overlay">
												<button class="btn btn-primary quick-view-btn" data-product-id="<?php the_ID(); ?>">
													👁️ Visualizar
												</button>
											</div>

											<!-- Wishlist -->
											<button class="wishlist-btn" title="Adicionar aos favoritos">♡</button>
										</div>

										<!-- Informações -->
										<div class="product-info-container">
											<!-- Categoria -->
											<div class="product-category">
												<?php echo wc_get_product_category_list(get_the_ID(), ', ', '<span class="cat">', '</span>'); ?>
											</div>

											<!-- Título -->
											<h2 class="product-title">
												<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
											</h2>

											<!-- Avaliação -->
											<?php if ($rating > 0) : ?>
												<div class="product-rating">
													<div class="stars">
														<?php echo str_repeat('⭐', (int)$rating); ?>
													</div>
													<span class="rating-count">(<?php echo $product->get_rating_count(); ?>)</span>
												</div>
											<?php endif; ?>

											<!-- Descrição Curta -->
											<?php if ($product->get_short_description()) : ?>
												<p class="product-description">
													<?php echo wp_trim_words($product->get_short_description(), 15, '...'); ?>
												</p>
											<?php endif; ?>

											<!-- Preço -->
											<div class="product-price-box">
												<?php 
												if ($on_sale) {
													echo '<span class="price-regular">' . wc_price($product->get_regular_price()) . '</span>';
												}
												echo '<span class="price-current">' . wc_price($product->get_price()) . '</span>';
												?>
											</div>

											<!-- Botão Add to Cart -->
											<form class="add-to-cart-form" method="post">
												<?php if ($product->is_in_stock()) : ?>
													<button type="submit" name="add-to-cart" value="<?php the_ID(); ?>" class="btn btn-primary btn-block add-to-cart-btn">
														🛒 Adicionar ao Carrinho
													</button>
												<?php else : ?>
													<button class="btn btn-outline btn-block" disabled>
														Indisponível
													</button>
												<?php endif; ?>
											</form>

											<!-- Links -->
											<div class="product-links">
												<a href="<?php the_permalink(); ?>" class="link-text">Ver Detalhes →</a>
											</div>
										</div>
									</div>
								</div>
							<?php endwhile; ?>
						</div>

						<!-- Paginação -->
						<div class="products-pagination">
							<?php
							echo paginate_links(array(
								'type' => 'list',
								'prev_text' => '← Anterior',
								'next_text' => 'Próximo →',
							));
							?>
						</div>

					<?php else : ?>
						<div class="no-products-archive">
							<div class="no-products-icon">🔍</div>
							<h2>Nenhum produto encontrado</h2>
							<p>Desculpe, nenhum produto corresponde aos critérios de busca.</p>
							<a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>" class="btn btn-primary">
								Voltar à Loja
							</a>
						</div>
					<?php endif; 
					wp_reset_postdata();
					?>
				</div>
			</div>
		</div>
	</section>

	<!-- CTA Section -->
	<section class="cta-section">
		<div class="container">
			<div class="cta-content">
				<h2>Não encontrou o que procura?</h2>
				<p>Entre em contato conosco! Nosso time está pronto para ajudar.</p>
				<div class="cta-buttons">
					<a href="<?php echo esc_url(home_url('/contato')); ?>" class="btn btn-primary">
						📧 Enviar Mensagem
					</a>
					<a href="tel:+5511977775555" class="btn btn-outline">
						📱 (11) 97777-5555
					</a>
				</div>
			</div>
		</div>
	</section>
</main>

<?php get_footer(); ?>