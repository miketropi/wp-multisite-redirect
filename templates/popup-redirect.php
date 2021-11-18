<?php 
/**
 * Popup redirect template 
 * 
 */

if(count($sites) == 0) return;
?>
<div class="wmr-popup-select-site-redirect">
  <div class="wmr-popup-select-site-redirect__inner">
    <h2 class="wmr-popup-select-site-redirect__title"><?php _e('Select store', 'wmr') ?></h2>
    <div class="wmr-popup-select-site-redirect__desc">
      <span class="wmr-popup-select-site-redirect__desc-icon">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 329.942 329.942" style="enable-background:new 0 0 329.942 329.942;" xml:space="preserve"> <path id="XMLID_16_" d="M329.208,126.666c-1.765-5.431-6.459-9.389-12.109-10.209l-95.822-13.922l-42.854-86.837 c-2.527-5.12-7.742-8.362-13.451-8.362c-5.71,0-10.925,3.242-13.451,8.362l-42.851,86.836l-95.825,13.922 c-5.65,0.821-10.345,4.779-12.109,10.209c-1.764,5.431-0.293,11.392,3.796,15.377l69.339,67.582L57.496,305.07 c-0.965,5.628,1.348,11.315,5.967,14.671c2.613,1.899,5.708,2.865,8.818,2.865c2.387,0,4.784-0.569,6.979-1.723l85.711-45.059 l85.71,45.059c2.208,1.161,4.626,1.714,7.021,1.723c8.275-0.012,14.979-6.723,14.979-15c0-1.152-0.13-2.275-0.376-3.352 l-16.233-94.629l69.339-67.583C329.501,138.057,330.972,132.096,329.208,126.666z"/> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>
      </span>
      <div class="wmr-popup-select-site-redirect__desc-entry"></div>
    </div>
    <!-- <a href="javascript:" class="__close"><?php _e('× Close', 'wmr') ?></a> -->
    <div class="site-options">
      <?php foreach($sites as $index => $site) {?> 
      <div class="__site-option">
        <label>
          <input 
            type="radio" 
            name="wmr_site_id" 
            value="<?php echo $site['site']; ?>" 
            data-site-url="<?php echo get_site_url($site['site']); ?>"
            data-site-cc="<?php echo implode(',', explode(PHP_EOL, $site['country_code'])); ?>" 
            data-popup-title="<?php echo $site['popup_title']; ?>" 
            data-popup-desc="<?php echo $site['popup_desc']; ?>" 
            data-popup-button-text="<?php echo $site['go_button_text']; ?>" 
            />
          <div class="__option-entry">
            <img src="<?php echo $site['site_logo'] ?>" alt="#<?php echo $site['title'] ?>">
            <h4><?php echo $site['title'] ?></h4>
          </div>
        </label>
      </div>  
      <?php } ?>
    </div>
    <a class="wmr-go-button" href="javascript:" ><?php _e('Go store', 'wmr') ?></a>
  </div>
</div> <!-- .wmr-popup-select-site-redirect -->