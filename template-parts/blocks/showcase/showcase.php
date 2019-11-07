<?php
// Create id attribute allowing for custom "anchor" value.
$id = 'showcase-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'showcase';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}


// Load values and assing defaults.
$heading = get_field('heading') ?: 'Your heading here';
$image = get_field('image');
$background_color = get_field('background_color');
$text_color = get_field('text_color');
$content = get_field('content') ?: 'Your content here';
$mainlogo = get_field('main_logo');
//Repeater
//$partners = partners



?>


<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> row">
    <div class="<?php echo esc_attr($className); ?>-image col-12">
        <!-- ACF Image field must use Image ID -->
        <?php echo wp_get_attachment_image( $image, 'large', false ); ?>
    </div>
    <div class="<?php echo esc_attr($className); ?>-logo col-12">
        <?php echo wp_get_attachment_image( $mainlogo, 'medium', false ); ?>
    </div>
    <blockquote class="<?php echo esc_attr($className); ?>-blockquote col-12">
        <h1 class="<?php echo esc_attr($className); ?>-text"><?php echo $heading; ?></h1>
        <p class="<?php echo esc_attr($className); ?>-content"><?php echo $content; ?></p>
    </blockquote>
    <?php if( have_rows('partners') ): ?>

    <div class="<?php echo esc_attr($className); ?>-partners col-12">

        <?php while( have_rows('partners') ): the_row(); 
    $partlogo = get_sub_field('part_logo');
    
    ?>
        <div class="<?php echo esc_attr($className); ?>-partlogo">
            <?php echo wp_get_attachment_image( $partlogo, 'thumbnail', false ); ?>
        </div>
        <?php endwhile; ?>

    </div>
    <?php endif; ?>

    <style type="text/css">
        #<?php echo $id;

        ?> {
            background: <?php echo $background_color;
            ?>;
            color: <?php echo $text_color;
            ?>;
        }
    </style>
</section>