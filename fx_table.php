<?php
/*
Plugin Name: FX Table
Plugin URI: https://www.upwork.com/fl/mdnazmul62
Version: 1.0
Description: This plugin use to build custom forex currency conversion data table.
Author: Md Nazmul
Author URI: https://www.upwork.com/fl/mdnazmul62
License: GPL2
*/


register_activation_hook( __FILE__, 'crudOperationsTable');
define( 'PLUGIN_DIR', dirname(__FILE__).'/' );  


function add_my_stylesheet() {
    wp_enqueue_style( 'style', plugins_url( '/css/backendStyle.css', __FILE__ ) );
 
}

add_action('admin_print_styles', 'add_my_stylesheet');



//frontend style
function enqueue_related_pages_scripts_and_styles(){
        wp_enqueue_style('related-styles', plugins_url('/css/frontendStyle.css', __FILE__));
       
    }
add_action('wp_enqueue_scripts','enqueue_related_pages_scripts_and_styles');

//Includes
include_once('main.php');
include_once('long_table_show.php');
include_once('short_table_show.php');