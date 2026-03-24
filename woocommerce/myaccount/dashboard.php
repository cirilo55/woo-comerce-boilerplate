<?php
/**
 * My account dashboard.
 *
 * @package MeuTema
 */

defined('ABSPATH') || exit;

$current_user = wp_get_current_user();

$allowed_html = array(
	'a' => array(
		'href' => array(),
		'title' => array(),
	),
);
?>

<section class="card myaccount-dashboard">
	<header class="page-header">
		<h2 class="section-title"><?php esc_html_e('Minha conta', 'meutema'); ?></h2>
		<p class="section-subtitle"><?php esc_html_e('Acompanhe pedidos, dados de acesso e downloads em um so lugar.', 'meutema'); ?></p>
	</header>

	<p>
		<?php
		printf(
			wp_kses(__('Ola <strong>%1$s</strong> (nao e <strong>%1$s</strong>? <a href="%2$s">Sair</a>)', 'meutema'), $allowed_html),
			esc_html($current_user->display_name),
			esc_url(wc_logout_url())
		);
		?>
	</p>

	<p>
		<?php
		printf(
			wp_kses(__('Pelo painel da sua conta voce pode ver seus <a href="%1$s">pedidos recentes</a>, gerenciar <a href="%2$s">enderecos</a> e <a href="%3$s">editar sua senha e dados</a>.', 'meutema'), $allowed_html),
			esc_url(wc_get_endpoint_url('orders')),
			esc_url(wc_get_endpoint_url('edit-address')),
			esc_url(wc_get_endpoint_url('edit-account'))
		);
		?>
	</p>

	<?php do_action('woocommerce_account_dashboard'); ?>
</section>
