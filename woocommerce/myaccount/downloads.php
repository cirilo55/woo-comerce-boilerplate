<?php
/**
 * Available downloads.
 *
 * @package MeuTema
 */

defined('ABSPATH') || exit;

?>

<section class="card myaccount-downloads">
	<header class="page-header">
		<h2 class="section-title"><?php esc_html_e('Downloads', 'meutema'); ?></h2>
	</header>

	<?php if ($downloads) : ?>
		<table class="woocommerce-table woocommerce-table--order-downloads shop_table shop_table_responsive order_details">
			<thead>
				<tr>
					<?php foreach (wc_get_account_downloads_columns() as $column_id => $column_name) : ?>
						<th class="download-<?php echo esc_attr($column_id); ?>"><span class="nobr"><?php echo esc_html($column_name); ?></span></th>
					<?php endforeach; ?>
				</tr>
			</thead>

			<tbody>
				<?php foreach ($downloads as $download) : ?>
					<tr>
						<?php foreach (wc_get_account_downloads_columns() as $column_id => $column_name) : ?>
							<td class="download-<?php echo esc_attr($column_id); ?>" data-title="<?php echo esc_attr($column_name); ?>">
								<?php if (has_action('woocommerce_account_downloads_column_' . $column_id)) : ?>
									<?php do_action('woocommerce_account_downloads_column_' . $column_id, $download); ?>
								<?php elseif ('download-product' === $column_id) : ?>
									<?php if (empty($download['product_url'])) : ?>
										<?php echo esc_html($download['product_name']); ?>
									<?php else : ?>
										<a href="<?php echo esc_url($download['product_url']); ?>"><?php echo esc_html($download['product_name']); ?></a>
									<?php endif; ?>
								<?php elseif ('download-file' === $column_id) : ?>
									<a href="<?php echo esc_url($download['download_url']); ?>" class="woocommerce-MyAccount-downloads-file button alt"><?php esc_html_e('Baixar', 'meutema'); ?></a>
								<?php else : ?>
									<?php echo esc_html(is_string($download[$column_id]) ? $download[$column_id] : ''); ?>
								<?php endif; ?>
							</td>
						<?php endforeach; ?>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	<?php else : ?>
		<p><?php esc_html_e('Nenhum download disponivel ainda.', 'meutema'); ?></p>
	<?php endif; ?>
</section>
