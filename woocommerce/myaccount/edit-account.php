<?php
/**
 * Edit account form.
 *
 * @package MeuTema
 */

defined('ABSPATH') || exit;

$user = wp_get_current_user();
?>

<section class="card myaccount-edit-account">
	<header class="page-header">
		<h2 class="section-title"><?php esc_html_e('Editar conta', 'meutema'); ?></h2>
	</header>

	<form class="woocommerce-EditAccountForm edit-account" action="" method="post">
		<?php do_action('woocommerce_edit_account_form_start'); ?>

		<p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
			<label for="account_first_name"><?php esc_html_e('Nome', 'meutema'); ?> <span class="required">*</span></label>
			<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_first_name" id="account_first_name" autocomplete="given-name" value="<?php echo esc_attr($user->first_name); ?>" />
		</p>

		<p class="woocommerce-form-row woocommerce-form-row--last form-row form-row-last">
			<label for="account_last_name"><?php esc_html_e('Sobrenome', 'meutema'); ?> <span class="required">*</span></label>
			<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_last_name" id="account_last_name" autocomplete="family-name" value="<?php echo esc_attr($user->last_name); ?>" />
		</p>

		<div class="clear"></div>

		<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
			<label for="account_display_name"><?php esc_html_e('Nome de exibicao', 'meutema'); ?> <span class="required">*</span></label>
			<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_display_name" id="account_display_name" value="<?php echo esc_attr($user->display_name); ?>" />
		</p>

		<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
			<label for="account_email"><?php esc_html_e('E-mail', 'meutema'); ?> <span class="required">*</span></label>
			<input type="email" class="woocommerce-Input woocommerce-Input--email input-text" name="account_email" id="account_email" autocomplete="email" value="<?php echo esc_attr($user->user_email); ?>" />
		</p>

		<fieldset>
			<legend><?php esc_html_e('Alterar senha', 'meutema'); ?></legend>

			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="password_current"><?php esc_html_e('Senha atual (deixe vazio para nao alterar)', 'meutema'); ?></label>
				<input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_current" id="password_current" autocomplete="off" />
			</p>

			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="password_1"><?php esc_html_e('Nova senha (deixe vazio para nao alterar)', 'meutema'); ?></label>
				<input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_1" id="password_1" autocomplete="off" />
			</p>

			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="password_2"><?php esc_html_e('Confirme a nova senha', 'meutema'); ?></label>
				<input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_2" id="password_2" autocomplete="off" />
			</p>
		</fieldset>

		<?php do_action('woocommerce_edit_account_form'); ?>

		<p>
			<?php wp_nonce_field('save_account_details', 'save-account-details-nonce'); ?>
			<button type="submit" class="woocommerce-Button button" name="save_account_details" value="<?php esc_attr_e('Salvar alteracoes', 'meutema'); ?>"><?php esc_html_e('Salvar alteracoes', 'meutema'); ?></button>
			<input type="hidden" name="action" value="save_account_details" />
		</p>

		<?php do_action('woocommerce_edit_account_form_end'); ?>
	</form>
</section>
