<?php
get_header();
?>

<main class="section woocommerce-page">
    <div class="container">
        <?php
        if (function_exists('woocommerce_content')) {
            call_user_func('woocommerce_content');
        }
        ?>
    </div>
</main>

<?php
get_footer();
