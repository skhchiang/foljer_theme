<?php
/**
 * Understrap functions and definitions
 *
 * @package understrap
 */

global $query;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$understrap_includes = array(
	'/theme-settings.php',                  // Initialize theme default settings.
	'/setup.php',                           // Theme setup and custom theme supports.
	'/widgets.php',                         // Register widget area.
	'/enqueue.php',                         // Enqueue scripts and styles.
	'/template-tags.php',                   // Custom template tags for this theme.
	'/pagination.php',                      // Custom pagination for this theme.
	'/hooks.php',                           // Custom hooks.
	'/extras.php',                          // Custom functions that act independently of the theme templates.
	'/customizer.php',                      // Customizer additions.
	'/custom-comments.php',                 // Custom Comments file.
	'/jetpack.php',                         // Load Jetpack compatibility file.
	'/class-wp-bootstrap-navwalker.php',    // Load custom WordPress nav walker.
	'/editor.php',                          // Load Editor functions.
	'/deprecated.php',                      // Load deprecated functions.
);

foreach ( $understrap_includes as $file ) {
	$filepath = locate_template( 'inc' . $file );
	if ( ! $filepath ) {
		trigger_error( sprintf( 'Error locating /inc%s for inclusion', $file ), E_USER_ERROR );
	}
	require_once $filepath;
}


wp_deregister_script('jquery');
wp_enqueue_script( 'jquery', get_template_directory_uri() . '/js/jquery-3.4.1.min.js', null, null, true);
wp_enqueue_script( 'slick', get_template_directory_uri() . '/js/slick.min.js', array('jquery'), '1.8.1', true);

function register_acf_block_types() {

    // register a block.
    acf_register_block_type(array(
        'name'              => 'showcase',
        'title'             => __('Showcase'),
        'description'       => __('A showcase block that links to a page'),
        'render_template'   => 'template-parts/blocks/showcase/showcase.php',
        'category'          => 'formatting',
        'icon'              => 'admin-comments',
        'keywords'          => array( 'showcase', 'feature' ),
	));
	acf_register_block_type(array(
        'name'              => 'news',
        'title'             => __('News'),
        'description'       => __('A news block that lists news items in a row'),
        'render_template'   => 'template-parts/blocks/news/news.php',
        'category'          => 'formatting',
        'icon'              => 'admin-comments',
        'keywords'          => array( 'news', 'row', 'multiple' ),
	));
	acf_register_block_type(array(
        'name'              => 'call_to_action',
        'title'             => __('Call to Action'),
        'description'       => __('A call to action block to convert new customers'),
        'render_template'   => 'template-parts/blocks/call_to_action/call_to_action.php',
        'category'          => 'formatting',
        'icon'              => 'admin-comments',
        'keywords'          => array( 'call to action'),
	));
	acf_register_block_type(array(
        'name'              => 'main_slider',
        'title'             => __('Main Slider'),
        'description'       => __('A landing page slider for news/articles/ads'),
        'render_template'   => 'template-parts/blocks/main_slider/main_slider.php',
        'category'          => 'formatting',
        'icon'              => 'admin-comments',
        'keywords'          => array( 'slider', 'carousel', 'gallery', 'landing'),
	));
	acf_register_block_type(array(
        'name'              => 'about',
        'title'             => __('About'),
        'description'       => __('A description block to introduce an individual/company'),
        'render_template'   => 'template-parts/blocks/about/about.php',
        'category'          => 'formatting',
        'icon'              => 'admin-comments',
        'keywords'          => array( 'about', 'description', 'about us'),
	));
	acf_register_block_type(array(
        'name'              => 'category_list',
        'title'             => __('Category List'),
        'description'       => __('A category list with dropdown'),
        'render_template'   => 'template-parts/blocks/category_list/category_list.php',
        'category'          => 'formatting',
        'icon'              => 'admin-comments',
        'keywords'          => array( 'categories', 'list', 'brands'),
	));
	acf_register_block_type(array(
        'name'              => 'bookcase_slide',
        'title'             => __('Bookcase Slider'),
        'description'       => __('A slider for displaying information quickly'),
        'render_template'   => 'template-parts/blocks/bookcase_slider/bookcase_slider.php',
        'category'          => 'formatting',
        'icon'              => 'admin-comments',
        'keywords'          => array( 'categories', 'list', 'brands'),
    ));
}

