<?php
/**
 * Static
 *
 */

function wmr_enqueue_scripts() {
  wp_enqueue_style('wmr-style', WMR_URI . '/dist/css/main.wmr.bundle.css', false, WMR_VERSION);
  wp_enqueue_script('wmr-script', WMR_URI . '/dist/main.wmr.bundle.js', ['jquery'], WMR_VERSION, true);

  $clientIP = wmr_get_client_ip();
  $site_options = carbon_get_network_option(SITE_ID_CURRENT_SITE, 'wmr_sites_redirect_rule', 'carbon_fields_container_wmr_network_container');

  $countries_eu = array();
  $countries_uk = array('GB');
  if(class_exists('WC_Countries')){
      $wc_countries = new WC_Countries();
      $countries_obj = $wc_countries->get_allowed_countries();
      foreach ($countries_obj as $key => $value) {
        if($key != 'GB'){
           $countries_eu[] = $key;
        }
      }
  }

  wp_localize_script('wmr-script', 'WMR_PHP_DATA', [
      'ajax_url' => admin_url('admin-ajax.php'),
      'blog_id' => get_current_blog_id(),
      'my_location' => wmr_get_location_by_ip($clientIP),
      'site_options' => array_map(function($site) {
        $site['site_url'] = get_site_url($site['site']);
        return $site;
      }, $site_options),
      'lang' => [],
      'site_code' => wmr_get_site_code(),
      'allowed_countries_eu' => $countries_eu,
      'allowed_countries_uk' => $countries_uk
  ]);
}

add_action('wp_enqueue_scripts', 'wmr_enqueue_scripts');
