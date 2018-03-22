<?php
function gavias_aquarius_preprocess_views_view_unformatted__taxonomy_term(&$variables){
   $current_uri = \Drupal::request()->getRequestUri();
   $url = \Drupal::service('path.current')->getPath();
   $arg = explode('/', $url);
   $tid = 0;
}

function gavias_aquarius_preprocess_views_view_unformatted(&$variables) {
   $view = $variables['view'];
   $rows = $variables['rows'];
   $style = $view->style_plugin;
   $options = $style->options;
   $theme_path = drupal_get_path('theme', 'gavias_aquarius');
   $variables['theme_path'] = base_path() . $theme_path;
   if(is_numeric(strpos($options['row_class'] , 'gva-carousel-1')) || $options['row_class'] == 'gva-carousel-1' ){
      $variables['gva_carousel']['class'] = 'owl-carousel init-carousel-owl';
      $variables['gva_carousel']['columns'] = '1';
   }
   if(is_numeric(strpos($options['row_class'].'x' , 'gva-carousel-2')) || $options['row_class'] == 'gva-carousel-2' ){
      $variables['gva_carousel']['class'] = 'owl-carousel init-carousel-owl';
      $variables['gva_carousel']['columns'] = '2';
   }
   if(is_numeric(strpos($options['row_class'].'x', 'gva-carousel-3')) || $options['row_class'] == 'gva-carousel-3' ){
      $variables['gva_carousel']['class'] = 'owl-carousel init-carousel-owl';
      $variables['gva_carousel']['columns'] = '3';
   }
   if(is_numeric(strpos($options['row_class'].'x', 'gva-carousel-4')) || $options['row_class'] == 'gva-carousel-4' ){
      $variables['gva_carousel']['class'] = 'owl-carousel init-carousel-owl';
      $variables['gva_carousel']['columns'] = '4';
   }
   if(is_numeric(strpos($options['row_class'], 'gva-carousel-5')) || $options['row_class'] == 'gva-carousel-5' ){
      $variables['gva_carousel']['class'] = 'owl-carousel init-carousel-owl';
      $variables['gva_carousel']['columns'] = '5';
   }
   if(is_numeric(strpos($options['row_class'].'x', 'gva-carousel-6')) || $options['row_class'] == 'gva-carousel-6' ){
      $variables['gva_carousel']['class'] = 'owl-carousel init-carousel-owl';
      $variables['gva_carousel']['columns'] = '6';
   }
   if(is_numeric(strpos($options['row_class'].'x', 'gva-carousel-7')) || $options['row_class'] == 'gva-carousel-7' ){
      $variables['gva_carousel']['class'] = 'owl-carousel init-carousel-owl';
      $variables['gva_carousel']['columns'] = '7';
   }
   if(is_numeric(strpos($options['row_class'].'x', 'gva-carousel-8')) || $options['row_class'] == 'gva-carousel-8' ){
      $variables['gva_carousel']['class'] = 'owl-carousel init-carousel-owl';
      $variables['gva_carousel']['columns'] = '8';
   }
}

function gavias_aquarius_preprocess_views_view_grid(&$variables) {
   $view = $variables['view'];
   $rows = $variables['rows'];
   $style = $view->style_plugin;
   $options = $style->options;
   $variables['gva_masonry']['class'] = '';
   $variables['gva_masonry']['class_item'] = '';
   if(strpos($options['row_class_custom'] , 'masonry') || $options['row_class_custom'] == 'masonry' ){
      $variables['gva_masonry']['class'] = 'post-masonry-style row';
      $variables['gva_masonry']['class_item'] = 'item-masory';
   }
}

function gavias_aquarius_form_views_exposed_form_alter(&$form, &$form_state, $form_id) {
   if ($form_id == 'views_exposed_form'){
      $form['title']['#attributes'] = array('placeholder' => array(t('course keyword'))); 
   }
}