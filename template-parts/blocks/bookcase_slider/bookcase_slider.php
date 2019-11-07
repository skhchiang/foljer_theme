<?php
// Create id attribute allowing for custom "anchor" value.
$id = 'events-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'bookcase';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and passing defaults.
// repeater fields:  bookcase-list
$background_color = get_field('background_color');
// $args = array(
//     'post-type' => 'events',
//     'orderby' => 'name',
//     'order' => 'ASC',
//     'post_status' => 'publish'
// );
// $events = new WP_Query($args);

$events = get_posts([
    'post_type' => 'events',
    'post_status' => 'publish',
    // 'numberposts' => -1,
    'order'    => 'ASC'
  ]);
?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> row">

    <!-- Top gallery -->
    <div class="<?php echo esc_attr($className); ?>-slides col-12">
        <ul class="bookcase-slider">
            <!-- Use 'Array' for ACF Gallery field -->
            <?php
            if ($events) :
        foreach ($events as $event) {
                $event_image = get_field('image', $event);
                $event_title = $event->post_title; 
                $event_start_date = get_field('start_date', $event);
                $event_end_date = get_field('end_date', $event);
                $event_link = get_field('link', $event);

                //Write function to split date string into days and months
                $event_start_month = substr(explode_date($event_start_date, 'month'),0,3);
                $event_end_month = substr(explode_date($event_end_date, 'month'),0,3);
                $event_start_day = explode_date($event_start_date, 'day');
                $event_end_day = explode_date($event_end_date, 'day');
      
                ?>
            <li>
                <div class="<?php echo esc_attr($className); ?>-date">
                    <p class="<?php echo esc_attr($className); ?>-day">
                        <?php echo $event_start_day; 
                if ($event_end_day && $event_start_day != $event_end_day) {
                    echo "-$event_end_day";
                }
                ?>
                    </p>
                    <p class="<?php echo esc_attr($className); ?>-month">
                        <?php echo $event_start_month; 
                if ($event_end_month && $event_start_month != $event_end_month)  {
                    //If Start and end months are the same, do not show end month
                    echo "-$event_end_month";
                }
                ?>
                    </p>
                </div>
                <a class="<?php echo esc_attr($className); ?>-name" href="<?php echo $event_link ?>">
                    <p><?php echo $event_title ?></p>
            </a>
                <a href="<?php echo $event_link ?>" class="<?php echo esc_attr($className); ?>-image">  
                    <?php echo wp_get_attachment_image( $event_image );?>
            </a>

            </li>
            <?php
         } 
        endif
         ?>

        </ul>
    </div>
    <!-- END Top gallery -->

    <!-- Get all brands via async ajax api call to lkf_template/v2/brands and /wp-json/acf/v3/media/ 
    , build items by using post ID to assign thumbnails from /wp-json/acf/v3/media/{ID} -->



    <style type="text/css">
        #<?php echo $id;

        ?> {
            background: <?php echo $background_color ?>;
        }
    </style>

    <script type="text/javascript">
        (function ($) {
            $(document).ready(function () {
                $('#<?php echo esc_attr( $id ); ?>').find('.bookcase-slider:not(.slick-initialized)')
            .slick({
                    arrows: false,
                    centerMode: true,
                    centerPadding: '50px',
                    speed: 800,
                    slidesToShow: 5,
                    slidesToScroll: 1,
                    draggable: false,
                    responsive: [{
                        breakpoint: 640,
                        // breakpoint: 375,
                        settings: {
                            arrows: true,
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