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
      let $input = $(`input[name=wmr_site_id][value=${value}]`);
      let url = $input.data('site-url');
      let popupTitle = $input.data('popup-title');
      let popupDesc = $input.data('popup-desc');
      let popupButtonText = $input.data('popup-button-text');

      w.wmr_redirect_url = url;
      w.wmr_site_id = value;

      if(w.wmr_redirect_url) {
        $('.wmr-go-button').addClass('__active');
      } else {
        $('.wmr-go-button').removeClass('__active');
      }

      updatePopupContent(popupTitle, popupDesc, popupButtonText);
    })
  }

  const updatePopupContent = (title, description, buttonText) => {
    $('.wmr-popup-select-site-redirect__title').html(title);
    $('.wmr-go-button').html(buttonText);

    if(!description) {
      $('.wmr-popup-select-site-redirect__desc').stop(true, true).slideUp(0);
    } else {
      $('.wmr-popup-select-site-redirect__desc-entry').html(description);
      $('.wmr-popup-select-site-redirect__desc').stop(true, true).slideDown('slow');
    }
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

      if(cc.split(',').includes(WMR_PHP_DATA?.my_location?.countryCode)) {
        $inputSelect = $input;
        return false;
      }
    })

    if($inputSelect) {
      $inputSelect.prop('checked', true);
      $inputSelect.parents('.__site-option').addClass('__active');
    } else {
      $('input[name=wmr_site_id][data-site-cc="*"]').prop('checked', true);
      $('input[name=wmr_site_id][data-site-cc="*"]').parents('.__site-option').addClass('__active');
    }
  }

  const getHashValue = (hash, key) => {
    var matches = hash.match(new RegExp(key+'=([^&]*)'));
    return matches ? matches[1] : null;
  }

  const switchSiteForce = (hash) => {
    let siteID = getHashValue(hash, 'wmr_id');
    let s = WMR_PHP_DATA.site_options.find(site => {
      return site.site == siteID
    })

    expiredStorage.setItem('wmr_site_id', s.site, __expireTime);
    w.location.href = s.site_url;
  }



  const isCheckLocationCurrent = () => {
    if(WMR_PHP_DATA.site_code != ''){
      let countryCodeSite = WMR_PHP_DATA.site_code == 'uk' ? WMR_PHP_DATA.allowed_countries_uk : WMR_PHP_DATA.allowed_countries_eu;
      let countryCodeCurrent = WMR_PHP_DATA.my_location.countryCode;
      let isLocation = false;
      Object.keys(countryCodeSite).forEach(function(key) {
         if(countryCodeSite[key] == countryCodeCurrent){
           isLocation = true;
         }
      });
      if(isLocation) return true;
    }
    return false;
  }

  const Ready = () => {

    if(!w.wmr_site_id || WMR_PHP_DATA.blog_id != w.wmr_site_id) {
      if(!isCheckLocationCurrent()){
         popupDisplay(true);
      }
    }

    closePopup();
    updateSiteOption();
    goSite();

    autoSelect();
    // switchSiteForce();
    w.addEventListener('hashchange', () => {
      switchSiteForce(w.location.hash)
    });

    $('input[name=wmr_site_id]:checked').trigger('change');
  }

  $(Ready);
})(window, jQuery)
