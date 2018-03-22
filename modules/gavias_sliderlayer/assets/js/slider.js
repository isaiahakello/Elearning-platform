var $settings = drupalSettings.gavias_sliderlayer.settings;

var $group_settings = drupalSettings.gavias_sliderlayer.group_settings;

var $layers = drupalSettings.gavias_sliderlayer.layers_settings;

var $c_layer = 0;

if($layers == 'null') $layers =  new Array();

if($settings == 'null') $settings =  {}; //Setting for single slide

if($group_settings == 'null') $group_settings = { startwidth: 1170, startheight: 600 };

var delayer = {
  index: 10,
  title: '',
  type: 'text',
  text: 'Text Layer',
  image: '',
  image_uri: '',
  fid:'',
  top: 0,
  left: 0,
  data_time_start: 500,
  data_time_end: 50000,
  incomingclasses: 'SlideMaskFromTop',
  outgoingclasses: '',
  data_speed: 600,
  data_end: 300,
  data_easing: 'easeOutExpo',
  data_endeasing: '',
  removed: 0,
  width: 200,
  height: 100,
  custom_css:'',
  custom_style: '',
  custom_class: '',
  select_content_type:'text',
  video_source: '',
  youtube_video: '',
  vimeo_video: '',
  video_youtube_args: 'version=3&enablejsapi=1&html5=1&hd=1&wmode=opaque&showinfo=0&ref=0;;origin=http://server.local;autoplay=1;',
  video_vimeo_args: 'title=0&byline=0&portrait=0&api=1',
  video_start_at: '',
  video_end_at: ''

};

var deslider = {};
 deslider = {
  title: 'Slider',
  status: '1',
  sort_index: 1,
  background_image_uri: '',
  background_image: '',
  background_position: 'center top',
  background_repeat: 'no-repeat',
  background_fit: 'normal',
  data_transition: 'random',
  slide_easing_in: 'Power0.easeIn',
  slide_easing_out: 'Power1.easeOut',
  data_masterspeed: '300'
};


var key="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";base64Encode=function(r){var e,n,t,a,o,i,d,C="",h=0;for(r=UTF8Encode(r);h<r.length;)e=r.charCodeAt(h++),n=r.charCodeAt(h++),t=r.charCodeAt(h++),a=e>>2,o=(3&e)<<4|n>>4,i=(15&n)<<2|t>>6,d=63&t,isNaN(n)?i=d=64:isNaN(t)&&(d=64),C=C+key.charAt(a)+key.charAt(o)+key.charAt(i)+key.charAt(d);return C},UTF8Encode=function(r){r=r.replace(/\x0d\x0a/g,"\n");for(var e="",n=0;n<r.length;n++){var t=r.charCodeAt(n);128>t?e+=String.fromCharCode(t):t>127&&2048>t?(e+=String.fromCharCode(t>>6|192),e+=String.fromCharCode(63&t|128)):(e+=String.fromCharCode(t>>12|224),e+=String.fromCharCode(t>>6&63|128),e+=String.fromCharCode(63&t|128))}return e},GaviasCompare=function(r,e){return r.index<e.index?-1:r.index>e.index?1:0};

