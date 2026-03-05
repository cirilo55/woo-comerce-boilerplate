<?php

if (!function_exists('add_action') && file_exists(__DIR__ . '/wordpress-stubs.php')) {
    require_once __DIR__ . '/wordpress-stubs.php';
}

function meutema_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script'));

    register_nav_menus(array(
        'header-menu' => __('Menu do Cabeçalho', 'meutema'),
    ));

    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}
add_action('after_setup_theme', 'meutema_setup');

function meutema_enqueue_assets() {
    wp_enqueue_style(
        'meutema-style',
        get_stylesheet_uri(),
        array(),
        wp_get_theme()->get('Version')
    );

    if (function_exists('wp_enqueue_script')) {
        call_user_func('wp_enqueue_script',
            'meutema-carousel',
            get_template_directory_uri() . '/js/carousel.js',
            array(),
            wp_get_theme()->get('Version'),
            true
        );
        
        // Enqueue products page JS only on shop/archive pages
        if (function_exists('is_shop') && (is_shop() || is_product_category() || is_product_tag())) {
            call_user_func('wp_enqueue_script',
                'meutema-products-page',
                get_template_directory_uri() . '/js/products-page.js',
                array(),
                wp_get_theme()->get('Version'),
                true
            );
        }
        // Enqueue products page CSS only on shop/product pages
        if (function_exists('is_shop') && (is_shop() || is_product_category() || is_product_tag() || is_singular('product'))) {
            wp_enqueue_style(
                'meutema-shop-style',
                get_template_directory_uri() . '/css/shop.css',
                array('meutema-style'),
                wp_get_theme()->get('Version')
            );
        }
    }
}
add_action('wp_enqueue_scripts', 'meutema_enqueue_assets');

/**
 * Registrar plugins recomendados usando TGM Plugin Activation
 */
function meutema_register_required_plugins() {
    $plugins = array(
        // Cache
        array(
            'name'      => 'LiteSpeed Cache',
            'slug'      => 'litespeed-cache',
            'required'  => false,
            'force_activation'   => false,
            'force_deactivation' => false,
        ),
        // Pagamentos - Mercado Pago
        array(
            'name'      => 'Mercado Pago payments for WooCommerce',
            'slug'      => 'woo-mercado-pago',
            'required'  => false,
            'force_activation'   => false,
            'force_deactivation' => false,
        ),
        // Pagamentos - PagSeguro
        array(
            'name'      => 'Módulo PagSeguro para WooCommerce',
            'slug'      => 'pagseguro-for-woocommerce',
            'required'  => false,
            'force_activation'   => false,
            'force_deactivation' => false,
        ),
        // Pagamentos - WooPayments
        array(
            'name'      => 'WooPayments',
            'slug'      => 'woocommerce-payments',
            'required'  => false,
            'force_activation'   => false,
            'force_deactivation' => false,
        ),
    );

    $config = array(
        'id'           => 'meutema',
        'default_path' => get_template_directory() . '/inc/libraries/tgm-plugin-activation/',
        'menu'         => 'tgmpa-install-plugins',
        'parent_slug'  => 'themes.php',
        'capability'   => 'edit_theme_options',
        'has_notices'  => true,
        'dismissable'  => true,
        'dismiss_msg'  => 'Instale os plugins recomendados para melhor funcionalidade do tema.',
        'strings'      => array(
            'page_title'                      => esc_html__('Instalar Plugins Recomendados', 'meutema'),
            'menu_title'                      => esc_html__('Instalar Plugins', 'meutema'),
            'installing'                      => esc_html__('Instalando Plugin: %s', 'meutema'),
            'updating'                        => esc_html__('Atualizando Plugin: %s', 'meutema'),
            'oops'                            => esc_html__('Algo deu errado.', 'meutema'),
            'notice_can_install_required'     => _n_noop(
                'O tema requer o seguinte plugin: %1$s.',
                'O tema requer os seguintes plugins: %1$s.',
                'meutema'
            ),
            'notice_can_install_recommended'  => _n_noop(
                'O tema recomenda o seguinte plugin: %1$s.',
                'O tema recomenda os seguintes plugins: %1$s.',
                'meutema'
            ),
            'notice_cannot_install'           => _n_noop(
                'Desculpe, você não tem permissão para instalar plugins %s.',
                'Desculpe, você não tem permissão para instalar plugins %s.',
                'meutema'
            ),
            'notice_ask_to_update'            => _n_noop(
                'Os seguintes plugins estão fora de data. Faça uma atualização para melhores recursos e segurança:',
                'Os seguintes plugins estão fora de data. Faça uma atualização para melhores recursos e segurança:',
                'meutema'
            ),
            'notice_ask_to_update_maybe'      => _n_noop(
                'Há uma nova versão de %1$s disponível: %2$s',
                'Há novas versões de %1$s disponíveis: %2$s',
                'meutema'
            ),
            'return'                          => esc_html__('Voltar para Instalador de Plugins', 'meutema'),
            'plugin_activated'                => esc_html__('Plugin ativado com sucesso.', 'meutema'),
            'complete'                        => esc_html__('Todos os plugins foram instalados e ativados com sucesso. %s', 'meutema'),
            'contact_admin'                   => esc_html__('Entre em contato com o administrador do site, se você achar que isto é um erro.', 'meutema'),
        ),
    );

    // Se TGMPA estiver disponível, use-o. Caso contrário, apenas armazene as recomendações.
    if (function_exists('tgmpa')) {
        tgmpa($plugins, $config);
    }
}
// Somente registrar se estiver no admin
if (is_admin()) {
    add_action('tgmpa_register', 'meutema_register_required_plugins');
}

/**
 * Adicionar links de compatibilidade com plugins de pagamento
 */
function meutema_add_plugin_recommendations() {
    if (!is_admin()) {
        return;
    }

    $plugins_info = array(
        'Mercado Pago' => 'https://www.mercadopago.com.br',
        'PagSeguro' => 'https://www.pagseguro.com.br',
        'WooPayments' => 'https://woocommerce.com/products/woo-payments/',
        'LiteSpeed Cache' => 'https://litespeedtech.com/products/cache/',
    );

    // Hook para adicionar informações sobre plugins recomendados
    // Pode ser usado em customizers ou admin pages
}
add_action('admin_init', 'meutema_add_plugin_recommendations');

// Carregar configurações de plugins recomendados
require_once get_template_directory() . '/inc/plugins-config.php';

// Carregar dashboard widget do admin
if (is_admin()) {
    require_once get_template_directory() . '/inc/admin-dashboard.php';
}