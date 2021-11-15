/**
 * Main javascript 
 * 
 */

import './scss/main.scss';
const ExpiredStorage = require('expired-storage');

;((w, $) => {
  'use strict';
  const expiredStorage = new ExpiredStorage();
  const __expireTime = (60 * 60) * 24; // 1 day 

  w.wmr_redirect_url = null;
  w.wmr_site_id = expiredStorage.getItem('wmr_site_id');

  const updateSiteOption = () => {
    $('input[name=wmr_site_id]').on('change', function(e) {
      let value = this.value;
      let url = $(`input[name=wmr_site_id][value=${value}]`).data('site-url');
      
      w.wmr_redirect_url = url;
      w.wmr_site_id = value;

      if(w.wmr_redirect_url) {
        $('.wmr-go-button').addClass('__active');
      } else {
        $('.wmr-go-button').removeClass('__active');
      }
    })
  }

  const goSite = () => {
    $('.wmr-go-button').on('click', function(e) {
      e.preventDefault();

      expiredStorage.setItem('wmr_site_id', w.wmr_site_id, __expireTime);
      window.location.href = w.wmr_redirect_url;
    })
  }

  const popupDisplay = (show) => {
    if(show == true) {
      $('body').addClass('__wmr-show');
    } else {
      $('body').removeClass('__wmr-show');
    }
  }

  const closePopup = () => {
    $('.wmr-popup-select-site-redirect .__close').on('click', e => {
      e.preventDefault();
      popupDisplay(false);
    })
  }

  const autoSelect = () => {
    let $inputSelect = null;
    $('input[name=wmr_site_id]').each(function() {
      let $input = $(this);
      let cc = $input.data('site-cc');

      if(cc.split(',').includes(PHP_DATA?.my_location?.countryCode)) {
        $inputSelect = $input;
        return false;
      }
    })

    if($inputSelect) {
      $inputSelect.prop('checked', true);
    } else {
      $('input[name=wmr_site_id][data-site-cc="*"]').prop('checked', true);
    }
  }

  const Ready = () => {
    if(!w.wmr_site_id || PHP_DATA.blog_id != w.wmr_site_id) {
      popupDisplay(true);
    }

    closePopup();
    updateSiteOption()
    goSite();

    autoSelect();

    $('input[name=wmr_site_id]:checked').trigger('change');
  }

  $(Ready);
})(window, jQuery)