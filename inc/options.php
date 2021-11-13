<?php 
use Carbon_Fields\Container;
use Carbon_Fields\Field;

function wmr_network_register_options() {
  if(!is_multisite()) return;

  Container::make('network', 'wmr_network_container', __('Location Redirect', 'wmr') )
    ->add_fields([
      Field::make( 'text', 'crb_title' ) ,
      Field::make( 'checkbox', 'crb_disable_feature' )
    ]);
}

add_action('carbon_fields_register_fields', 'wmr_network_register_options');