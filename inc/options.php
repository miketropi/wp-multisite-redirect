<?php 
use Carbon_Fields\Container;
use Carbon_Fields\Field;

function wmr_network_register_options() {
  if(!is_multisite()) return;

  Container::make('network', 'wmr_network_container', __('Location Redirect', 'wmr') )
    ->set_icon('dashicons-block-default')
    ->add_fields([
      Field::make('complex', 'wmr_sites_redirect_rule', __('Site Redirect Rule', 'wmr'))
        ->add_fields([
          Field::make('checkbox', 'enable', __('Enable', 'wmr') )
            ->set_default_value(true),
          Field::make('image', 'site_logo', __('Site logo', 'wmr'))
            ->set_help_text(__('Select site logo', 'wmr'))
            ->set_value_type('url')
            ->set_conditional_logic([
              [
                'field' => 'enable',
                'value' => true
              ]
            ]),
          Field::make('text', 'title', __('Title', 'wmr'))
            ->set_help_text(__('Type site title', 'wmr'))
            ->set_conditional_logic([
              [
                'field' => 'enable',
                'value' => true
              ]
            ]),
          Field::make('select', 'site', __('Site', 'wmr'))
            ->add_options('wmr_site_options')
            ->set_required(true)
            ->set_help_text(__('Select site url.', 'wmr'))
            ->set_conditional_logic([
              [
                'field' => 'enable',
                'value' => true
              ]
            ]),
          Field::make('textarea', 'country_code', __('Country Code', 'wmr') )
            ->set_rows(4)
            ->set_required(true)
            ->set_help_text(__('Type country code. (Enter each code on a new line)', 'wmr'))
            ->set_conditional_logic([
              [
                'field' => 'enable',
                'value' => true
              ]
            ]),
          Field::make('separator', '__separator_1', __('Message', 'wmr')),
          Field::make('text', 'popup_title', __('Popup Title', 'wmr'))
            ->set_help_text(__('Type your popup title', 'wmr'))
            ->set_default_value(__('Select store', 'wmr')),
          Field::make('textarea', 'popup_desc', __('Popup Description', 'wmr'))
            ->set_help_text(__('Type your popup description.')),
          Field::make('text', 'go_button_text', __('Button Text', 'wmr'))
            ->set_help_text(__('Type your button text', 'wmr'))
            ->set_default_value(__('Go store', 'wmr'))
        ])
        ->set_collapsed(true)
        ->set_header_template('
        <% let __wpmsites = '. wp_json_encode(wmr_site_options()) .' %>
        <% if (site) { %>
          <%- __wpmsites[site] %>
        <% } %>
        ')
    ]);
}

add_action('carbon_fields_register_fields', 'wmr_network_register_options');