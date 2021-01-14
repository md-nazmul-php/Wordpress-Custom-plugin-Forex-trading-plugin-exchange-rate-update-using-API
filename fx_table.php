<?php
/*
Plugin Name: FX Table
Plugin URI: https://www.upwork.com/fl/mdnazmul62
Version: 1.3.0
Description: This plugin use to build custom forex currency conversion data table.
Author: Md Nazmul
Author URI: https://deshonlineit.com
License: GPL3.0
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





//create table while plugin activate

function crudOperationsTable() {
  global $wpdb;
  $charset_collate = $wpdb->get_charset_collate();

  $table_name_long = $wpdb->prefix . 'longfxdatatable';


  $sql = "CREATE TABLE `wp_longfxdatatable` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `currencyname` varchar(220) DEFAULT NULL,
 `action` varchar(220) DEFAULT NULL,
 `price_entry` FLOAT(9,4) DEFAULT NULL,
 `stop_loss` FLOAT(9,4) DEFAULT NULL,
 `price_target` FLOAT(9,4) DEFAULT NULL,
 `day_in_market` int(11) DEFAULT NULL,
 `position_size` int(11) DEFAULT NULL,
 PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1
  ";

  if ($wpdb->get_var("SHOW TABLES LIKE '$table_name_long'") != $table_name_long) {
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
  }


// 2nd table create short term

$table_name_short = $wpdb->prefix . 'shortfxdatatable';


  $sql = "CREATE TABLE `wp_shortfxdatatable` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `currencyname` varchar(220) DEFAULT NULL,
 `action` varchar(220) DEFAULT NULL,
 `price_entry` FLOAT(9,4) DEFAULT NULL,
 `stop_loss` FLOAT(9,4) DEFAULT NULL,
 `price_target` FLOAT(9,4) DEFAULT NULL,
 `day_in_market` int(11) DEFAULT NULL,
 `position_size` int(11) DEFAULT NULL,
 PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1
  ";

  if ($wpdb->get_var("SHOW TABLES LIKE '$table_name_short'") != $table_name_short) {
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
  }



$table_name_update = $wpdb->prefix . 'lfxtabledtupdate';


  $sql = "CREATE TABLE `wp_lfxtabledtupdate` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `date_long` varchar(220) DEFAULT NULL,

 PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1
  ";

  if ($wpdb->get_var("SHOW TABLES LIKE '$table_name_update'") != $table_name_update) {
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
  }




  $table_name_update = $wpdb->prefix . 'sfxtabledtupdate';


  $sql = "CREATE TABLE `wp_sfxtabledtupdate` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `date_short` varchar(220) DEFAULT NULL,

 PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1
  ";

  if ($wpdb->get_var("SHOW TABLES LIKE '$table_name_update'") != $table_name_update) {
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
  }


}


//adding admin menu page and sub page

add_action('admin_menu', 'addAdminPageContent');
function addAdminPageContent() {
  add_menu_page('fx protfolio', 'Forex Protfolio', 'manage_options' ,__FILE__, 'crudAdminPage','dashicons-portfolio');

  add_submenu_page(__FILE__, 'Long Term', 'Long terms ', 'manage_options', __FILE__.'/long', 'longcrudAdminPage');
  add_submenu_page(__FILE__, 'Short Term', 'Short terms', 'manage_options', __FILE__.'/short', 'shortcrudAdminPage');

}



//page function main
function crudAdminPage() {

 ?>
 <div id="adminmain" style="padding: 20% 30%;" >
    <button id="btnadmin"><a href="admin.php?page=fx-table/main.php/long">Long terms Table</a></button>

      <button id="btnadmin"><a href="admin.php?page=fx-table/main.php/short">Short terms Table</a></button>

 </div>
     
       <?php


}



//page function for long terms
function longcrudAdminPage() {

include "long_terms_action.php";

include "long_terms_date.php";


}


//page function short terms
function shortcrudAdminPage() {

include "short_terms_action.php";
include "short_terms_date.php";


}

//Includes
include_once('long_table_show.php');
include_once('short_table_show.php');
