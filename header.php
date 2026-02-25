<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php $template_dir = function_exists('get_template_directory_uri') ? call_user_func('get_template_directory_uri') : ''; ?>
	<link rel="icon" type="image/svg+xml" href="<?php echo esc_url($template_dir . '/favicon.svg'); ?>">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="announcement-banner">
	<div class="announcement-carousel">
		<div class="announcement-item">✓ Frete grátis em todo o Brasil</div>
		<div class="announcement-item">⭐ Produtos exclusivos e selecionados</div>
		<div class="announcement-item">🚀 Entrega rápida em até 2 dias úteis</div>
		<div class="announcement-item">✓ Desconto de primeira compra</div>
		<div class="announcement-item">✓ Frete grátis em todo o Brasil</div>
		<div class="announcement-item">⭐ Produtos exclusivos e selecionados</div>
		<div class="announcement-item">🚀 Entrega rápida em até 2 dias úteis</div>
		<div class="announcement-item">✓ Desconto de primeira compra</div>
	</div>
</div>

<header class="site-header">
	<div class="container header-wrap">
		<a class="logo" href="<?php echo esc_url(home_url('/')); ?>">
			<?php 
			$logo_url = '';
			if (function_exists('get_template_directory_uri')) {
				$logo_url = call_user_func('get_template_directory_uri') . '/logo.svg';
			}
			if ($logo_url) : ?>
				<img src="<?php echo esc_url($logo_url); ?>" alt="Arqfy" class="logo-img">
			<?php endif; ?>
			<span class="logo-text">Arqfy</span>
		</a>

		<nav class="main-nav" aria-label="Menu principal">
			<?php if (class_exists('WooCommerce') && function_exists('wc_get_page_permalink')) : ?>
				<?php $shop_url = (string) call_user_func('wc_get_page_permalink', 'shop'); ?>
				<a href="<?php echo esc_url($shop_url); ?>">Loja</a>
			<?php endif; ?>
		</nav>

		<div class="header-icons">
			<?php if (class_exists('WooCommerce') && function_exists('wc_get_page_permalink') && function_exists('wc_get_cart_url')) : ?>
				<?php
				$cart_url = (string) call_user_func('wc_get_cart_url');
				$account_url = (string) call_user_func('wc_get_page_permalink', 'myaccount');
				$cart_count = 0;

				if (function_exists('WC')) {
					$wc = call_user_func('WC');
					if (is_object($wc) && isset($wc->cart) && is_object($wc->cart) && method_exists($wc->cart, 'get_cart_contents_count')) {
						$cart_count = (int) $wc->cart->get_cart_contents_count();
					}
				}
				?>
				<a href="<?php echo esc_url($cart_url); ?>" class="icon-link cart-link" aria-label="Carrinho">
					<span class="icon">🛒</span>
					<?php if ($cart_count > 0) : ?>
						<span class="badge"><?php echo esc_html((string) $cart_count); ?></span>
					<?php endif; ?>
				</a>
				<a href="<?php echo esc_url($account_url); ?>" class="icon-link account-link" aria-label="Minha conta">
					<span class="icon">👤</span>
				</a>
			<?php endif; ?>
		</div>
	</div>
</header>
