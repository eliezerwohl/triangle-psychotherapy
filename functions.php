<?php 
	if( function_exists('acf_add_options_page') ) {

	acf_add_options_page();
	
	}
	function add_jquery() {
    wp_enqueue_script( 'jquery' );
  }    
	add_action('init', 'add_jquery');
		require_once('wp-bootstrap-navwalker.php');
	register_nav_menus( array(
	  'primary' => __( 'Primary Menu', 'triangle' ),
	) );
	add_action( 'wp_default_scripts', 'move_jquery_into_footer' );

function move_jquery_into_footer( $wp_scripts ) {

    if( is_admin() ) {
        return;
    }

    $wp_scripts->add_data( 'jquery', 'group', 1 );
    $wp_scripts->add_data( 'jquery-core', 'group', 1 );
    $wp_scripts->add_data( 'jquery-migrate', 'group', 1 );
}

function get_ach($atts) {
   $ach = include 'ach.php';
}
function get_ach_test($atts) {
   $ach = include 'ach-test.php';
}

add_shortcode('ach', 'get_ach');
add_shortcode('ach-test', 'get_ach_test');
?>