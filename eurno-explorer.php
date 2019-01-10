<?php
/*
 * The Eurno Explorer
 *
 * A plugin to allow web owners  to easily display information regarding EOS based blockchains. Create's a shortcode which can be used to display the contents of 'include-me.php'.
 *
 * @link              https://github.com/Eurno/eurno-explorer
 * @since             1.0.0
 * @package           eurno_explorer
 *
 * @wordpress-plugin
 * Plugin Name:       Eurno Explorer
 * Plugin URI:        https://github.com/eurno/eurno-explorer
 * Description:       A plugin which allows users to explore their accounts on the EOS blockchain and some of its sister chains.
 * Version:           1.0.0
 * Author:            Paul Singh
 * Author URI:        https://eurno.org
 * License:           MIT
 * License URI:       https://github.com/Eurno/eurno-explorer/blob/master/LICENSE
 */
include_once "admin-settings.php";
include_once "eurno_include_file.php";
function check_bootstrap() {
  global $wp_styles;
  $srcs = array_map('basename', (array) wp_list_pluck($wp_styles->registered, 'src') );
  if ( in_array('bootstrap.css', $srcs) || in_array('bootstrap.min.css', $srcs)  ) {
  } else {
    wp_enqueue_style('bootstrap', plugin_dir_url(__FILE__) . 'css/bootstrap.min.css' );
  }
}
add_action('wp_enqueue_scripts', 'check_bootstrap', 99999);
function explorer_script(){
  wp_register_script('qrcode', plugin_dir_url(__FILE__) . 'js/qrcodegen.js', '1.4.0', false);
  wp_enqueue_script('qrcode');
  wp_register_script('renderjson', plugin_dir_url(__FILE__) . 'js/renderjson.js', '1.4.0', false);
  wp_enqueue_script('renderjson');
  wp_register_script('explorer', plugin_dir_url(__FILE__) . 'js/scripts.js', '1.0.0', false);
  wp_enqueue_script('explorer');
  wp_localize_script('explorer', 'myScript', array(
      'pluginsUrl' => plugins_url('', __FILE__),
      'eurnoExplorer' => get_option('eurno_explorer'),
  ));
}
add_action('wp_enqueue_scripts', 'explorer_script');
function enu_explorer_shortcode() {
  return begin_eurno_explorer();
}
add_shortcode( 'eurno_explorer', 'enu_explorer_shortcode' );
?>
