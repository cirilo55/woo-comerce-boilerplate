<?php
/**
 * Dashboard Widget - Plugins Recomendados
 * 
 * @package MeuTema
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Adicionar widget ao dashboard com informações de plugins
 */
function meutema_add_dashboard_widget() {
    if (!current_user_can('manage_options')) {
        return;
    }

    wp_add_dashboard_widget(
        'meutema_plugins_widget',
        '🎁 Plugins Recomendados para ArqDeco',
        'meutema_plugins_widget_callback'
    );
}
add_action('wp_dashboard_setup', 'meutema_add_dashboard_widget');

/**
 * Conteúdo do widget
 */
function meutema_plugins_widget_callback() {
    $plugins_status = array(
        'litespeed-cache' => 'LiteSpeed Cache',
        'woo-mercado-pago' => 'Mercado Pago',
        'pagseguro-for-woocommerce' => 'PagSeguro',
        'woocommerce-payments' => 'WooPayments',
    );

    $active_plugins = get_option('active_plugins', array());
    $installed_plugins = array_keys(get_plugins());

    ?>
    <div style="padding: 10px;">
        <p>Otimize sua loja com estes plugins recomendados:</p>
        
        <table style="width: 100%; border-collapse: collapse;">
            <tr style="background: #f9fafb; border-bottom: 1px solid #e5e7eb;">
                <th style="text-align: left; padding: 10px; border: 1px solid #e5e7eb;">Plugin</th>
                <th style="text-align: center; padding: 10px; border: 1px solid #e5e7eb; width: 100px;">Status</th>
                <th style="text-align: center; padding: 10px; border: 1px solid #e5e7eb; width: 80px;">Ação</th>
            </tr>
            <?php foreach ($plugins_status as $slug => $name) : 
                $is_active = in_array($slug . '/index.php', $active_plugins) || in_array($slug . '/' . $slug . '.php', $active_plugins);
                $is_installed = in_array($slug . '/index.php', $installed_plugins) || in_array($slug . '/' . $slug . '.php', $installed_plugins);
                
                if ($is_active) {
                    $status = '<span style="color: #10b981;">✅ Ativo</span>';
                    $action = '-';
                } elseif ($is_installed) {
                    $status = '<span style="color: #f59e0b;">⏸️ Inativo</span>';
                    $action = '<a href="' . wp_nonce_url(admin_url('plugins.php?action=activate&plugin=' . ($slug . '/' . $slug . '.php')), 'activate-plugin_' . ($slug . '/' . $slug . '.php')) . '" class="button button-small">Ativar</a>';
                } else {
                    $status = '<span style="color: #ef4444;">❌ Não instalado</span>';
                    $action = '<a href="' . wp_nonce_url(admin_url('update.php?action=install-plugin&plugin=' . $slug), 'install-plugin_' . $slug) . '" class="button button-small button-primary">Instalar</a>';
                }
            ?>
                <tr style="border-bottom: 1px solid #e5e7eb;">
                    <td style="padding: 10px; border: 1px solid #e5e7eb;">
                        <strong><?php echo esc_html($name); ?></strong>
                    </td>
                    <td style="padding: 10px; border: 1px solid #e5e7eb; text-align: center;">
                        <?php echo wp_kses_post($status); ?>
                    </td>
                    <td style="padding: 10px; border: 1px solid #e5e7eb; text-align: center;">
                        <?php echo wp_kses_post($action); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

        <div style="margin-top: 20px; padding: 15px; background: #f0f9ff; border-left: 4px solid #FF9900; border-radius: 4px;">
            <p style="margin: 0; font-size: 12px;">
                <strong>💡 Dica:</strong> Leia a documentação completa em 
                <code style="background: white; padding: 2px 6px; border-radius: 3px;">PLUGINS_RECOMENDADOS.md</code>
            </p>
        </div>
    </div>
    <?php
}

/**
 * Adicionar link na barra de administração
 */
function meutema_admin_bar_plugins_link($wp_admin_bar) {
    if (!current_user_can('manage_options')) {
        return;
    }

    $wp_admin_bar->add_menu(array(
        'id'    => 'meutema-plugins',
        'title' => '🎁 Plugins ArqDeco',
        'href'  => admin_url('index.php#meutema_plugins_widget'),
    ));
}
add_action('admin_bar_menu', 'meutema_admin_bar_plugins_link', 100);