// Prints to console
function debug_to_console( $data ) {
    $output = $data;
    if ( is_array( $output ) )
        $output = implode( ',', $output);

    echo "<script>console.log( '$output' );</script>";
}

// Check if function exists and hook into setup.
if( function_exists('acf_register_block_type') ) {
    add_action('acf/init', 'register_acf_block_types');
}

function klf_acf_input_admin_footer() {
 
	?>
<script type="text/javascript">
	(function ($) {

		acf.add_filter('color_picker_args', function (args, $field) {

			// add the hexadecimal codes here for the colors you want to appear as swatches
			args.palettes = ['#2facbf', '#474747']

			// return colors
			return args;

		});

	})(jQuery);
</script>
<?php
	}
	 
	add_action('acf/input/admin_footer', 'klf_acf_input_admin_footer');

	function isMobile() {
		return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
	}

add_image_size( 'full_hd', 1920, 0, array( 'center', 'center' ) );
add_image_size( 'medium_rect', 600, 400, true );
add_image_size( 'large_high', 1024, 0, false );
// add_image_size( 'name', width, height, array('center','center'));

function explode_date($input, $var) {
    // Current date format: d/F/Y
    // Check ACF custom fields for correct format
    if ($input && is_string($input)) {
        $date_array = explode('/', $input);

        switch($var) {
            case 'month' :
                $date_var = $date_array[1];
                // debug_to_console($date_var);
                
                break;
            case 'day' :
                $date_var = $date_array[0];
                // debug_to_console($date_var);
                break;
            case 'year' :
                $date_var = $date_array[2];
                break;                            
        }
        return $date_var;
    }
};



//register Brands Custom Post Type to REST API
add_action('rest_api_init', 'register_brands_api' ); 

function register_brands_api() {
	register_rest_route('lkf_template/v2', '/brands', array(
		'methods' => 'GET',
		'callback' => 'get_brands'
	));
};

function get_brands() {
		$args   = array(
            'post_status'   => 'publish',
			'post_type'         => 'brands',
			'orderby' 			=> 'name',
			'order' 			=> 'DESC'
        );
        $the_query = new WP_Query( $args );
        $field = "thumbnail";
        // $posts = get_posts($args);
        $postsad = array();

        foreach($the_query as $query) {
            $posts[$field] = get_field($field,$query);

        }


		if(empty($posts)) {
			return new WP_Error('empty_posttype', 'there is nothing in this post type', array('status' => 404));
        }
        
        
        wp_send_json_success($posts, 200 );
		// $response = new WP_Rest_Response($posts);
		// $response->set_status(200);

		// return $response;
};


// add_action( 'wp_enqueue_scripts', 'my_enqueue' );
// function my_enqueue() {
//     $nonce = wp_create_nonce( 'guest_nonce' );  
//     wp_localize_script( 'custom', 'my_ajax_obj', array(
//        'ajax_url' => admin_url( 'admin-ajax.php' ),
//        'nonce'    => $nonce
//     ) );
// }



    // add_action("wp_ajax_async_load_brands", "async_load_brands");
    // add_action("wp_ajax_nopriv_async_load_brands", "async_load_brands");

    // function ajax_load_brands() {
    //     check_ajax_referer( 'guest_nonce' );
    //     $args = array(
    //         'posts_per_page' => -1,
    //         'post_type' => 'brands',
    //     )

    //     $brand_query = new WP_Query($args);

    //     wp_die();
    // }


    // function ajax_get_guest_data() {
    //     check_ajax_referer( 'guest_nonce' );
    //     $secret = $_POST['secret'];
    //     $args = array(
    //         'posts_per_page' => -1,
    //         'post_type'     => 'guest',
    //         'meta_key'      => 'access_code',
    //         'meta_value'    =>  $secret
    //     );
    //     $the_query = new WP_Query( $args );
    //     $id_to_get = $the_query->post->ID;
    //     $fields = ['access_code','invited_cities','hong_kong_vip','taipei_vip','rsvp_tpe','adult_guests_tpe','children_guests_tpe','rsvp_hk','adult_guests_hk','children_guests_hk','rsvp_fr','adult_guests_fr','children_guests_fr','language'];
    //     $collect = array();
    //     foreach ($fields as $field) {
    //          $collect[$field] = get_field($field, $id_to_get );
    //    }
    //    $collect['title'] = $the_query->post->post_name;
    //     wp_send_json_success($collect, 200 );
    // }