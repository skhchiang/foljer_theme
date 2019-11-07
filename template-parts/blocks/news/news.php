<?php
// Create id attribute allowing for custom "anchor" value.
$id = 'news-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'news';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}


// Load values and passing defaults.
$heading = get_field('heading') ?: 'Your heading here';
$background_color = get_field('background_color');
$text_color = get_field('text_color');
// Repeating field name = news_item

?>


<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> row">

    <?php if( $heading ): ?>
    <h1 class="<?php echo esc_attr($className); ?>-header col-12"><?php echo $heading ?></h1>
    <?php endif; ?>

    <!-- Slider start -->
    <?php if( have_rows('news_item') ): ?>

    <div class="news-slider col-12">

        <?php while( have_rows('news_item') ): the_row(); 

		// vars
        $headline = get_sub_field('headline') ?: 'Headline goes here';
        $image = get_sub_field('image');
        $content = get_sub_field('content') ?: 'Content goes here';
        $link = get_sub_field('link');

		?>

        <div class="<?php echo esc_attr($className); ?>-item">
            <div class="<?php echo esc_attr($className); ?>-image">
                <?php if( $link ): ?>
                <a href="<?php echo $link; ?>">
                    <?php endif; ?>
                    <?php echo wp_get_attachment_image( $image, 'medium', false ); ?>
                    <?php if( $link ): ?>
                </a>
                <?php endif; ?>
            </div>
            <blockquote class="<?php echo esc_attr($className); ?>-blockquote">
                <?php if( $link ): ?>
                <a href="<?php echo $link; ?>">
                    <?php endif; ?>
                    <h1 class="<?php echo esc_attr($className); ?>-headline"><?php echo $headline; ?></h1>
                    <?php if( $link ): ?>
                </a>
                <?php endif; ?>
                <p class="<?php echo esc_attr($className); ?>-content"><?php echo $content; ?></p>
            </blockquote>
</div>

        <?php endwhile; ?>

</div>
    <!-- Slider end -->
    <?php endif; ?>

    <style type="text/css">
        #<?php echo $id;?> 
        {
            background: <?php echo $background_color;
            ?>;
           
        }

        #<?php echo $id;?> .<?php echo esc_attr($className); ?>-headline, .<?php echo esc_attr($className); ?>-content {
            color: <?php echo $text_color;
            ?>;
        }
        .slick-dots li button:before {
                    content: '•';
                    font-size: 22px;
                }
    </style>

<script type="text/javascript">
        (function ($) {
            $(document).ready(function () {
                $('#<?php echo esc_attr( $id ); ?>').find('.news-slider:not(.slick-initialized)').slick({
                    fade: <?php echo $fade ? $fade : "false"; ?> ,
                    arrows : true,
                    dots: false,
                    infinite: true,
                    speed: 500,
                    autoplay: <?php echo $autoplay ? $autoplay : "false"; ?> ,
                    autoplaySpeed : <?php echo $autoplay_speed ? $autoplay_speed : 4000; ?> ,
                    slidesToShow : 3,
                    slidesToScroll: 3,
                    focusOnSelect: true,
                    draggable: false,
                    responsive: [
                        {
                        breakpoint: 99999,
                        settings: "unslick"
                        },
                        {
                        breakpoint: 640,
                        // breakpoint: 375,
                        settings: {
                            slidesToShow : 1,
                    slidesToScroll: 1,
                            draggable: true,
                            dots: false,
                            arrows: true
                        }
                    }]
                });
            });
          
        })(jQuery);
    </script>
</div>