<?php 
/**
 * Static 
 * 
 */

function wmr_enqueue_scripts() {
  wp_enqueue_style('wmr-style', WMR_URI . '/dist/css/main.wmr.bundle.css', false, WMR_VERSION);
  wp_enqueue_script('wmr-script', WMR_URI . '/dist/main.wmr.bundle.js', ['jquery'], WMR_VERSION, true);

  $clientIP = wmr_get_client_ip();
  
  wp_localize_script('wmr-script', 'WMR_PHP_DATA', [
    'ajax_url' => admin_url('admin-ajax.php'),
    'blog_id' => get_current_blog_id(),
    'my_location' => wmr_get_location_by_ip($clientIP),
    'site_options' => carbon_get_network_option(SITE_ID_CURRENT_SITE, 'wmr_sites_redirect_rule', 'carbon_fields_container_wmr_network_container'),
    'lang' => []
  ]);
}

add_action('wp_enqueue_scripts', 'wmr_enqueue_scripts');