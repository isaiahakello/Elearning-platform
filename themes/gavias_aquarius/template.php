function YOURTHEME_theme(&$existing, $type, $theme, $path){
  $hooks = array();
   // Make user-register.tpl.php available
  $hooks['user_register_form'] = array (
     'render element' => 'form',
     'path' => drupal_get_path('theme','YOURTHEME'),
     'template' => 'user-register',
     'preprocess functions' => array('YOURTHEME_preprocess_user_register_form'),
  );
  return $hooks;
}

function YOURTHEME_preprocess_user_register_form(&$vars) {
  $args = func_get_args();
  array_shift($args);
  $form_state['build_info']['args'] = $args; 
  $vars['form'] = drupal_build_form('user_register_form', $form_state['build_info']['args']);
}

print render($form['account']['name']);
print render($form['account']['mail']);


print render($form['profile_theprofile_name']['field_thefield_name']);

 print drupal_render($form['actions']);
  print drupal_render_children($form);