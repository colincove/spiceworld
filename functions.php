<?php 

function cove_scripts_basic()
{
    // Register the script like this for a theme:
    wp_register_script( 'cove-general-script', get_template_directory_uri() . '/js/script.js' );
 
    // For either a plugin or a theme, you can then enqueue the script:
    wp_enqueue_script( 'cove-general-script' );
}
add_action( 'wp_enqueue_scripts', 'cove_scripts_basic' );
function cove_styles_with_the_lot()
{
    // Register the style like this for a theme:
    wp_register_style( 'spiceworld-admin-style', get_template_directory_uri() . 'admin/css/style.css', array(), '20120208', 'all' );
	wp_register_style( 'spiceworld-general-style', get_template_directory_uri() . 'admin/css/style.css', array(), '20120208', 'all' );
 
    // For either a plugin or a theme, you can then enqueue the style:
    wp_enqueue_style( 'spiceworld-admin-style' );
    wp_enqueue_style( 'spiceworld-general-style' );    
}
add_action( 'wp_enqueue_scripts', 'cove_styles_with_the_lot' );

?>