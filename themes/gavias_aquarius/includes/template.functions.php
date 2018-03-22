<?php
function gavias_aquarius_base_url(){
  global $base_url;
  $theme_path = drupal_get_path('theme', 'gavias_aquarius');
  return $base_url . '/' . $theme_path . '/';
}

function gavias_aquarius_preprocess_node(&$variables) {
  if ($variables['teaser'] || !empty($variables['content']['comments']['comment_form'])) {
    unset($variables['content']['links']['comment']['#links']['comment-add']);
  }
  if ($variables['node']->getType() == 'article') {
      $node = $variables['node'];
      $variables['comment_count'] = $node->get('comment')->comment_count;
      $post_format = 'standard';
      try{
         $field_post_format = $node->get('field_post_format');
         if(isset($field_post_format->value) && $field_post_format->value){
            $post_format = $field_post_format->value;
         }
      }catch(Exception $e){
         $post_format = 'standard';
      }

      $iframe = '';
      if($post_format == 'video' || $post_format == 'audio'){
         try{
            $field_post_embed = $node->get('field_post_embed');
            if(isset($field_post_embed->value) && $field_post_embed->value){
               $autoembed = new AutoEmbed();
               $iframe = $autoembed->parse($field_post_embed->value);
            }else{
               $iframe = '';
               $post_format = 'standard';
            }
         }
         catch(Exception $e){
            $post_format = 'standard';
         }
      }
      $variables['gva_iframe'] = $iframe;
      $variables['post_format'] = $post_format;

  }elseif($variables['node']->getType() == 'portfolio'){
    $iframe = '';
    $node = $variables['node'];
    try{
      $field_portfolio_embed = $node->get('field_portfolio_embed');
      if(isset($field_portfolio_embed->value) && $field_portfolio_embed->value){
        $autoembed = new AutoEmbed();
        $iframe = $autoembed->parse($field_portfolio_embed->value);
      }else{
        $iframe = '';
      }
    }
    catch(Exception $e){
       $iframe = '';
    }
    $variables['gva_iframe'] = $iframe;

  }elseif($variables['node']->getType() == 'course'){
   
    $node = $variables['node'];
    if($node->hasField('comment')){
      $comment_count = $node->get('comment')->comment_count;
      if(!$comment_count) $comment_count = 0;
      $variables['comment_count'] = $comment_count;
    }

  }
}

function gavias_aquarius_preprocess_node__team(&$variables) {
  $view_mode = $variables['view_mode']; 
  $allowed_view_modes = ['full']; 
  if(in_array($view_mode, $allowed_view_modes)) {
    $allowed_regions = ['course_teacher'];
    gavias_aquarius_add_regions_to_node($allowed_regions, $variables);
  }
}

function gavias_aquarius_preprocess_node__course(&$variables){
  $node = $variables['node'];
  
  // Override lesson list on single course
  $output = '';
  $count_lectures = 0;
  if($node->hasField('field_lesson')){
    $lessons = $node->get('field_lesson');
    $count_lectures = count($lessons);
    foreach ($lessons as $key => $lesson) {
      $texts = preg_split('/--/', $lesson->value);
        $lesson_text = '';
        foreach ($texts as $k => $text) {
          $lesson_text .= '<span>' . $text . '</span>';
        }
      $output .= '<div class="item-lesson">' . $lesson_text . '</div>';
    }
  }
  $variables['count_lectures'] = $count_lectures;
  $variables['lesson'] = $output;

  // Add region course_left on single course
  $view_mode = $variables['view_mode']; 
  $allowed_view_modes = ['full']; 
  if(in_array($view_mode, $allowed_view_modes)) {
    $allowed_regions = ['course_left'];
    gavias_aquarius_add_regions_to_node($allowed_regions, $variables);
  }

}

function gavias_aquarius_preprocess_breadcrumb(&$variables){
  $variables['#cache']['max-age'] = 0;
  
  $request = \Drupal::request();
  $title = '';
  if ($route = $request->attributes->get(\Symfony\Cmf\Component\Routing\RouteObjectInterface::ROUTE_OBJECT)) {
    $title = \Drupal::service('title_resolver')->getTitle($request, $route);
  }

  if($variables['breadcrumb']){
     foreach ($variables['breadcrumb'] as $key => &$value) {
      if($value['text'] == 'Node'){
        unset($variables['breadcrumb'][$key]);
      }
    }

    if(($node = \Drupal::routeMatch()->getParameter('node')) && $variables['breadcrumb']){
      try{
        $field = $node->get('field_post_category');
        $field = $field->getValue();
         if( isset($field[0]['target_id']) && $field[0]['target_id'] ){
            $term = taxonomy_term_load($field[0]['target_id']);
            if($term){
              $variables['breadcrumb'][] = array(
                'text' => $term->get('name')->value,
                'url' => \Drupal::url('entity.taxonomy_term.canonical', array('taxonomy_term'=>$field[0]['target_id']))
              );
            }  
         }
        
      }catch(Exception $e){

      }
    } 
    if($node = \Drupal::routeMatch()->getParameter('node')){
      if($node->getType() == 'article'){
        $variables['breadcrumb'][] = array(
          'text' => ''
        );
        $variables['breadcrumb'][] = array(
          'text' => 'Article'
        );
      } 
      if($node->getType() == 'course'){
        $variables['breadcrumb'][] = array(
          'text' => ''
        );
        $variables['breadcrumb'][] = array(
          'text' => 'Course'
        ); 
      }
      if($node->getType() == 'event'){
        $variables['breadcrumb'][] = array(
          'text' => ''
        );
        $variables['breadcrumb'][] = array(
          'text' => 'Event'
        );
      }
      if($node->getType() == 'portfolio'){
        $variables['breadcrumb'][] = array(
          'text' => ''
        );
        $variables['breadcrumb'][] = array(
          'text' => 'Portfolio'
        );
      }
    }     
  }
}
