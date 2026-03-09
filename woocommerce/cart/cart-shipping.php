<?php
defined('ABSPATH') || exit;
?>
<tr class="woocommerce-shipping-totals shipping">
    <th><?php echo wp_kses_post($package_name); ?></th>
    <td data-title="<?php echo esc_attr($package_name); ?>">
        <?php if (!empty($available_methods) && is_array($available_methods)) : ?>
            <ul id="shipping_method" class="woocommerce-shipping-methods">
                <?php foreach ($available_methods as $method) : ?>
                    <li>
                        <?php if (1 < count($available_methods)) : ?>
                            <input type="radio" name="shipping_method[<?php echo esc_attr($index); ?>]" data-index="<?php echo esc_attr($index); ?>" id="shipping_method_<?php echo esc_attr($index); ?>_<?php echo esc_attr(sanitize_title($method->id)); ?>" value="<?php echo esc_attr($method->id); ?>" class="shipping_method" <?php checked($method->id, $chosen_method); ?> />
                        <?php else : ?>
                            <input type="hidden" name="shipping_method[<?php echo esc_attr($index); ?>]" data-index="<?php echo esc_attr($index); ?>" id="shipping_method_<?php echo esc_attr($index); ?>_<?php echo esc_attr(sanitize_title($method->id)); ?>" value="<?php echo esc_attr($method->id); ?>" class="shipping_method" />
                        <?php endif; ?>

                        <label for="shipping_method_<?php echo esc_attr($index); ?>_<?php echo esc_attr(sanitize_title($method->id)); ?>"><?php echo wp_kses_post(wc_cart_totals_shipping_method_label($method)); ?></label>
                    </li>
                <?php endforeach; ?>
            </ul>

            <?php if (is_cart()) : ?>
                <p class="woocommerce-shipping-destination">
                    <?php
                    if ($formatted_destination) {
                        printf(esc_html__('Shipping to %s.', 'woocommerce'), '<strong>' . esc_html($formatted_destination) . '</strong>');
                    } elseif ($customer->get_calculated_shipping()) {
                        esc_html_e('Shipping options will be updated during checkout.', 'woocommerce');
                    } else {
                        esc_html_e('Enter your address to view shipping options.', 'woocommerce');
                    }
                    ?>
                </p>
            <?php endif; ?>

            <?php if ($show_package_details) : ?>
                <p class="woocommerce-shipping-contents"><?php echo esc_html($package_details); ?></p>
            <?php endif; ?>

            <?php if ($show_shipping_calculator) : ?>
                <?php woocommerce_shipping_calculator(); ?>
            <?php endif; ?>

        <?php elseif (!$has_calculated_shipping || !$formatted_destination) : ?>
            <?php if (is_cart() && 'no' === get_option('woocommerce_enable_shipping_calc')) : ?>
                <?php esc_html_e('Shipping costs are calculated during checkout.', 'woocommerce'); ?>
            <?php else : ?>
                <?php woocommerce_shipping_calculator(); ?>
            <?php endif; ?>
        <?php else : ?>
            <?php esc_html_e('No shipping options available.', 'woocommerce'); ?>
        <?php endif; ?>
    </td>
</tr>
