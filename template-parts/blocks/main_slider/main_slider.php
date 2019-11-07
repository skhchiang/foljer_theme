<?php
// Create id attribute allowing for custom "anchor" value.
$id = 'slider-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'slider';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
// Load values and assing defaults.
//Repeater field = slides
$dot_color = get_field('dot_color');
$autoplay = get_field('autoplay');
$autoplay_speed = get_field('autoplay_speed');
$fade = get_field('fade');
?>


<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> col-12">
<div class="main-slider">
    <?php if( have_rows('slides') ): ?>


    <?php while( have_rows('slides') ): the_row(); 
    $title = get_sub_field('title');
    $image = get_sub_field('image');
    $link = get_sub_field('link');
    $bg = wp_get_attachment_image( $image, 'full_hd', false );
        if (isMobile()) {
            $bg = wp_get_attachment_image( $image, 'large', false );
        }
    ?>
    <div class="slider-slide">
        <?php $link?'<a href="' . $link . '">':'' ?>
            <div class="slider-image">
                <?php echo $bg ?>
            </div>
            <div class="slider-overlay">
            </div>
            <div class="slider-title">
                <?php echo $title ?>
            </div>
            <?php $link?'</a>':'' ?>

    </div>
    <?php endwhile; ?>


    <?php endif; ?>
</div>
    <style type="text/css">
        #<?php echo $id; ?> .slick-dots{

                background: <?php echo $dot_color;
                ?>;
        }
        #<?php echo $id; ?> .slick-dots li {
            list-style: none;
        }
        #<?php echo $id; ?> .slick-dots li button:before {
                    content: '•';
                }
                #<?php echo $id; ?> .slick-dots li button {
                    font-size: 0;
                }
    </style>

    <script type="text/javascript">
        (function ($) {
            $(document).ready(function () {
                $('#<?php echo esc_attr( $id ); ?>').find('.main-slider:not(.slick-initialized)').slick({
                    fade: <?php echo $fade ? $fade : "false"; ?> ,
                    arrows : false,
                    dots: true,
                    infinite: true,
                    speed: 500,
                    autoplay: <?php echo $autoplay ? $autoplay : "false"; ?> ,
                    autoplaySpeed : <?php echo $autoplay_speed ? $autoplay_speed : 4000; ?> ,
                    slidesToShow : 1,
                    slidesToScroll: 1,
                    focusOnSelect: true,
                    draggable: false,
                    //slide: '.slick-slide',
                    responsive: [{
                        breakpoint: 640,
                        // breakpoint: 375,
                        settings: {
                            draggable: true,
                            dots: true,
                            arrows: false
                        }
                    }]
                });
            });
          
        })(jQuery);
    </script>
</section>