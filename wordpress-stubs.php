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

            public function __construct() {
                $this->cart = new class {
                    public function get_cart_contents_count() {
                        return 0;
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