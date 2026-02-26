<?php
/**
 * WooCommerce Template
 * 
 * This template is used for WooCommerce pages
 * For shop/archive, use archive-product.php
 * 
 * @package Arqfy
 */

get_header();
?>

<main class="section woocommerce-page">
    <div class="container">
        <div class="woocommerce-content">
            <?php
            if (function_exists('woocommerce_content')) {
                call_user_func('woocommerce_content');
            }
            ?>
        </div>
    </div>
</main>

<?php
get_footer();
