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
            data-site-cc="<?php echo implode(',', explode(PHP_EOL, $site['country_code'])); ?>" />
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