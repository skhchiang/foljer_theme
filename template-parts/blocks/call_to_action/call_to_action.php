<?php
// Create id attribute allowing for custom "anchor" value.
$id = 'cta-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'cta';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assing defaults.
$headline = get_field('headline') ?: 'CTA Headline';
$tagline = get_field('tagline') ?: 'CTA Tagline';
$background_color = get_field('background_color');
$link = get_field('link');
$button = get_field('btn_text');
?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> row">
    <blockquote class="<?php echo esc_attr($className); ?>-content col-12 row">
        <h1 class="<?php echo esc_attr($className); ?>-header col-12"><?php echo $headline ?></h1>
        <p class="<?php echo esc_attr($className); ?>-content col-12"><?php echo $content; ?></p>
    </blockquote>
    <a class="<?php echo esc_attr($className); ?>-button col-12" href="<?php echo $link?>">
        <button>
            <?php echo $button ?>
        </button>
    </a>

</section>