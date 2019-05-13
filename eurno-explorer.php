<?php
/*
 * The Eurno Explorer
 *
 * A plugin to allow web owners  to easily display information regarding EOS based blockchains. Create's a shortcode which can be used to display the contents of 'include-me.php'.
 *
 * @link              https://github.com/Eurno/eurno-explorer
 * @since             v1.0.0-beta1.0.0
 * @package           eurno_explorer
 *
 * @wordpress-plugin
 * Plugin Name:       Eurno Explorer
 * Plugin URI:        https://github.com/eurno/eurno-explorer
 * Description:       Adds the shortcode [eurno_explorer] to Wordpress. This allows you to display information about the EOS, Enumivo and Telos blockchains, and allows your visitors to check their balance on each chain.
 * Version:           v1.0.0-beta1.0.4
 * Author:            Paul Singh
 * Author URI:        https://eurno.org
 * License:           MIT
 * License URI:       https://github.com/Eurno/eurno-explorer/blob/master/LICENSE
 */
include_once "admin-settings.php";
function check_bootstrap() {
  global $wp_styles;
  $srcs = array_map('basename', (array) wp_list_pluck($wp_styles->registered, 'src') );
  if ( in_array('bootstrap.css', $srcs) || in_array('bootstrap.min.css', $srcs)  ) {
    wp_deregister_style('bootstrap');
    wp_enqueue_style('bootstrap', plugin_dir_url(__FILE__) . 'css/bootstrap.min.css' );
  } else {
    wp_enqueue_style('bootstrap', plugin_dir_url(__FILE__) . 'css/bootstrap.min.css' );
  }
}
add_action('wp_enqueue_scripts', 'check_bootstrap', 99999);
function explorer_script(){
  global $post;
if( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'eurno_explorer') ) {
  wp_enqueue_style('font-awesome', plugin_dir_url(__FILE__) . 'css/all.min.css');
  wp_enqueue_style('eurno-style', plugin_dir_url(__FILE__) . 'css/eurno-explorer.css');
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
}
add_action('wp_enqueue_scripts', 'explorer_script');
function enu_explorer_shortcode() {
  ob_start();
  include_once "eurno_include_file.php";
  begin_eurno_explorer();
  $eurno_explorer_output = ob_get_clean();
  return $eurno_explorer_output;
}
add_shortcode( 'eurno_explorer', 'enu_explorer_shortcode' );
?>
