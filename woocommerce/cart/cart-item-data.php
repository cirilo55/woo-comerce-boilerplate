<?php
defined('ABSPATH') || exit;

if (empty($item_data)) {
    return;
}
?>

<dl class="variation">
    <?php foreach ($item_data as $data) : ?>
        <?php
        $key   = !empty($data['key']) ? wp_kses_post($data['key']) : '';
        $value = !empty($data['display']) ? wp_kses_post($data['display']) : '';

        if ($key === '' && $value === '') {
            continue;
        }

        $class = 'variation-' . sanitize_title($key !== '' ? $key : 'item');
        ?>
        <dt class="<?php echo esc_attr($class); ?>"><?php echo wp_kses_post($key); ?>:</dt>
        <dd class="<?php echo esc_attr($class); ?>"><?php echo wp_kses_post($value); ?></dd>
    <?php endforeach; ?>
</dl>
