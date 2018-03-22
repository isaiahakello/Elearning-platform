(function ($) {
   "use strict";
  
  $.fn.Gva_CountDown = function( options ) {
    return this.each(function() { 
      // get instance of the Gva_CountDown.
      new  $.Gva_CountDown( this, options ); 
    });
   }
  $.Gva_CountDown = function( obj, options ){
    
    this.options = $.extend({
        autoStart     : true,
        LeadingZero   : false,
        DisplayFormat : "<div>%%D%% Days</div><div>%%H%% Hours</div><div>%%M%% Minutes</div><div>%%S%% Seconds</div>",
        FinishMessage : "Expired",
        CountActive   : false,
        TargetDate    : null
    }, options || {} );
    if( this.options.TargetDate == null || this.options.TargetDate == '' ){
      return ;
    }
    this.timer  = null;
    this.element = obj;
    this.CountStepper = -1;
    this.CountStepper = Math.ceil(this.CountStepper);
    this.SetTimeOutPeriod = (Math.abs(this.CountStepper)-1)*1000 + 990;
    var dthen = new Date(this.options.TargetDate);
    var dnow = new Date();
    var ddiff;
    if( this.CountStepper > 0 ) {
      ddiff = new Date(dnow-dthen);
    }
    else {
       ddiff = new Date(dthen-dnow);
    }
    var gsecs = Math.floor(ddiff.valueOf()/1000); 
    this.CountBack(gsecs, this);

  };
   $.Gva_CountDown.fn =  $.Gva_CountDown.prototype;
     $.Gva_CountDown.fn.extend =  $.Gva_CountDown.extend = $.extend;
   $.Gva_CountDown.fn.extend({
    calculateDate:function( secs, num1, num2 ){
        var s = ((Math.floor(secs/num1))%num2).toString();
        if ( this.options.LeadingZero && s.length < 2) {
          s = "0" + s;
        }
        return "<b>" + s + "</b>";
    },
    
    CountBack:function( secs, self ){
       if (secs < 0) {
        self.element.innerHTML = '<div class="lof-labelexpired"> '+self.options.FinishMessage+"</div>";
        return;
        }
        clearInterval(self.timer);
        var DisplayStr = self.options.DisplayFormat.replace(/%%D%%/g, self.calculateDate( secs,86400,100000) );
        DisplayStr = DisplayStr.replace(/%%H%%/g, self.calculateDate(secs,3600,24));
        DisplayStr = DisplayStr.replace(/%%M%%/g, self.calculateDate(secs,60,60));
        DisplayStr = DisplayStr.replace(/%%S%%/g, self.calculateDate(secs,1,60));
        self.element.innerHTML = DisplayStr;
        if (self.options.CountActive) {
           self.timer = null;
         self.timer =  setTimeout( function(){
          self.CountBack((secs+self.CountStepper),self);      
        },( self.SetTimeOutPeriod ) );
       }
    }   
  });

    //------- OWL carousle init  ---------------
    jQuery(document).ready(function(){
      function init_carousel_owl(){
        $('.init-carousel-owl').each(function(){
          var items = $(this).data('items') ? $(this).data('items') : 5;
          var items_lg = $(this).data('items_lg') ? $(this).data('items_lg') : 4;
          var items_md = $(this).data('items_md') ? $(this).data('items_md') : 3;
          var items_sm = $(this).data('items_sm') ? $(this).data('items_sm') : 2;
          var items_xs = $(this).data('items_xs') ? $(this).data('items_xs') : 1;
          var loop = $(this).data('loop') ? $(this).data('loop') : true;
          var speed = $(this).data('speed') ? $(this).data('speed') : 350;
          var auto_play = $(this).data('auto_play') ? $(this).data('auto_play') : false;
          var auto_play_speed = $(this).data('auto_play_speed') ? $(this).data('auto_play_speed') : false;
          var auto_play_timeout = $(this).data('auto_play_timeout') ? $(this).data('auto_play_timeout') : 1000;
          var auto_play_hover = $(this).data('auto_play_hover') ? $(this).data('auto_play_hover') : true;
          var navigation = $(this).data('navigation') ? $(this).data('navigation') : false;
          var rewind_nav = $(this).data('rewind_nav') ? $(this).data('rewind_nav') : true;
          var pagination = $(this).data('pagination') ? $(this).data('pagination') : false;
          var mouse_drag = $(this).data('pagination') ? $(this).data('mouse_drag') : true;
          var touch_drag = $(this).data('touch_drag') ? $(this).data('touch_drag') : true;

          $(this).owlCarousel({
              nav: navigation,
              autoplay: auto_play,
              autoplayTimeout: auto_play_timeout,
              autoplaySpeed: auto_play_speed,
              autoplayHoverPause: auto_play_hover,
              navText: [ '<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>' ],
              autoHeight: false,
              loop: loop, 
              dots: pagination,
              rewind: rewind_nav,
              smartSpeed: speed,
              mouseDrag: mouse_drag,
              touchDrag: touch_drag,
              responsive : {
                  0 : {
                    items: 1,
                    nav: false
                  },
                  640 : {
                    items : items_xs
                  },
                  768 : {
                    items : items_sm
                  },
                  992: {
                    items : items_md
                  },
                  1200: {
                    items: items_lg
                  },
                  1400: {
                    items: items
                  }
              }
          });
          $(this).on('translated.owl.carousel', function (event) { 
            $(this).find(".owl-item").removeClass('active-effect');
            $(this).find(".owl-item.active").addClass('active-effect');
          });  
       }); 
    }  

    init_carousel_owl();
    
  });

//===== WOW ============
 new WOW().init();


$(document).ready(function () {
    //====== OWL Carousel testimonial width thumbnail ==============
    var owl = $(".view-testimonial-v2 .owl-carousel");
    owl.owlCarousel({
        items: 1,
        nav: true, 
        slideSpeed: 300,
        paginationSpeed: 400,
        singleItem: true,
        loop: true,
        navText: [ '<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>' ]
    });
    var i = 0;
    owl.find('.owl-item').not('.cloned').each(function() {
      var $src_thumbnail = $(this).find('.item').first().data('thumbs');
      owl.find('.owl-dots .owl-dot').eq(i).html('<img src="'+$src_thumbnail+'" />');
      i++;
    }); 

    //====== OWL Carousel testimonial width thumbnail ==============
    var owl = $(".view-event-carousel .owl-carousel");
    owl.owlCarousel({
        items: 1,
        nav: true, 
        slideSpeed: 300,
        paginationSpeed: 400,
        singleItem: true,
        loop: true,
        navText: [ '<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>' ]
    });
    var i = 0;
    owl.find('.owl-item').not('.cloned').each(function() {
      var $text = $(this).find('.item').first().data('thumbs');
      owl.find('.owl-dots .owl-dot').eq(i).html('<span><span class="dot"></span>' + $text + '</span>');
      i++;
    }); 

    if ($(window).width() > 780) {
      if ( $.fn.jpreLoader ) {
        var $preloader = $( '.js-preloader' );
        $preloader.jpreLoader({
          autoClose: true,
        }, function() {
          $preloader.addClass( 'preloader-done' );
          $( 'body' ).trigger( 'preloader-done' );
          $( window ).trigger( 'resize' );
        });
      }
    }else{
      $('body').removeClass('js-preloader');
    };

    // ============================================================================
    // mb_YTPlayer video background
    // ============================================================================
    if (!jQuery.browser.mobile){
      $(".youtube-bg").mb_YTPlayer();
    }
    
    //===== Gallery ============
    $("a[data-rel^='prettyPhoto[g_gal]']").prettyPhoto({
        animation_speed:'normal',
        social_tools: false,
    });
});

jQuery(document).ready(function () {
 

    $('[data-countdown="countdown"]').each(function(index, el) {
      var $this = $(this);
      var $date = $this.data('date').split("-");
      $this.Gva_CountDown({
        TargetDate:$date[0]+"/"+$date[1]+"/"+$date[2]+" "+$date[3]+":"+$date[4]+":"+$date[5],
        DisplayFormat:"<div class=\"countdown-times\"><div class=\"day\"><span>%%D%% Days </span></div><div class=\"hours\"><span>%%H%% Hours </span></div><div class=\"minutes\"><span>%%M%% Minutes </span></div><div class=\"seconds\"><span>%%S%% Seconds </span></div></div>",
        FinishMessage: "Expired"
      });
    });



  $.fn.wrapStart = function(numWords){
  return this.each(function(){
    var $this = $(this);
    var node = $this.contents().filter(function(){
      return this.nodeType == 3
    }).first(),
    text = node.text(),
    first = text.split(" ", numWords).join(" ");
    if (!node.length) return;
    node[0].nodeValue = text.slice(first.length);
    node.before('<span>' + first + '</span>');
  });
};


$(".team-node-v1 .team-name").each(function(){
  $(this).wrapStart(1);
});

  var $container = $('.post-masonry-style');
  $container.imagesLoaded( function(){
      $container.masonry({
          itemSelector : '.item-masory',
          gutterWidth: 0,
          columnWidth: 1,
      }); 
  });


  $('.gva-search-region .icon').on('click',function(e){
    if($(this).parent().hasClass('show')){
        $(this).parent().removeClass('show');
    }else{
        $(this).parent().addClass('show');
    }
    e.stopPropagation();
  })

  // ==================================================================================
  // Offcavas
  // ==================================================================================
  $('#menu-bar').on('click',function(e){
    if($('.gva-offcanvas-inner').hasClass('show-view')){
        $(this).removeClass('show-view');
        $('.gva-offcanvas-inner').removeClass('show-view');
    }else{
        $(this).addClass('show-view');
       $('.gva-offcanvas-inner').addClass('show-view'); 
    }
    e.stopPropagation();
  })

    /*========== Click Show Sub Menu ==========*/
   
    $('.gva-navigation a').on('click','.nav-plus',function(){
        if($(this).hasClass('nav-minus') == false){
            $(this).parent('a').parent('li').find('> ul').slideDown();
            $(this).addClass('nav-minus');
        }else{
            $(this).parent('a').parent('li').find('> ul').slideUp();
            $(this).removeClass('nav-minus');
        }
        return false;
    });

  /* ============ Isotope ==============*/
    if ( $.fn.isotope ) {
      $( '.isotope-items' ).each(function() {

        var $el = $( this ),
            $filter = $( '.portfolio-filter a' ),
            $loop =  $( this );

        $loop.isotope();

        $loop.imagesLoaded(function() {
          $loop.isotope( 'layout' );
        });

        if ( $filter.length > 0 ) {

          $filter.on( 'click', function( e ) {
            e.preventDefault();
            var $a = $(this);
            $filter.removeClass( 'active' );
            $a.addClass( 'active' );
            $loop.isotope({ filter: $a.data( 'filter' ) });
          });
        };
      });
    };


   //==== Customize =====
    $('.gavias-skins-panel .control-panel').click(function(){
        if($(this).parents('.gavias-skins-panel').hasClass('active')){
            $(this).parents('.gavias-skins-panel').removeClass('active');
        }else $(this).parents('.gavias-skins-panel').addClass('active');
    });

    $('.gavias-skins-panel .layout').click(function(){
        $('body').removeClass('wide-layout').removeClass('boxed');
        $('body').addClass($(this).data('layout'));
        $('.gavias-skins-panel .layout').removeClass('active');
        $(this).addClass('active');
        var $container = $('.post-masonry-style');
        $container.imagesLoaded( function(){
            $container.masonry({
                itemSelector : '.item-masory',
                gutterWidth: 0,
                columnWidth: 1,
            }); 
        });
    });

/*----------- Animation Progress Bars --------------------*/

  $("[data-progress-animation]").each(function() {
    var $this = $(this);
    $this.appear(function() {
      var delay = ($this.attr("data-appear-animation-delay") ? $this.attr("data-appear-animation-delay") : 1);
      if(delay > 1) $this.css("animation-delay", delay + "ms");
      setTimeout(function() { $this.animate({width: $this.attr("data-progress-animation")}, 800);}, delay);
    }, {accX: 0, accY: -50});
  });
  
  /*----------------------------------------------------*/
  /*  Pie Charts
  /*----------------------------------------------------*/
  
  var pieChartClass = 'pieChart',
        pieChartLoadedClass = 'pie-chart-loaded';
    
  function initPieCharts() {
    var chart = $('.' + pieChartClass);
    chart.each(function() {
      $(this).appear(function() {
        var $this = $(this),
          chartBarColor = ($this.data('bar-color')) ? $this.data('bar-color') : "#F54F36",
          chartBarWidth = ($this.data('bar-width')) ? ($this.data('bar-width')) : 150
        if( !$this.hasClass(pieChartLoadedClass) ) {
          $this.easyPieChart({
            animate: 2000,
            size: chartBarWidth,
            lineWidth: 8,
            scaleColor: false,
            trackColor: "#eee",
            barColor: chartBarColor,
          }).addClass(pieChartLoadedClass);
        }
      });
    });
  }
  initPieCharts();

 /*-------------------------------------------------------*/
      /* Video box
  /*-------------------------------------------------------*/

$('.modal-video-box').each(function(){
   $(this).on('hidden.bs.modal', function () {
      var clone = $(this).find('.modal-body').html();
      $(this).find('.modal-body').html('');
      $(this).find('.modal-body').html(clone);
  })
})

   /*-------------------------------------------------------*/
      /* Gmap
  /*-------------------------------------------------------*/
  if($('.gsc-gmap').length > 0){
        $('.gsc-gmap').on('click', function () { 
            $('.gsc-gmap iframe').css("pointer-events", "auto"); 
        }); 

        $( ".gsc-gmap" ).mouseleave(function() { 
            $('.gsc-gmap iframe').css("pointer-events", "none"); 
        });
    }

  // ============================================================================
  // Fixed top Menu Bar
  // ============================================================================
   if($('.gv-sticky-menu').length > 0){
      var sticky = new Waypoint.Sticky({
        element: $('.gv-sticky-menu')[0]
    });
   }  

  /* -------------------
  Preloader
  ---------------------*/
  $(window).load(function(){ 
      $('.gva-loader').fadeOut('slow');
      $('#gva-preloader').delay(350).fadeOut('slow'); 
  });

  /* --------
  Lesson
  -----------*/
  $('.item-lesson header').each(function(){
    $(this).parents('.item-lesson').addClass('margin-top-50');
  })

});


})(jQuery);
