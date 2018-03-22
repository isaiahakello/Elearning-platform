<style class="customize">
    <?php //================= Font Body Typography ====================== ?>
    <?php if(theme_get_setting('font_family_primary') && theme_get_setting('font_family_primary') != '---'){ ?>
        body,
        .post-style-grid.v2 .post-categories a, .pricing-table.style-2 .plan-name, .pricing-table.style-2 .plan-price .interval,
        .block .block-title > span, .block.block-blocktabs .ui-widget, .block.block-blocktabs .ui-tabs-nav > li > a,
        .navigation .gva_menu > li > a, .gva-mega-menu .block-blocktabs .ui-widget, .gva-mega-menu .block-blocktabs .ui-tabs-nav > li > a,
        .views-exposed-form .form-item select, .views-exposed-form .form-item input, .views-exposed-form .form-actions select, .views-exposed-form .form-actions input,
        .post-list-link .item-list > ul > li a, .widget.gsc-call-to-action .title, .widget.milestone-block .milestone-number,
        .gsc-hover-box .box-title
        {
            font-family: '<?php echo theme_get_setting('font_family_primary') ?>'!important;
        }
    <?php } ?> 

    <?php if(theme_get_setting('font_family_second') && theme_get_setting('font_family_second') != '---'){ ?>
        .page-notfound .big-title, .page-notfound .action a,.course-single .lessons .item-lesson span:nth-child(2),
        .event-full .event-info, .post-block .post-title a, .post-block .post-meta, .post-block .post-categories a, 
        .event-block .date span, .event-block .event-info .title, .event-block .event-info .address,
        .category-course-block .name a, .category-course-block .meta, .course-block .course-title a, .post-style-grid.v2 .post-title a,
        .portfolio-v1 .content .title a, .portfolio-v1 .content .category a, .portfolio-v2 .title a,
        .testimonial-node-v1 .quote, .testimonial-node-v1 .content-inner .title, .testimonial-node-v2 .quote,
        .testimonial-node-v3 .quote, .testimonial-node-v3 .quote .icon-quote, .testimonial-node-v4 .quote,
        .team-node-v2 .team-body, .team-node-v3 .team-name, .team-node-v3 .team-position,
        .text-big, .text-large, .nav-tabs > li > a, .bean-tab .nav-tabs > li > a, .progress-label, .pricing-table .content-wrap .plan-price .price-value span,
        .pricing-table .content-wrap .plan-price .price-value div.value, .pricing-table .content-wrap .plan-price .interval,
        .pricing-table .plan-signup a, .block.block-simplenews input#edit-subscribe, .before-footer .title,
        .working-hours .item .lab, .view-testimonial-v2 .icon-quote, .categories-course-list .view-content-wrap .item a,
        .widget.gsc-heading .title, .widget.gsc-heading .title-desc, .widget.gsc-call-to-action .content,
        .widget.milestone-block .milestone-text, .gsc-box-info .content .subtitle, .gsc-hover-background .front h2,
        .gsc-quote .icon-quote, .gsc-button, .gsc-coming-soon .subtitle, 
        h1, h2, h3, h4, h5, h6,
        .h1, .h2, .h3, .h4, .h5, .h6
        {
            font-family: '<?php echo theme_get_setting('font_family_second') ?>'!important;
        }
    <?php } ?> 

    <?php if(theme_get_setting('font_body_size')){ ?>
        body{
            font-size: <?php echo (theme_get_setting('font_body_size') . 'px'); ?>;
        }
    <?php } ?>    

    <?php if(theme_get_setting('font_body_weight')){ ?>
        body{
            font-weight: <?php echo theme_get_setting('font_body_weight'); ?>;
        }
    <?php } ?>    


    <?php //================= Theme color primary ================== ?>
    <?php if(theme_get_setting('theme_color')){ ?>
        a:hover, a:focus, a:active, .breadcrumb-content-inner .gva-breadcrumb-content .breadcrumb-links nav.breadcrumb li a:hover,
        .topbar i, .header-style-v1 header#header .navigation .gva_menu > li > a:hover,
        .header-style-v2 header#header .navigation .gva_menu > li > a:hover, .stuck.header-main .navigation .gva_menu > li > a:hover,
        .footer a:hover, .copyright a:hover, .page-notfound .action a, .course-single .course-info .item .val a:hover,
        .course-single .lessons .item-lesson header, .course-single .course-info-left .items .item .lab i, .post-block .post-categories a,
         .text-light .event-block .title a:hover, .category-course-block .name a:hover,
        .course-block .course-title a:hover, .course-block .course-price,
        .style-dark .post-block .post-title a:hover,
        .post-style-stick.v3 .item-list > ul > li:first-child .post-block .post-title a:hover,
        .portfolio-v1 .content .title a:hover, .portfolio-v1 .content a:hover,.portfolio-v2 .portfolio-image a:before,
        .testimonial-node-v1 .quote:after, .testimonial-node-v2 .content-inner .title, .testimonial-node-v3 .quote .icon-quote,
        .team-node-v2 .socials a, .text-theme, .nav-tabs > li > a:hover, .nav-tabs > li > a:focus, .nav-tabs > li > a:active,
        .nav-tabs > li.active > a, .nav-tabs > li > a.active,
        .nav-tabs.drupal-tabs > li.is-active > a,
        .bean-tab .nav-tabs > li.active > a, .owl-carousel .owl-nav > div, 
        .text-light .btn-theme:hover, .text-light .btn-theme:focus, .text-light .btn-theme:active,
        .pricing-table .plan-signup a:hover, .pricing-table.style-2 .plan-signup a:hover,
        .pricing-table.style-2.highlight-plan .plan-name h3, .pricing-table.style-2.highlight-plan .plan-price .price-value > *, .pricing-table.style-2.highlight-plan .plan-signup a,
        .panel .panel-heading .panel-title > a:after, .contact-message-form .btn-theme-submit:hover,
        .block.style-higlight .more-link a:hover, .block.block-blocktabs .ui-tabs-nav > li.ui-tabs-active > a, 
        .before-footer ul > li i, .navigation .gva_menu > li > a:hover,
        .navigation .gva_menu > li > a.is-active,
        .navigation .gva_menu .megamenu > .sub-menu > li > a, .navigation .gva_menu .sub-menu > li > a:hover, .navigation .gva_menu .sub-menu > li > a:focus, .navigation .gva_menu .sub-menu > li > a:active ,
        .gva-mega-menu .block-blocktabs .ui-tabs-nav > li.ui-tabs-active > a,
        .text-light .views-exposed-form .form-actions input, .view-testimonial-v2 .icon-quote, .tags-list .item-list > ul > li a:hover,
        .post-list-link .item-list > ul > li a:hover, .categories-course-list .view-content-wrap .item a:hover,
        .widget.gsc-heading .title, .widget.gsc-call-to-action .title strong, .widget.gsc-team .team-position,
        .widget.gsc-icon-box a:hover, .widget.gsc-icon-box a:hover h4, .widget.gsc-icon-box .link a,
        .widget.gsc-icon-box.top-center .highlight-icon .icon, .widget.gsc-icon-box.top-left .highlight-icon .icon,
        .widget.gsc-icon-box.top-left-title .highlight-icon .icon, .widget.gsc-icon-box.top-right-title .highlight-icon .icon,
        .widget.gsc-icon-box.top-right .highlight-icon .icon, .widget.gsc-icon-box.right .highlight-icon .icon, .widget.gsc-icon-box.left .highlight-icon .icon,
        .widget.milestone-block .milestone-icon span, .gsc-hover-box .icon span, .gsc-hover-box .link a,
        .gsc-hover-background .front .icon, .gsc-quote .icon-quote, .gsc-quote-text .icon,
        .gsc-coming-soon .title, .gsc-coming-soon .countdown-times > div span,
        .gsc-coming-soon .countdown-times > div span b, 
        .gva-offcanvas-inner .gva-navigation .gva_menu > li > a:hover, .gva-offcanvas-inner .gva-navigation .gva_menu > li ul.menu.sub-menu li a:hover,
        .gva-offcanvas-inner .gva-navigation .gva_menu li a:hover
        {
          color: <?php echo theme_get_setting('theme_color') ?>!important;
        }

        .pager .paginations a.active,
        .btn-theme:hover, .btn-theme:focus, .btn-theme:active,
        .panel .panel-heading .panel-title > a, .contact-message-form .btn-theme-submit,
        .text-light .contact-message-form #edit-submit:hover, .gsc-gmap.style-2 .info-inner
        {
          border-color: <?php echo theme_get_setting('theme_color') ?>!important;
        }

        .pager .paginations a.active, #edit-preview, #edit-submits, .course-single .course-info-left .course-price,
        .gallery-block a:after, .portfolio-v1 .content .title a:after, .bg-theme,
        .owl-carousel .owl-dots .owl-dot.active, .btn:hover, .btn:focus, .btn:active,
        .btn-theme:hover, .btn-theme:focus, .btn-theme:active, .progress .progress-bar,
        .pricing-table .content-wrap .plan-price, #node-single-comment h2:before,
        .contact-message-form .btn-theme-submit, .contact-message-form .form-actions #edit-preview, .contact-message-form .form-actions #edit-submit,
        .text-light .contact-message-form #edit-submit:hover, .sidebar .block .block-title span:after,
        .list-tags .view-list ul > li:hover, nav.breadcrumb ol > li a:hover,
        .poll .poll-item .bar .foreground, .navigation .gva_menu .sub-menu > li > a:hover, .navigation .gva_menu .sub-menu > li > a:focus, .navigation .gva_menu .sub-menu > li > a:active , 
        .views-exposed-form .form-actions input, .text-light .views-exposed-form .form-actions input:hover,
        .view-event-carousel .owl-dots .owl-dot .dot:after, .view-event-carousel .owl-dots .owl-dot.active .dot,
        .widget.gsc-team.team-horizontal .team-name:after, .widget.gsc-icon-box[style*="background-color"]:hover,
        .widget.gsc-box-image .body .icon, .gsc-hover-box:hover .icon, #jpreBar,
        .gavias-skins-panel .control-panel, .gavias-skins-panel .panel-skins-content .layout.active 
        {
          background-color: <?php echo theme_get_setting('theme_color') ?>!important;
        }
    <?php } ?>     


    <?php //================= Body page ===================== ?>
    <?php if(theme_get_setting('text_color')){ ?>
        body .body-page{
            color: <?php echo theme_get_setting('text_color') ?>;
        }
    <?php } ?>

    <?php if(theme_get_setting('link_color')){ ?>
        body .body-page a{
            color: <?php echo theme_get_setting('link_color') ?>!important;
        }
    <?php } ?>

    <?php if(theme_get_setting('link_hover_color')){ ?>
        body .body-page a:hover{
            color: <?php echo theme_get_setting('link_hover_color') ?>!important;
        }
    <?php } ?>

    <?php //===================Header=================== ?>
    <?php if(theme_get_setting('header_bg')){ ?>
        header .header-main{
            background: <?php echo theme_get_setting('header_bg') ?>!important;
        }
    <?php } ?>

    <?php if(theme_get_setting('header_color_link')){ ?>
        header .header-main a{
            background: <?php echo theme_get_setting('header_color_link') ?>!important;
        }
    <?php } ?>

    <?php if(theme_get_setting('header_color_link_hover')){ ?>
        header .header-main a:hover{
            background: <?php echo theme_get_setting('header_color_link_hover') ?>!important;
        }
    <?php } ?>

   

    <?php //===================Footer=================== ?>
    <?php if(theme_get_setting('footer_bg') ){ ?>
        .footer{
            background: <?php echo theme_get_setting('footer_bg') ?>!important;
        }
    <?php } ?>

     <?php if(theme_get_setting('footer_color') ){ ?>
        .footer{
            color: <?php echo theme_get_setting('footer_color') ?> !important;
        }
    <?php } ?>

    <?php if(theme_get_setting('footer_color_link')){ ?>
        .footer ul.menu > li a::after, .footer a{
            color: <?php echo theme_get_setting('footer_color_link') ?>!important;
        }
    <?php } ?>    

    <?php if(theme_get_setting('footer_color_link_hover')){ ?>
        .footer a:hover{
            color: <?php echo theme_get_setting('footer_color_link_hover') ?> !important;
        }
    <?php } ?>    

    <?php //===================Copyright======================= ?>
    <?php if(theme_get_setting('copyright_bg')){ ?>
        .copyright{
            background: <?php echo theme_get_setting('copyright_bg') ?> !important;
        }
    <?php } ?>

     <?php if(theme_get_setting('copyright_color')){ ?>
        .copyright{
            color: <?php echo $customize['copyright_color'] ?> !important;
        }
    <?php } ?>

    <?php if(theme_get_setting('copyright_color_link')){ ?>
        .copyright a{
            color: theme_get_setting('copyright_color_link') ?>!important;
        }
    <?php } ?>    

    <?php if(theme_get_setting('copyright_color_link_hover')){ ?>
        .copyright a:hover{
            color: <?php echo theme_get_setting('copyright_color_link_hover') ?> !important;
        }
    <?php } ?>    
</style>
