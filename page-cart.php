<?php
/**
 * Template Name: Página de Carrinho
 * Template Post Type: page
 */

get_header();
?>

<main class="section woocommerce-page">
    <div class="container">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <?php
                $is_cart_empty = false;

                if (class_exists('WooCommerce') && function_exists('WC')) {
                    $woocommerce_instance = WC();

                    if (
                        $woocommerce_instance &&
                        isset($woocommerce_instance->cart) &&
                        $woocommerce_instance->cart &&
                        method_exists($woocommerce_instance->cart, 'is_empty')
                    ) {
                        $is_cart_empty = $woocommerce_instance->cart->is_empty();
                    }
                }
                ?>

                <article class="cart-page-shell<?php echo $is_cart_empty ? ' cart-page-shell-empty' : ''; ?>">
                    <header class="cart-page-header section-subtitle">
                        <h1 class="section-title cart-page-title"><?php the_title(); ?></h1>
                    </header>

                    <div class="woocommerce-content cart-page-content">
                        <?php
                        if (class_exists('WooCommerce') && $is_cart_empty) {
                            $shop_url = function_exists('wc_get_page_permalink')
                                ? call_user_func('wc_get_page_permalink', 'shop')
                                : (function_exists('home_url') ? call_user_func('home_url', '/shop/') : '/shop/');

                            echo '<div class="cart-empty-state">';
                            echo '<p class="cart-empty-message">Seu carrinho está vazio no momento.</p>';
                            echo '<a class="button wc-forward" href="' . esc_url($shop_url) . '">Ver produtos</a>';
                            echo '</div>';
                        } elseif (class_exists('WooCommerce')) {
                            if (function_exists('do_shortcode')) {
                                echo call_user_func('do_shortcode', '[woocommerce_cart]');
                            }
                        } else {
                            echo '<div class="card"><p>WooCommerce não está ativo.</p></div>';
                        }
                        ?>
                    </div>
                </article>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</main>

<?php
get_footer();
