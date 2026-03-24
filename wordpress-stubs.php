<?php

if (!function_exists('get_header')) {
    function get_header($name = null, $args = array()) {}
}

if (!function_exists('get_footer')) {
    function get_footer($name = null, $args = array()) {}
}

if (!function_exists('language_attributes')) {
    function language_attributes($doctype = 'html') {}
}

if (!function_exists('bloginfo')) {
    function bloginfo($show = '') {}
}

if (!function_exists('wp_head')) {
    function wp_head() {}
}

if (!function_exists('body_class')) {
    function body_class($class = '') {}
}

if (!function_exists('wp_body_open')) {
    function wp_body_open() {}
}

if (!function_exists('esc_url')) {
    function esc_url($url, $protocols = null, $_context = 'display') {
        return (string) $url;
    }
}

if (!function_exists('home_url')) {
    function home_url($path = '', $scheme = null) {
        return (string) $path;
    }
}

if (!function_exists('esc_html')) {
    function esc_html($text) {
        return (string) $text;
    }
}

if (!function_exists('wp_date')) {
    function wp_date($format, $timestamp = null, $timezone = null) {
        return '';
    }
}

if (!function_exists('wp_footer')) {
    function wp_footer() {}
}

if (!function_exists('have_posts')) {
    function have_posts() {
        return false;
    }
}

if (!function_exists('the_post')) {
    function the_post() {}
}

if (!function_exists('the_permalink')) {
    function the_permalink() {}
}

if (!function_exists('the_title')) {
    function the_title($before = '', $after = '', $display = true) {}
}

if (!function_exists('the_excerpt')) {
    function the_excerpt() {}
}

if (!function_exists('add_theme_support')) {
    function add_theme_support($feature, ...$args) {}
}

if (!function_exists('add_action')) {
    function add_action($hook_name, $callback, $priority = 10, $accepted_args = 1) {}
}

if (!function_exists('do_action')) {
    function do_action($hook_name, ...$args) {}
}

if (!function_exists('apply_filters')) {
    function apply_filters($hook_name, $value, ...$args) {
        return $value;
    }
}

if (!function_exists('wp_enqueue_style')) {
    function wp_enqueue_style($handle, $src = '', $deps = array(), $ver = false, $media = 'all') {}
}

if (!function_exists('wp_enqueue_script')) {
    function wp_enqueue_script($handle, $src = '', $deps = array(), $ver = false, $args = array()) {}
}

if (!function_exists('get_stylesheet_uri')) {
    function get_stylesheet_uri() {
        return '';
    }
}

if (!function_exists('wp_get_theme')) {
    function wp_get_theme($stylesheet = null, $theme_root = null) {
        return new class {
            public function get($header) {
                return '';
            }
        };
    }
}

if (!function_exists('wc_get_page_permalink')) {
    function wc_get_page_permalink($page) {
        return '';
    }
}

if (!function_exists('wc_get_cart_url')) {
    function wc_get_cart_url() {
        return '';
    }
}

if (!function_exists('woocommerce_content')) {
    function woocommerce_content() {}
}

if (!function_exists('WC')) {
    function WC() {
        return new class {
            public $cart;
            public $customer;
            public $countries;

            public function __construct() {
                $this->cart = new class {
                    public function get_cart_contents_count() {
                        return 0;
                    }

                    public function get_cart() {
                        return array();
                    }

                    public function get_coupons() {
                        return array();
                    }

                    public function needs_shipping() {
                        return false;
                    }

                    public function show_shipping() {
                        return false;
                    }

                    public function get_fees() {
                        return array();
                    }

                    public function display_prices_including_tax() {
                        return false;
                    }

                    public function get_tax_totals() {
                        return array();
                    }

                    public function get_product_price($product) {
                        return '';
                    }

                    public function get_product_subtotal($product, $quantity) {
                        return '';
                    }

                    public function get_cart_subtotal() {
                        return '';
                    }

                    public function is_empty() {
                        return true;
                    }
                };

                $this->customer = new class {
                    public function has_calculated_shipping() {
                        return false;
                    }
                };

                $this->countries = new class {
                    public function tax_or_vat() {
                        return '';
                    }
                };
            }
        };
    }
}

