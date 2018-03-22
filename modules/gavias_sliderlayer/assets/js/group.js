(function ($) {
  function notify(style, text) {
      $.notify({
          title: 'Notification',
          text: text,
          image: '<i class="fa fa-bell" style="font-size: 30px;color: #fff;"></i>',
          hideAnimation: 'slideUp',
      }, {
          style: 'metro',
          className: style,
          autoHide: true,
          clickToHide: true,
      });
  }
})(jQuery);

$settings = drupalSettings.gavias_sliderlayer.settings;

if($settings == null) $settings = {};
var defaultSettings = {
  delay: 9000,
  gridwidth: 1170,
  gridheight: 600,
  minheight: '0',
  dotted_overlay:'none',
  sliderlayout:'auto',
  shadow:'0',
  onhoverstop:'on',
  arrow_enable:'on',
  navigationLeftHAlign: 'left',
	navigationLeftVAlign: 'center',
  navigationLeftHOffset: '20',
  navigationLeftVOffset: '0',
  navigationRightHAlign: 'right',
  navigationRightVAlign: 'center',
  navigationRightHOffset: '20',
  navigationRightVOffset: '0',
  bullets_enable: 'on',
  progressbar_disable: 'off',
};

var keyString="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";base64Encode=function(r){var e,n,t,a,o,i,d,C="",h=0;for(r=UTF8Encode(r);h<r.length;)e=r.charCodeAt(h++),n=r.charCodeAt(h++),t=r.charCodeAt(h++),a=e>>2,o=(3&e)<<4|n>>4,i=(15&n)<<2|t>>6,d=63&t,isNaN(n)?i=d=64:isNaN(t)&&(d=64),C=C+keyString.charAt(a)+keyString.charAt(o)+keyString.charAt(i)+keyString.charAt(d);return C},UTF8Encode=function(r){r=r.replace(/\x0d\x0a/g,"\n");for(var e="",n=0;n<r.length;n++){var t=r.charCodeAt(n);128>t?e+=String.fromCharCode(t):t>127&&2048>t?(e+=String.fromCharCode(t>>6|192),e+=String.fromCharCode(63&t|128)):(e+=String.fromCharCode(t>>12|224),e+=String.fromCharCode(t>>6&63|128),e+=String.fromCharCode(63&t|128))}return e},GaviasCompare=function(r,e){return r.index<e.index?-1:r.index>e.index?1:0};
 
(function ($) {
  
  function notify(style, text) {
    $.notify({
        title: 'Notification',
        text: text,
        image: '<i class="fa fa-bell" style="font-size: 30px;color: #fff;"></i>',
        hideAnimation: 'slideUp',
    }, {
        style: 'metro',
        className: style,
        autoHide: true,
        clickToHide: true,
    });
  }

  $(document).ready(function () {

    $settings = $.extend(true, defaultSettings, $settings);
    $('input.slidergroup-settings, select.slidergroup-settings').each(function (index) {
      $(this).val($settings[$(this).attr('name')]);
    });

    $('#save').click(function(){
      $(this).attr('disabled', 'true');
      saveSliderGroupSetting();
      return false;
    })
  });

  function saveSliderGroupSetting(){
    $('input.slidergroup-settings, select.slidergroup-settings').each(function (index) {
      $settings[$(this).attr('name')] = $(this).val();
    });
    var settings = $.extend(true, {}, $settings);
   console.log($settings);
    var datasettings = base64Encode(JSON.stringify(settings));

    var gid = $('input[name=gid]').val();
    
    var data = {
      settings: datasettings,
      gid     : gid
    };
    $.ajax({
      url: drupalSettings.gavias_sliderlayer.save_url,
      type: 'POST',
      data: data,
      dataType: 'json',
      success: function (data) {
        $('#save').val('Save');
        notify('success', 'Slider Group setting updated');
        $('#save').removeAttr('disabled');
      },
      error: function (jqXHR, textStatus, errorThrown) {
        alert(textStatus + ":" + jqXHR.responseText);
        notify('black', 'Slider Group setting not updated');
        $('#save').removeAttr('disabled');
      }
    });
  }

})(jQuery);
