<?php
/**
 * Helpers
 */

function wmr_get_all_sites() {
  $result = [];
  $sites = get_sites(['public' => 1]);
  if(count($sites) == 0) return $result;

  foreach($sites as $index => $site) {
    $result[$site->blog_id] = $site; // site_url($site->path);
  }

  return $result;
}

function wmr_site_options() {
  $sites = wmr_get_all_sites();
  $options = [
    '' => __('Select site URL', 'wmr'),
  ];

  if(count($sites) == 0) return $options;

  foreach($sites as $id => $site) {
    $options[$id] = site_url($site->path);
  }

  return $options;
}

function wmr_get_location_by_ip($ip = '') {
  $api_mockup = "https://pro.ip-api.com/php/{YOUR_API}?key=KNUyyUdvyg4pq49";
  $endpoint = str_replace('{YOUR_API}', $ip, $api_mockup);
  $data = @unserialize(file_get_contents($endpoint));
  return $data['status'] === 'success' ? $data : false;
}

function wmr_get_client_ip() {
  // return '100.42.240.4'; # canada
  // return  '14.224.130.20'; # vn

  $ipaddress = '';
  if (isset($_SERVER['HTTP_CLIENT_IP']))
    $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
  else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
    $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
  else if(isset($_SERVER['HTTP_X_FORWARDED']))
    $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
  else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
    $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
  else if(isset($_SERVER['HTTP_FORWARDED']))
    $ipaddress = $_SERVER['HTTP_FORWARDED'];
  else if(isset($_SERVER['REMOTE_ADDR']))
    $ipaddress = $_SERVER['REMOTE_ADDR'];
  else
    $ipaddress = 'UNKNOWN';
  return explode(',', $ipaddress)[0];
}

add_action('init', function() {
  // echo '<pre>';
  // print_r(get_sites());
  // echo site_url("/us-store/");
  // echo '</pre>';
});

//get site code
function wmr_get_site_code(){
  $HTTP_HOST = $_SERVER['HTTP_HOST'];
  $https = $_SERVER['HTTPS'] == 'on' ? 'https://':'http://';
  $host_name = $https.$HTTP_HOST.'/';
  $site_url = site_url();
  return str_replace($host_name,'',$site_url);
}