if (!class_exists('WP_Query')) {
    class WP_Query {
        public function __construct($args = array()) {}
        public function have_posts() { return false; }
        public function the_post() {}
    }
}

if (!function_exists('has_post_thumbnail')) {
    function has_post_thumbnail($post = null) {
        return false;
    }
}

if (!function_exists('the_post_thumbnail')) {
    function the_post_thumbnail($size = 'post-thumbnail', $attr = '') {}
}

if (!function_exists('get_the_excerpt')) {
    function get_the_excerpt($post = null) {
        return '';
    }
}

if (!function_exists('wp_kses_post')) {
    function wp_kses_post($html) {
        return (string) $html;
    }
}

if (!function_exists('wp_trim_words')) {
    function wp_trim_words($text = '', $num_words = 55, $more = null) {
        return (string) $text;
    }
}

if (!function_exists('wp_reset_postdata')) {
    function wp_reset_postdata() {}
}

if (!function_exists('admin_url')) {
    function admin_url($path = '', $scheme = 'admin') {
        return '';
    }
}

if (!function_exists('get_template_directory_uri')) {
    function get_template_directory_uri() {
        return '';
    }
}

if (!function_exists('get_template_directory')) {
    function get_template_directory() {
        return '';
    }
}

if (!function_exists('register_nav_menus')) {
    function register_nav_menus($locations = array()) {}
}

if (!function_exists('__')) {
    function __($text, $domain = 'default') {
        return (string) $text;
    }
}

if (!function_exists('esc_html__')) {
    function esc_html__($text, $domain = 'default') {
        return (string) $text;
    }
}

if (!function_exists('_n_noop')) {
    function _n_noop($singular, $plural, $domain = null) {
        return array(
            'singular' => (string) $singular,
            'plural' => (string) $plural,
            'domain' => $domain,
        );
    }
}

if (!function_exists('is_admin')) {
    function is_admin() {
        return false;
    }
}

if (!function_exists('is_shop')) {
    function is_shop() {
        return false;
    }
}

if (!function_exists('is_product_category')) {
    function is_product_category($term = '') {
        return false;
    }
}

if (!function_exists('is_product_tag')) {
    function is_product_tag($term = '') {
        return false;
    }
}

if (!function_exists('get_search_query')) {
    function get_search_query($escaped = true) {
        return '';
    }
}

if (!function_exists('is_user_logged_in')) {
    function is_user_logged_in() {
        return false;
    }
}

if (!function_exists('has_nav_menu')) {
    function has_nav_menu($location) {
        return false;
    }
}

if (!function_exists('wp_nav_menu')) {
    function wp_nav_menu($args = array()) {
        return '';
    }
}

if (!function_exists('wp_list_pages')) {
    function wp_list_pages($args = array()) {
        return '';
    }
}

if (!function_exists('esc_attr')) {
    function esc_attr($text) {
        return (string) $text;
    }
}

if (!function_exists('esc_html_e')) {
    function esc_html_e($text, $domain = 'default') {
        echo (string) $text;
    }
}

if (!function_exists('esc_attr_e')) {
    function esc_attr_e($text, $domain = 'default') {
        echo (string) $text;
    }
}

if (!function_exists('checked')) {
    function checked($checked, $current = true, $display = true) {
        $result = ((string) $checked === (string) $current) ? 'checked="checked"' : '';

        if ($display) {
            echo $result;
        }

        return $result;
    }
}

if (!function_exists('selected')) {
    function selected($selected, $current = true, $display = true) {
        $result = ((string) $selected === (string) $current) ? 'selected="selected"' : '';

        if ($display) {
            echo $result;
        }

        return $result;
    }
}

if (!function_exists('sanitize_title')) {
    function sanitize_title($title) {
        return strtolower(trim((string) $title));
    }
}

if (!function_exists('sanitize_html_class')) {
    function sanitize_html_class($classname, $fallback = '') {
        return preg_replace('/[^A-Za-z0-9_-]/', '', (string) $classname) ?: (string) $fallback;
    }
}

if (!function_exists('_n')) {
    function _n($single, $plural, $number, $domain = 'default') {
        return ((int) $number === 1) ? (string) $single : (string) $plural;
    }
}

if (!function_exists('wp_kses')) {
    function wp_kses($string, $allowed_html, $allowed_protocols = array()) {
        return (string) $string;
    }
}