(function ($) {
  $(window).load(function(){
    if(!$('input[name*="video_youtube_args"').val()){
      $('input[name*="video_youtube_args"').val('version=3&enablejsapi=1&html5=1&hd=1&wmode=opaque&showinfo=0&ref=0;origin=http://server.local;autoplay=1;');
    }
    if(!$('input[name*="video_vimeo_args"').val()){
      $('input[name*="video_vimeo_args"').val('title=0&byline=0&portrait=0&api=1');
    }
  })

  $(document).ready(function () {

  //=========== Ranger ==================
   var delay = 9000;
    if($group_settings['delay']){
      delay = $group_settings['delay'];
    }

  var slider = document.getElementById('g-slider');
    noUiSlider.create(slider, {
      start: [ 20, parseInt(delay) - 20 ],
      //step: 1000, 
      margin: 20, 
      connect: true, 
      behaviour: 'tap-drag',
      range: {
        'min': 0,
        'max': parseInt(delay)
      },
      pips: { 
        mode: 'steps',
        density: 2
      }
    });

    var end = document.getElementById('g_data_end'),
    start = document.getElementById('g_data_start');

    slider.noUiSlider.on('update', function( values, handle ) {
      if ( handle ) {
        end.value = values[handle];
      } else {
        start.value = values[handle];
      }
    });

   $('#g_data_end').on('change', function() {
      slider.noUiSlider.set([null, this.value]);
    });

    $('#g_data_start').on('change', function() {
      slider.noUiSlider.set([ this.value, null]);
    });

    //=========== End Ranger ==================  
    load_slider();

    $('#add_layer').click(function () {
      add_layer();
      return false;
    })
    $('#save').click(function () {
      $(this).attr('disabled', 'true');
      save_layer_slider(false);
    })

    $('select[name=text_style]').change(function () {
      $('.layer[id=0' + '-' + $c_layer + '] .inner').attr('class', 'inner ' + $layers[$c_layer].custom_class + $layers[$c_layer].custom_style);
      $('.layer[id=0' + '-' + $c_layer + '] .inner').addClass($(this).val());
    });

    $('#content-type').find('#layer-text').keyup(function () {
      $layers[$c_layer].text = $(this).val();
      $('#0-' + $c_layer).find('.inner').html($(this).val());
    })

    $('[name=custom_css]').keyup(function(){
      $layers[$c_layer].custom_css = $(this).val();
      $('#0-' + $c_layer).find('.inner').attr('style',$(this).val());
    });

    $('[name=custom_class]').change(function(){
      $layers[$c_layer].custom_class = $(this).val();
      $('#0-' + $c_layer).find('.inner').attr('class', 'inner');
      $('#0-' + $c_layer).find('.inner').addClass($(this).val());
      $('#0-' + $c_layer).find('.inner').addClass($(this).parents('.fieldset-wrapper').find('[name=custom_style]').val());
    });

    $('[name=custom_style]').change(function(){
      $layers[$c_layer].custom_style = $(this).val();
      $('#0-' + $c_layer).find('.inner').attr('class', 'inner');
      $('#0-' + $c_layer).find('.inner').addClass($(this).val());
      $('#0-' + $c_layer).find('.inner').addClass($(this).parents('.fieldset-wrapper').find('[name=custom_class]').val());
    });

    $('#gavias_slider_single').width($group_settings.startwidth).height($group_settings.startheight);

    $('input[name=top]').change(function () {
      $('#0-' + $c_layer).css({
        top: $(this).val() + 'px'
      });
    });

    $('input[name=left]').on('change', function () {
      if($(this).val()=='center'){
        $('#0-' + $c_layer).css({
          left: '50%',
          'margin-left' : -($('#0-' + $c_layer).width()/2)
        });
      }else if($(this).val()=='left'){
        $('#0-' + $c_layer).css({
          left: 0
        });
      }else if($(this).val()=='right'){
        $('#0-' + $c_layer).css({
          right: 0
        });
      }else{
        $('#0-' + $c_layer).css({
          left: $(this).val() + 'px'
        });
      }
    });

    $('input[name=width]').change(function () {
      $('#0-' + $c_layer).css({
        width: $(this).val() + 'px'
      });
    });

    $('input[name=height]').change(function () {
      $('#0-' + $c_layer).css({
        height: $(this).val() + 'px'
      });
    });
  
  $('input#g-image-layer').on('onchange', function(){
    $url = drupalSettings.gavias_sliderlayer.base_url + $(this).val();
    insertImageToLayer($url);
  });

  $('input#background-image').on('onchange', function(){
    $url = drupalSettings.gavias_sliderlayer.base_url + $(this).val();
    setSlideSackground($url);
  });

  function insertImageToLayer(url){
    var layerid = '0-' + $c_layer;
    var img = $('<img>').attr('src', url);
    $('#'+layerid).find('.inner').html(img);
    var image = new Image();
    image.onload = function() {
      $('#'+layerid).width(this.width);
      $('#'+layerid).height(this.height);
      $('input[name=width]').val(this.width);
      $('input[name=height]').val(this.height);
    }
    image.src = url;
  }

  function setSlideSackground(url){
    jQuery('#gavias_slider_single').css({
      backgroundImage:'url('+url+')'
    });
  }

});
//========================================

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

  function load_slider() {
    $settings = $.extend(true, deslider, $settings);
    if ($settings.background_image_uri != '') {
      $('#gavias_slider_single').css({
        'background-image': 'url(' + drupalSettings.gavias_sliderlayer.base_url  + $settings.background_image_uri + ')'
      })
    } else {
      $('#gavias_slider_single').css({
        backgroundImage: 'none'
      })
    }

    jQuery('.slide-option').each(function (index) {
      if (typeof $settings[jQuery(this).attr('name')] != "undefined") {
        jQuery(this).val($settings[jQuery(this).attr('name')]);
      } else {
        jQuery(this).val('');
      }
    });
    /**/
    load_layers();
  }

  function save_slider() {
    $('input.slide-option, select.slide-option').each(function (index) {
      $settings[$(this).attr('name')] = $(this).val();
    });
  }

  /*Layer functions*/
  function load_layers() {
    $('#gavias_slider_single').find('div').remove();
    $('#gavias_list_layers').find('li').remove();
    
    if (typeof $layers == 'undefined') {
      $layers = new Array();
    }
    $($layers).each(function (i_layer) {
      if($layers[i_layer])
        if($layers[i_layer].removed != 1){
          add_tab_layer(i_layer);
        }
    })
    $('.layer-option').val('');
      if ((typeof $layers[0] != 'undefined')) {
        load_layer(0);
      }
  }

  function add_tab_layer(i_layer) {
  
    var layertype = $layers[i_layer].type;

    var tab_layer = $('<li>').attr('index', i_layer).addClass(layertype);
		$layers[i_layer].title = $layers[i_layer].title||'Layer ' + (i_layer + 1);

    var tab_layerTitle = $('<span>').text($layers[i_layer].title.substring(0,15));
    var tab_layerRemove = $('<span>').text('').addClass('remove-layer fa fa-times');
    var tab_layer_duplicate = $('<span>').attr('title', 'Duplicate this layer').text('').addClass('fa fa-clone');
    var tab_layerMove = $('<span>').text('').addClass('move fa fa-arrows');
    tab_layerTitle.click(function () {
      save_layer();
      load_layer(i_layer);
    })
    tab_layer_duplicate.click(function () {
      save_layer();
      duplicate_layer(i_layer);
    })
    tab_layerRemove.click(function () {
      remove_layer(i_layer);
    })
    tab_layer.append(tab_layerTitle);
    tab_layer.append(tab_layerRemove);
    tab_layer.append(tab_layer_duplicate);
    tab_layer.append(tab_layerMove);
    $('ul#gavias_list_layers').append(tab_layer);
    var newdelayer = $('<div>').addClass('layer tp-caption').attr('id', '0-' + i_layer);
    newdelayer.addClass('caption');
    if (typeof $layers[i_layer].text_style == 'undefined') {
      $layers[i_layer].text_style = 'text';
    }
    if ($layers[i_layer].type == 'text') {
      newdelayer.addClass($layers[i_layer].text_style);
    }
    var content = '';
    switch ($layers[i_layer].type) {
      case 'image':
      var url = drupalSettings.gavias_sliderlayer.base_url  + $layers[i_layer].image_uri;
        content = '<img src="' + url + '" />';//style="width: '+ $layers[i_layer].width +'px; height:'+ $layers[i_layer].height +'px;"/>';
        var img = new Image();
        img.onload = function() {
          newdelayer.width($layers[i_layer].width || this.width);
          newdelayer.height($layers[i_layer].height || this.height);
        }
        img.src = drupalSettings.gavias_sliderlayer.base_url  + $layers[i_layer].image_uri;
        break;
      case 'text':
        content = $layers[i_layer].text;
    }
    var inner = $('<div>').addClass('inner');
    if($layers[i_layer].custom_css){
      inner.attr('style',$layers[i_layer].custom_css);
    };
    if($layers[i_layer].custom_class){
      inner.addClass($layers[i_layer].custom_class);
    };
    if($layers[i_layer].custom_style){
      inner.addClass($layers[i_layer].custom_style);
    }
    inner.html(content);
    newdelayer.append(inner);
    var zIndex = 99 - $layers[i_layer].index;
    newdelayer.mousedown(function () {
      save_layer();
      load_layer(i_layer);
    }).draggable({
      containment: "parent",
      drag: function (event, ui) {
        $('input[name=left]').val(ui.position.left);
        $('input[name=top]').val(ui.position.top);
        set_layer_position(i_layer, ui.position.top, ui.position.left);
      },
      grid: [5, 5]
    })
    .resizable({
      aspectRatio: $layers[i_layer].type=='image',
      //containment: "parent",
      resize: function (event, ui) {
        $('input[name=width]').val(ui.size.width);
        $('input[name=height]').val(ui.size.height);
      }
    });
    $('#gavias_slider_single').append(newdelayer);
    var left = $layers[i_layer].left;
    var layer_style = $layers[i_layer].type;
    var _width = newdelayer.width();
    if(layer_style== 'image') {
      _width = $layers[i_layer].width;
    }
    if(left=='center'){
      newdelayer.css({
        'left': '50%',
        'margin-left' : -(_width/2),
      })
    }else if(left=='left'){
      newdelayer.css({
        'left': 0
      })
    }else if(left=='right'){
      newdelayer.css({
        'right': 0
      })
    }else{
      newdelayer.css({
        'left': left + 'px'
      })
    }

    newdelayer.css({
      top: $layers[i_layer].top + 'px',
      zIndex: zIndex
    });

    $('#layeroptions').show(0);

    try{
      $('#gavias_list_layers').sortable('destroy');
    }catch(e){}
		$('#gavias_list_layers').sortable({
				handle: '.move',
				update: function (event, ui) {
						$('#gavias_list_layers').find('li').each(function (index) {
								var lindex = $(this).attr('index');
								$layers[lindex].index = index;
								$('#0-'+lindex).css({zIndex:(99-index)});
								save_layer();
						});
						$layers.sort(GaviasCompare);
						save_slider();
						load_slider();
				}
		});
  }

  function add_layer() {
    save_layer();
    var newi_layer = $layers.length;
    $layers[newi_layer] = {};
    $start_layer = 0;
    $.each($layers, function(index, layer){
      if(parseInt(layer['data_time_start']) > $start_layer){
        $start_layer = layer['data_time_start'];
      }
    });

    delayer['data_time_start'] = parseInt($start_layer) + 500;
    $.extend(true, $layers[newi_layer], delayer);
    add_tab_layer(newi_layer);
    load_layer(newi_layer);
  }

  function duplicate_layer(i_layer) {
    save_layer();
    var newi_layer = $layers.length;
    $layers[newi_layer] = {};
    $.extend(true, $layers[newi_layer], $layers[i_layer]);
    add_tab_layer(newi_layer);
    load_layer(newi_layer);
  }

  function load_type_layer(type){
    $('.g-content-setting').each(function(){
      $(this).css('display','none');
    });
    $('#content-'+ type).css('display','block');
    $layers[$c_layer].type = type;
    $('ul#gavias_list_layers li.active').removeClass('image text').addClass(type);
    if (type == 'image') {
      //$('#0-' + $c_layer).removeClass($captionclasses);
      var op = $('#0-' + $c_layer).resizable("option");
      $('#0-' + $c_layer).resizable( "destroy");
      op.aspectRatio = true;
      $('#0-' + $c_layer).resizable(op);
    } else if (type == 'text') {
      $('#content-'+ type).find('textarea[id=layer-text]').trigger('keyup');
      var op2 = $('#0-' + $c_layer).resizable( "option");
      $('#0-' + $c_layer).resizable( "destroy");
      op2.aspectRatio = false;
      $('#0-' + $c_layer).resizable(op2);
    } 
  }

  function load_layer(i_layer) {
    $c_layer = i_layer;
    $('.layer').removeClass('selected');
    $('#0-' + i_layer).addClass('selected');
    $('ul#gavias_list_layers').find('li').removeClass('active');
    $('ul#gavias_list_layers').find('li[index=' + i_layer + ']').addClass('active');
    /*Bind layer data*/
    $('.layer-option').each(function (index) {
      if (typeof $layers[i_layer][$(this).attr('name')] != 'undefined') {
        if($(this).attr('name')=='data_time_end' || $(this).attr('name')=='data_time_start'){
          $(this).val($layers[i_layer][$(this).attr('name')]).trigger('change');
        }else{
          $(this).val($layers[i_layer][$(this).attr('name')]);
        }
      } else {
        $(this).val('');
      }
    });
    var type = $layers[i_layer]['select_content_type'];
    load_type_layer(type);

    $('.select-content-type').change(function(){
        var type = $(this).val();
        load_type_layer(type);
    });

  }

  function set_layer_position($i_layer, top, left) {
    $layers[$i_layer].top = top;
    $layers[$i_layer].left = left;
  }

  function save_layer() {
    if ($layers.length == 0) {
      return;
    }
    $('.layer-option').each(function (index) {
      //if ($layers[$c_layer] && typeof $layers[$c_layer][$(this).attr('name')] != "undefined") {
        $layers[$c_layer][$(this).attr('name')] = $(this).val();
      //}  
    })
  }

  function remove_layer(i_layer) {
    $('#0-' + i_layer).remove();
    $layers[i_layer]['removed'] = 1;
    $('ul#gavias_list_layers').find('li[index=' + i_layer + ']').remove();
    if (i_layer == $c_layer) {
			if($('ul#gavias_list_layers li').length > 0){
				var firstIndex = parseInt($('ul#gavias_list_layers').find('li:first').attr('index'));
				load_layer(firstIndex);
			}
    }
  }

  function save_layer_slider(ajax) {
    save_slider();
    save_layer();
    var layers = [];

		$layers.sort(GaviasCompare);
    $.each($layers,function(index, layer){
      if(layer.removed == 0){
        layers[layers.length] = layer;
      }
    });
    $layers = layers;
    var settings = $.extend(true, {}, $settings);
    
    console.log($settings);
    console.log($layers);

    var datasettings = base64Encode(JSON.stringify(settings));

    var datalayers = base64Encode(JSON.stringify(layers));

    var gid = $('input[name=gid]').val();
    var sid = $('input[name=sid]').val();
    var title = $('input[name=title]').val();
    var sort_index = $('input[name=sort_index]').val();
    var status = $('select[name=status]').val();
    var background_image_uri = $('input[name=background_image_uri]').val();
    var data = {
      sort_index: sort_index,
      status: status,
      title: title,
      sid: sid,
      gid: gid,
      background_image_uri: background_image_uri,
      datalayers: datalayers,
      settings: datasettings
    };
    $.ajax({
      url: drupalSettings.gavias_sliderlayer.save_url,
      type: 'POST',
      data: data,
      dataType: 'json',
      success: function (data) {
        $('#save').val('Save');
        notify('success', 'Slider updated');
        if(data['action'] != 'add'){
          $('#save').removeAttr('disabled');
        }
        if(data['action'] == 'add'){
          window.location = data['url_edit'];
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        //alert(textStatus + ":" + jqXHR.responseText);
        notify('black', 'Slider not updated');
        $('#save').removeAttr('disabled');
      }
    });
  }
})(jQuery);

//i_layer: index layer
//c_slider: current slider
//c_layer : current layer