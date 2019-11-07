<?php
// Create id attribute allowing for custom "anchor" value.
$id = 'about-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'about';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and passing defaults.
// repeater field = partners
$image = get_field('image');
$bg = wp_get_attachment_image( $image, 'large_high', false );
        if (isMobile()) {
            $bg = wp_get_attachment_image( $image, 'large', false );
        }
$logo = get_field('main_logo');
$headline = get_field('headline') ?: 'About headline';
$description = get_field('description') ?: 'About description';
$background_color = get_field('background_color');
$text_color = get_field('text_color');
?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> row">
<div class="<?php echo esc_attr($className); ?>-image">
<?php echo $bg ?>
</div>
<div class="<?php echo esc_attr($className); ?>-logo">
    <?  wp_get_attachment_image( $logo, 'large', false ); ?>
    </div>
    <blockquote class="<?php echo esc_attr($className); ?>-content col-12 row">
        <h1 class="<?php echo esc_attr($className); ?>-header col-12"><?php echo $headline ?></h1>
        <p class="<?php echo esc_attr($className); ?>-content col-12"><?php echo $content; ?></p>
    </blockquote>
<?php if ( have_rows('partners')) : ?>

<div class="<?php echo esc_attr($className); ?>-partners row">

<?php

while ( have_rows('partners')): the_row();
$partner_logo = get_sub_field('partner_logo');
?>

<div class="<?php echo esc_attr($className); ?>-partner col-6 col-sm-4">
        <?php echo wp_get_attachment_image( $partner_logo, 'thumbnail', false ); ?>
</div>

<?php endwhile; ?>

    </div> <!-- end partners -->
    <?php endif; ?>
    <style type="text/css">
        #<?php echo $id; ?> {
            background: <?php echo $background_color ?>;
        }

        #<?php echo $id; ?> .<?php echo esc_attr($className); ?>-header, .<?php echo esc_attr($className); ?>-content {
            color: <?php echo $text_color ?>;
            }
    </style>
    </section>