if (!function_exists('post_password_required')) {
    function post_password_required($post = null) {
        return false;
    }
}

if (!function_exists('get_the_password_form')) {
    function get_the_password_form($post = 0) {
        return '';
    }
}

if (!function_exists('the_ID')) {
    function the_ID() {}
}

if (!function_exists('get_the_ID')) {
    function get_the_ID() {
        return 0;
    }
}

if (!function_exists('is_page')) {
    function is_page($page = '') {
        return false;
    }
}

if (!function_exists('is_page_template')) {
    function is_page_template($template = '') {
        return false;
    }
}

if (!function_exists('is_active_sidebar')) {
    function is_active_sidebar($index) {
        return false;
    }
}

if (!function_exists('dynamic_sidebar')) {
    function dynamic_sidebar($index = 1) {
        return false;
    }
}

if (!function_exists('get_search_form')) {
    function get_search_form($args = array()) {
        return '';
    }
}

if (!function_exists('wc_get_product')) {
    function wc_get_product($the_product = false, $deprecated = array()) {
        return new class {
            public function is_visible() { return true; }
            public function is_on_sale() { return false; }
            public function is_in_stock() { return true; }
            public function get_price_html() { return ''; }
            public function get_name() { return ''; }
            public function get_sku() { return ''; }
            public function get_image($size = 'woocommerce_thumbnail', $attr = array(), $placeholder = true) { return ''; }
            public function get_permalink($cart_item = array()) { return ''; }
            public function exists() { return true; }
            public function get_max_purchase_quantity() { return 0; }
            public function is_sold_individually() { return false; }
            public function backorders_require_notification() { return false; }
            public function is_on_backorder($qty_in_cart = 0) { return false; }
            public function get_rating_count() { return 0; }
            public function get_average_rating() { return 0; }
        };
    }
}

if (!function_exists('wc_product_class')) {
    function wc_product_class($class = '', $product = null, $post_id = null) {
        echo 'class="' . esc_attr((string) $class) . '"';
    }
}

if (!function_exists('wc_get_template_part')) {
    function wc_get_template_part($slug, $name = '') {
        return '';
    }
}

if (!function_exists('wc_get_product_category_list')) {
    function wc_get_product_category_list($product_id, $sep = ', ', $before = '', $after = '') {
        return '';
    }
}

if (!function_exists('wc_review_ratings_enabled')) {
    function wc_review_ratings_enabled() {
        return true;
    }
}

if (!function_exists('wc_get_rating_html')) {
    function wc_get_rating_html($rating, $count = 0) {
        return '';
    }
}

if (!function_exists('wc_get_formatted_cart_item_data')) {
    function wc_get_formatted_cart_item_data($cart_item, $flat = false) {
        return '';
    }
}

if (!function_exists('woocommerce_quantity_input')) {
    function woocommerce_quantity_input($args = array(), $product = null, $echo = true) {
        $html = '';

        if ($echo) {
            echo $html;
        }

        return $html;
    }
}

if (!function_exists('wc_get_cart_remove_url')) {
    function wc_get_cart_remove_url($cart_item_key) {
        return '';
    }
}

if (!function_exists('wc_coupons_enabled')) {
    function wc_coupons_enabled() {
        return true;
    }
}

if (!function_exists('wc_get_checkout_url')) {
    function wc_get_checkout_url() {
        return '';
    }
}

if (!function_exists('wc_ship_to_billing_address_only')) {
    function wc_ship_to_billing_address_only() {
        return false;
    }
}

if (!function_exists('wc_tax_enabled')) {
    function wc_tax_enabled() {
        return false;
    }
}

if (!function_exists('wc_format_datetime')) {
    function wc_format_datetime($date, $format = '') {
        return '';
    }
}

if (!function_exists('wc_get_account_orders_columns')) {
    function wc_get_account_orders_columns() {
        return array();
    }
}

if (!function_exists('wc_get_account_orders_actions')) {
    function wc_get_account_orders_actions($order) {
        return array();
    }
}

if (!function_exists('wc_get_account_downloads_columns')) {
    function wc_get_account_downloads_columns() {
        return array();
    }
}

if (!function_exists('wc_get_endpoint_url')) {
    function wc_get_endpoint_url($endpoint, $value = '', $permalink = '') {
        return '';
    }
}

