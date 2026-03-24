<?php
/**
 * Checkout form.
 *
 * @package MeuTema
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_checkout_form', $checkout);

if (!$checkout->is_registration_enabled() && $checkout->is_registration_required() && !is_user_logged_in()) {
	echo esc_html(apply_filters('woocommerce_checkout_must_be_logged_in_message', __('Voce precisa estar logado para finalizar a compra.', 'meutema')));
	return;
}
?>

<main class="section woocommerce-checkout-page">
	<div class="container">
		<article class="page-shell card">
			<header class="page-header">
				<h1 class="section-title"><?php esc_html_e('Finalizar compra', 'meutema'); ?></h1>
				<p class="section-subtitle"><?php esc_html_e('Revise seus dados e conclua o pedido com seguranca.', 'meutema'); ?></p>
			</header>

			<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data">
				<?php if ($checkout->get_checkout_fields()) : ?>
					<?php do_action('woocommerce_checkout_before_customer_details'); ?>

					<div class="checkout-layout" id="customer_details">
						<div class="checkout-customer-data">
							<div class="checkout-billing card">
								<?php do_action('woocommerce_checkout_billing'); ?>
							</div>

							<div class="checkout-shipping card">
								<?php do_action('woocommerce_checkout_shipping'); ?>
							</div>
						</div>

						<aside class="checkout-review card">
							<h2 id="order_review_heading"><?php esc_html_e('Resumo do pedido', 'meutema'); ?></h2>
							<?php do_action('woocommerce_checkout_before_order_review'); ?>
							<div id="order_review" class="woocommerce-checkout-review-order">
								<?php do_action('woocommerce_checkout_order_review'); ?>
							</div>
							<?php do_action('woocommerce_checkout_after_order_review'); ?>
						</aside>
					</div>

					<?php do_action('woocommerce_checkout_after_customer_details'); ?>
				<?php endif; ?>
			</form>
		</article>
	</div>
</main>

<?php do_action('woocommerce_after_checkout_form', $checkout); ?>
