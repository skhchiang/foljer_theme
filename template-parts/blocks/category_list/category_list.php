<?php
// Create id attribute allowing for custom "anchor" value.
$id = 'catlist-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'catlist';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and passing defaults.
// repeater fields: catgallery, catlist-list
$background_color = get_field('background_color');

$args =  array(
    'orderby' => 'name',
    'order' => 'ASC'
);
$categories = get_categories($args);

?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> row">

    <!-- Top gallery -->
    <div class="<?php echo esc_attr($className); ?>-slides col-12">
        <ul class="catlist-slider">
            <!-- Use 'Array' for ACF Gallery field -->
            <?php         
        foreach ($categories as $category) {
                $cat_image = get_field('cat_img', $category);?>
            <li>
                <div class="<?php echo esc_attr($className); ?>-image">
                    <?php echo wp_get_attachment_image( $cat_image );?>
                </div>
                <div class="<?php echo esc_attr($className); ?>-name">
                    <p><?php echo $category->name; ?></p>
                </div>
            </li>
            <?php
         } ?>

        </ul>
    </div>
    <!-- END Top gallery -->

    <!-- Get all brands via async ajax api call to lkf_template/v2/brands and /wp-json/acf/v3/media/ 
    , build items by using post ID to assign thumbnails from /wp-json/acf/v3/media/{ID} -->


    <script type="text/javascript">
        (function ($) {
            $(document).ready(function () {
                $.get(my_ajax_obj.ajax_url, {
                    _ajax_nonce: my_ajax_obj.nonce,
                    action: "async_load_brands"
                }, function(response) {
                    var res_data = response.data;
                    console.log(res_data);
                })
            });
        })(jQuery);
    </script>

    <style type="text/css">
        #<?php echo $id;

        ?> {
            background: <?php echo $background_color ?>;
        }
    </style>

    <script type="text/javascript">
        (function ($) {
            $(document).ready(function () {
                $('#<?php echo esc_attr( $id ); ?>').find('.catlist-slider:not(.slick-initialized)').slick({
                    arrows: false,
                    dots: false,
                    infinite: true,
                    speed: 800,
                    slidesToShow: 4,
                    slidesToScroll: 4,
                    draggable: false,
                    responsive: [{
                        breakpoint: 640,
                        // breakpoint: 375,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            draggable: true,
                            dots: false,
                            arrows: false
                        }
                    }]
                });
            });
        })(jQuery);
    </script>
</section>