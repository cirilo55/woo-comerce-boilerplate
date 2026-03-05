<?php
/**
 * Configurações e informações sobre plugins recomendados
 * 
 * @package MeuTema
 * @subpackage Plugins
 */

// Evitar acesso direto
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Array com informações detalhadas dos plugins recomendados
 */
$GLOBALS['meutema_plugins_info'] = array(
    
    // ===== CACHE =====
    'cache' => array(
        'title' => 'Cache & Performance',
        'description' => 'Melhore a velocidade do seu site',
        'plugins' => array(
            array(
                'name' => 'LiteSpeed Cache',
                'slug' => 'litespeed-cache',
                'url' => 'https://wordpress.org/plugins/litespeed-cache/',
                'description' => 'Plugin de cache de alta performance. Otimiza imagens, CSS, JavaScript e oferece CDN gratuito.',
                'benefits' => array(
                    '⚡ Cache de página completa',
                    '🖼️ Otimização automática de imagens',
                    '📦 Minificação de assets',
                    '🌍 CDN integrado',
                    '🚀 Até 10x mais rápido',
                ),
            ),
        ),
    ),
    
    // ===== PAGAMENTOS =====
    'payments' => array(
        'title' => 'Gateways de Pagamento',
        'description' => 'Integre diferentes formas de pagamento',
        'plugins' => array(
            array(
                'name' => 'Mercado Pago',
                'slug' => 'woo-mercado-pago',
                'url' => 'https://www.mercadopago.com.br/developers/pt',
                'description' => 'Integração oficial do Mercado Pago com WooCommerce. Aceite cartões, boleto, PIX.',
                'benefits' => array(
                    '💳 Cartão de crédito',
                    '📄 Boleto bancário',
                    '🔐 PIX (transferência instantânea)',
                    '📱 Conta digital',
                    '🛡️ Proteção contra fraude',
                ),
            ),
            array(
                'name' => 'PagSeguro para WooCommerce',
                'slug' => 'pagseguro-for-woocommerce',
                'url' => 'https://github.com/r-martins/PagSeguro-WooCommerce',
                'description' => 'Módulo de Ricardo Martins com suporte completo a PagSeguro. Oferece descontos especiais.',
                'benefits' => array(
                    '💳 Cartão de crédito',
                    '💰 Transferência bancária',
                    '🏪 Saldo PagSeguro',
                    '📊 Relatórios detalhados',
                    '🎁 Promoções e descontos',
                ),
            ),
            array(
                'name' => 'WooPayments',
                'slug' => 'woocommerce-payments',
                'url' => 'https://woocommerce.com/products/woo-payments/',
                'description' => 'Solução oficial de pagamentos do WooCommerce. Payout direto em conta bancária.',
                'benefits' => array(
                    '💳 Cartão de crédito (parcelado)',
                    '📲 Apple Pay & Google Pay',
                    '🔐 Acesso USD (para vendedores internacionais)',
                    '📊 Dashboard integrado',
                    '✅ Aprovação em 1-2 dias',
                ),
            ),
        ),
    ),
);

/**
 * Exibir informações de plugins no painel de admin
 */
function meutema_show_plugins_info() {
    global $meutema_plugins_info;
    
    if (!current_user_can('activate_plugins')) {
        return;
    }

    echo '<div class="meutema-plugins-info-notice">';
    echo '<h3>ℹ️ Plugins Recomendados para ArqDeco</h3>';
    
    foreach ($meutema_plugins_info as $category => $data) {
        echo '<div class="plugin-category">';
        echo '<h4>' . esc_html($data['title']) . '</h4>';
        echo '<p>' . esc_html($data['description']) . '</p>';
        
        foreach ($data['plugins'] as $plugin) {
            echo '<div class="plugin-item">';
            echo '<strong>' . esc_html($plugin['name']) . '</strong><br>';
            echo '<small>' . esc_html($plugin['description']) . '</small><br>';
            echo '<ul style="margin: 10px 0; padding-left: 20px;">';
            foreach ($plugin['benefits'] as $benefit) {
                echo '<li>' . esc_html($benefit) . '</li>';
            }
            echo '</ul>';
            echo '<a href="' . esc_url($plugin['url']) . '" target="_blank" class="button button-primary" style="margin-top: 10px;">Saiba mais</a>';
            echo '</div>';
        }
        
        echo '</div>';
    }
    
    echo '</div>';
    echo '<style>
        .meutema-plugins-info-notice {
            background: linear-gradient(135deg, #f6f7fb 0%, #fff 100%);
            border-left: 5px solid #FF9900;
            padding: 20px;
            margin: 20px 0;
            border-radius: 8px;
        }
        .plugin-category {
            margin: 20px 0;
            padding: 15px;
            background: white;
            border-radius: 6px;
            border: 1px solid #e5e7eb;
        }
        .plugin-item {
            margin: 15px 0;
            padding: 15px;
            background: #f9fafb;
            border-radius: 4px;
        }
    </style>';
}

// Mostrar informações apenas em páginas específicas
if (is_admin() && (isset($_GET['page']) && $_GET['page'] === 'tgmpa-install-plugins')) {
    add_action('admin_notices', 'meutema_show_plugins_info');
}
