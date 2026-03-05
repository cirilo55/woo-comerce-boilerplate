<?php
/**
 * Template de Página de Produto Individual
 * 
 * @package ArqDeco
 * @subpackage MeuTema
 */

get_header(); ?>

<main>
	<div class="single-product-wrapper">
		<div class="container">
			<?php 
			while (have_posts()) : the_post();
				global $product;
				
				$has_thumb = has_post_thumbnail();
				$on_sale = $product->is_on_sale();
				$rating = $product->get_rating_count() > 0 ? $product->get_average_rating() : 0;
				$in_stock = $product->is_in_stock();
				?>
				
				<!-- Breadcrumb -->
				<div class="breadcrumb-wrapper">
					<?php
					if (function_exists('woocommerce_breadcrumb')) {
						woocommerce_breadcrumb();
					}
					?>
				</div>

				<!-- Produto Principal -->
				<div class="product-layout">
					<!-- Galeria de Imagens -->
					<div class="product-gallery-section">
						<div class="product-gallery">
							<?php if ($has_thumb) : ?>
								<div class="gallery-main">
									<?php the_post_thumbnail('woocommerce_single', array('class' => 'product-main-image')); ?>
									
									<?php if ($on_sale) : ?>
										<div class="product-badge-large sale">
											<span>
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
								</div>

								<!-- Thumbnails -->
								<?php 
								$attachment_ids = $product->get_gallery_image_ids();
								if (!empty($attachment_ids)) : ?>
									<div class="gallery-thumbs">
										<?php 
										foreach ($attachment_ids as $attachment_id) {
											echo wp_get_attachment_image($attachment_id, 'thumbnail', false, array('class' => 'thumb-img'));
										}
										?>
									</div>
								<?php endif; ?>
							<?php else : ?>
								<div class="product-placeholder-large">
									<div class="placeholder-icon">🖼️</div>
									<p>Sem Imagem</p>
								</div>
							<?php endif; ?>
						</div>
					</div>

					<!-- Informações do Produto -->
					<div class="product-details-section">
						<!-- Categoria -->
						<div class="product-category-breadcrumb">
							<?php echo wc_get_product_category_list(get_the_ID(), ', ', '<span class="cat-badge">', '</span>'); ?>
						</div>

						<!-- Título -->
						<h1 class="product-title-single"><?php the_title(); ?></h1>

						<!-- Avaliação -->
						<?php if ($rating > 0) : ?>
							<div class="product-rating-section">
								<div class="stars-large">
									<?php echo str_repeat('⭐', (int)$rating); ?>
									<?php echo str_repeat('☆', (5 - (int)$rating)); ?>
								</div>
								<span class="rating-text">
									<?php echo number_format($rating, 1); ?> / 5.0 
									(<?php echo $product->get_rating_count(); ?> avaliações)
								</span>
							</div>
						<?php endif; ?>

						<!-- Disponibilidade -->
						<div class="product-availability">
							<?php if ($in_stock) : ?>
								<span class="in-stock">✅ Em Estoque</span>
								<?php if (method_exists($product, 'get_stock_quantity')) : ?>
									<span class="stock-quantity">
										<?php 
										$quantity = $product->get_stock_quantity();
										if ($quantity) {
											echo '(' . $quantity . ' unidades disponíveis)';
										}
										?>
									</span>
								<?php endif; ?>
							<?php else : ?>
								<span class="out-of-stock">❌ Fora do Estoque</span>
							<?php endif; ?>
						</div>

						<!-- Preço -->
						<div class="product-price-section">
							<?php 
							if ($on_sale) {
								echo '<span class="price-original">' . wc_price($product->get_regular_price()) . '</span>';
								echo '<span class="price-savings">Economize: ' . wc_price($product->get_regular_price() - $product->get_sale_price()) . '</span>';
							}
							echo '<span class="price-main">' . wc_price($product->get_price()) . '</span>';
							?>
						</div>

						<!-- Descrição Curta -->
						<?php if ($product->get_short_description()) : ?>
							<div class="product-excerpt-section">
								<?php echo wp_kses_post($product->get_short_description()); ?>
							</div>
						<?php endif; ?>

						<!-- Formulário de Compra -->
						<div class="product-purchase-section">
							<?php if ($in_stock) : ?>
								<form class="product-purchase-form" method="post">
									<!-- Quantidade -->
									<div class="form-group">
										<label for="quantity">Quantidade:</label>
										<div class="quantity-control">
											<button type="button" class="qty-btn qty-minus">−</button>
											<input type="number" name="quantity" value="1" min="1" max="<?php echo $product->get_max_purchase_quantity(); ?>" class="qty-input" id="quantity">
											<button type="button" class="qty-btn qty-plus">+</button>
										</div>
									</div>

									<!-- Botão Add to Cart -->
									<div class="form-group">
										<button type="submit" name="add-to-cart" value="<?php the_ID(); ?>" class="btn btn-primary btn-lg btn-block add-to-cart-single">
											🛒 Adicionar ao Carrinho
										</button>
									</div>

									<!-- Wishlist -->
									<div class="form-group">
										<button type="button" class="btn btn-outline btn-block wishlist-btn-single">
											♡ Adicionar aos Favoritos
										</button>
									</div>
								</form>
							<?php else : ?>
								<button class="btn btn-outline btn-lg btn-block" disabled>
									Produto Indisponível
								</button>
								<button type="button" class="btn btn-primary btn-block notify-btn">
									📧 Notificar-me quando disponível
								</button>
							<?php endif; ?>
						</div>

						<!-- Especificações de Entrega -->
						<div class="product-shipping-info">
							<div class="shipping-item">
								<span class="shipping-icon">🚚</span>
								<div class="shipping-text">
									<strong>Entrega Rápida</strong>
									<small>Frete grátis em todo Brasil para compras acima de R$ 100</small>
								</div>
							</div>
							<div class="shipping-item">
								<span class="shipping-icon">🔄</span>
								<div class="shipping-text">
									<strong>Devolução Fácil</strong>
									<small>7 dias para devolver e receber reembolso total</small>
								</div>
							</div>
							<div class="shipping-item">
								<span class="shipping-icon">🔒</span>
								<div class="shipping-text">
									<strong>Compra 100% Segura</strong>
									<small>Seus dados protegidos com criptografia SSL</small>
								</div>
							</div>
						</div>

						<!-- Compartilhar -->
						<div class="product-share">
							<span>Compartilhar:</span>
							<a href="#" class="share-btn facebook" title="Facebook">f</a>
							<a href="#" class="share-btn twitter" title="Twitter">𝕏</a>
							<a href="#" class="share-btn whatsapp" title="WhatsApp">💬</a>
							<a href="#" class="share-btn email" title="Email">✉️</a>
						</div>
					</div>
				</div>

				<!-- Tabs de Informações -->
				<div class="product-tabs-section">
					<div class="tabs-nav">
						<button class="tab-btn active" data-tab="description">Descrição</button>
						<button class="tab-btn" data-tab="specifications">Especificações</button>
						<button class="tab-btn" data-tab="reviews">Avaliações</button>
					</div>

					<div class="tabs-content">
						<!-- Descrição -->
						<div class="tab-pane active" id="description">
							<div class="product-description-full">
								<?php the_content(); ?>
							</div>
						</div>

						<!-- Especificações -->
						<div class="tab-pane" id="specifications">
							<div class="product-attributes">
								<?php 
								$attributes = $product->get_attributes();
								if ($attributes) :
									foreach ($attributes as $attribute) : ?>
										<div class="attribute-row">
											<strong><?php echo wc_attribute_label($attribute->get_name()); ?>:</strong>
											<span><?php echo wp_kses_post(wc_implode_html_attributes($product->get_attribute($attribute->get_name()))); ?></span>
										</div>
									<?php endforeach;
								else :
									echo '<p>Nenhuma especificação disponível.</p>';
								endif;
								?>
							</div>
						</div>

						<!-- Avaliações -->
						<div class="tab-pane" id="reviews">
							<div class="product-reviews">
								<?php 
								if (comments_open()) {
									comments_template('/comments.php');
								}
								?>
							</div>
						</div>
					</div>
				</div>

				<!-- Produtos Relacionados -->
				<div class="related-products-section">
					<h2>Produtos Relacionados</h2>
					<?php
					$related_limit = 4;
					$related_products = wc_get_related_products(get_the_ID(), $related_limit);
					
					if ($related_products) {
						echo '<div class="related-products-grid">';
						foreach ($related_products as $product_id) {
							$prod = wc_get_product($product_id);
							if (!$prod) continue;
							setup_postdata($GLOBALS['post'] = get_post($product_id));
							
							?>
							<div class="related-product-card">
								<a href="<?php the_permalink(); ?>" class="related-product-link">
									<?php if (has_post_thumbnail()) : ?>
										<?php the_post_thumbnail('woocommerce_thumbnail'); ?>
									<?php else : ?>
										<div class="product-placeholder">Sem Imagem</div>
									<?php endif; ?>
								</a>
								<div class="related-product-info">
									<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
									<div class="price"><?php echo wp_kses_post($prod->get_price_html()); ?></div>
									<a href="<?php the_permalink(); ?>" class="btn btn-primary btn-sm">Ver Detalhes</a>
								</div>
							</div>
							<?php
						}
						echo '</div>';
					}
					wp_reset_postdata();
					?>
				</div>

			<?php endwhile; ?>
		</div>
	</div>
</main>

<?php get_footer(); ?>