if (!function_exists('wc_get_loop_prop')) {
    function wc_get_loop_prop($prop, $default = '') {
        return $default;
    }
}

if (!function_exists('wc_logout_url')) {
    function wc_logout_url($redirect = '') {
        return '';
    }
}

if (!function_exists('wc_get_order_status_name')) {
    function wc_get_order_status_name($status) {
        return (string) $status;
    }
}

if (!function_exists('wc_get_order')) {
    function wc_get_order($the_order = false) {
        return new class {
            public function get_item_count() { return 0; }
            public function get_item_count_refunded() { return 0; }
            public function get_status() { return ''; }
            public function get_view_order_url() { return ''; }
            public function get_order_number() { return ''; }
            public function get_date_created() {
                return new class {
                    public function date($format) { return ''; }
                };
            }
            public function get_formatted_order_total() { return ''; }
        };
    }
}

if (!function_exists('woocommerce_page_title')) {
    function woocommerce_page_title($echo = true) {
        $title = '';

        if ($echo) {
            echo $title;
        }

        return $title;
    }
}

if (!function_exists('woocommerce_product_loop')) {
    function woocommerce_product_loop() {
        return false;
    }
}

if (!function_exists('woocommerce_result_count')) {
    function woocommerce_result_count() {}
}

if (!function_exists('woocommerce_catalog_ordering')) {
    function woocommerce_catalog_ordering() {}
}

if (!function_exists('woocommerce_product_loop_start')) {
    function woocommerce_product_loop_start($echo = true) {
        $html = '';

        if ($echo) {
            echo $html;
        }

        return $html;
    }
}

if (!function_exists('woocommerce_product_loop_end')) {
    function woocommerce_product_loop_end($echo = true) {
        $html = '';

        if ($echo) {
            echo $html;
        }

        return $html;
    }
}

if (!function_exists('woocommerce_breadcrumb')) {
    function woocommerce_breadcrumb($args = array()) {}
}

if (!function_exists('woocommerce_form_field')) {
    function woocommerce_form_field($key, $args, $value = null) {}
}

if (!function_exists('woocommerce_shipping_calculator')) {
    function woocommerce_shipping_calculator($params = array()) {}
}

if (!function_exists('wp_nonce_field')) {
    function wp_nonce_field($action = -1, $name = '_wpnonce', $referer = true, $display = true) {
        $field = '';

        if ($display) {
            echo $field;
        }

        return $field;
    }
}

if (!function_exists('get_option')) {
    function get_option($option, $default = false) {
        return $default;
    }
}

if (!function_exists('wp_get_current_user')) {
    function wp_get_current_user() {
        return (object) array(
            'display_name' => '',
            'first_name'   => '',
            'last_name'    => '',
            'user_email'   => '',
        );
    }
}

if (!function_exists('has_action')) {
    function has_action($hook_name, $callback = false) {
        return false;
    }
}

if (!function_exists('wp_strip_all_tags')) {
    function wp_strip_all_tags($text, $remove_breaks = false) {
        return strip_tags((string) $text);
    }
}

if (!function_exists('wc_cart_totals_subtotal_html')) {
    function wc_cart_totals_subtotal_html() {}
}

if (!function_exists('wc_cart_totals_coupon_label')) {
    function wc_cart_totals_coupon_label($coupon, $echo = true) {
        $label = '';

        if ($echo) {
            echo $label;
        }

        return $label;
    }
}

if (!function_exists('wc_cart_totals_coupon_html')) {
    function wc_cart_totals_coupon_html($coupon) {}
}

if (!function_exists('wc_cart_totals_shipping_method_label')) {
    function wc_cart_totals_shipping_method_label($method) {
        return '';
    }
}

if (!function_exists('wc_cart_totals_shipping_html')) {
    function wc_cart_totals_shipping_html() {}
}

if (!function_exists('wc_cart_totals_fee_html')) {
    function wc_cart_totals_fee_html($fee) {}
}

if (!function_exists('wc_cart_totals_taxes_total_html')) {
    function wc_cart_totals_taxes_total_html() {}
}

if (!function_exists('wc_cart_totals_order_total_html')) {
    function wc_cart_totals_order_total_html() {}
}

if (!function_exists('is_cart')) {
    function is_cart() {
        return false;
    }
}