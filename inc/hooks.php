<?php 
/**
 * hooks 
 */

function wmr_popup_select_location_template() {
  $sites = carbon_get_network_option(SITE_ID_CURRENT_SITE, 'wmr_sites_redirect_rule', 'carbon_fields_container_wmr_network_container');

  set_query_var('sites', array_filter($sites, function($site) {
    return $site['enable'] == 1;
  }));

  load_template(WMR_DIR . '/templates/popup-redirect.php');
}

add_action('wp_footer', 'wmr_popup_select_location_template');