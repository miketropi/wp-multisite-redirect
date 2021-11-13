<?php 
/**
 * Plugin Name:       		WordPress Multisite Redirect
 * Description:       		...
 * Version:					      1.0.0
 * Requires at least: 		4.9
 * Requires PHP:      		7.2
 * Author:            		Beplus
 * Author URI:        		#
 * License:           		GPL v2 or later
 * License URI:       		https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       		wmr
 * Domain Path:       		/languages
 */

/**
 * load vendor 
 */
require(__DIR__ . '/vendor/autoload.php');

{
  /**
   * Define 
   */
  define('WMR_VERSION', '1.0.0');
  define('WMR_URI', plugin_dir_url(__FILE__));
  define('WMR_DIR', plugin_dir_path(__FILE__));
}

{
  /**
   * Include
   */
  require(WMR_DIR . '/inc/static.php');
  require(WMR_DIR . '/inc/helpers.php');
  require(WMR_DIR . '/inc/hooks.php');
  require(WMR_DIR . '/inc/ajax.php');
  require(WMR_DIR . '/inc/options.php');
}

{
  /**
   * Boot
   */
  function wmr_boot() {
    \Carbon_Fields\Carbon_Fields::boot();
  }
  
  add_action('after_setup_theme', 'wmr_boot');
}
