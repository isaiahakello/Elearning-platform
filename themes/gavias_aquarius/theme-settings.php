<?php
use Drupal\Core\Extension\Extension;
use Drupal\Core\Extension\ExtensionDiscovery;

use Drupal\system\Controller\ThemeController;
use Drupal\Core\Theme\ThemeManagerInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Implementation of hook_form_system_theme_settings_alter()
 *
 * @param $form
 *   Nested array of form elements that comprise the form.
 *
 * @param $form_state
 *   A keyed array containing the current state of the form.
 */
function gavias_aquarius_form_system_theme_settings_alter(&$form, &$form_state) {
  $form['#attached']['library'][] = 'gavias_aquarius/gavias-aquarius-admin';  
  // Get the build info for the form
  $build_info = $form_state->getBuildInfo();
  // Get the theme name we are editing
  $theme = \Drupal::theme()->getActiveTheme()->getName();
  // Create Omega Settings Object

  $form['core'] = array(
    '#type' => 'vertical_tabs',
    '#attributes' => array('class' => array('entity-meta')),
    '#weight' => -899
  );

  $form['theme_settings']['#group'] = 'core';
  $form['logo']['#group'] = 'core';
  $form['favicon']['#group'] = 'core';

  $form['theme_settings']['#open'] = FALSE;
  $form['logo']['#open'] = FALSE;
  $form['favicon']['#open'] = FALSE;
  
  // Custom settings in Vertical Tabs container
  $form['options'] = array(
    '#type' => 'vertical_tabs',
    '#attributes' => array('class' => array('entity-meta')),
    '#weight' => -999,
    '#default_tab' => 'edit-variables',
    '#states' => array(
      'invisible' => array(
       ':input[name="force_subtheme_creation"]' => array('checked' => TRUE),
      ),
    ),
  );

  /* --------- Setting general ----------------*/
  $form['general'] = array(
    '#type' => 'details',
    '#attributes' => array(),
    '#title' => t('Gerenal options'),
    '#weight' => -999,
    '#group' => 'options',
    '#open' => FALSE,
  );

  $form['general']['sticky_menu'] =array(
    '#type' => 'select',
    '#title' => t('Enable Sticky Menu'),
    '#default_value' => theme_get_setting('sticky_menu'),
    '#group' => 'general',
    '#options' => array(
      '0'        => t('Disable'),
      '1'        => t('Enable')
     ) 
  ); 
  $form['general']['site_layout'] = array(
    '#type' => 'select',
    '#title' => t('Body Layout'),
    '#default_value' => theme_get_setting('site_layout'),
    '#options' => array(
      'wide' => t('Wide (default)'),
      'boxed' => t('Boxed'),
    ),
  );
  $form['general']['preloader'] = array(
    '#type' => 'select',
    '#title' => t('Preloader Bar Top'),
    '#default_value' => theme_get_setting('preloader'),
    '#group' => 'options',
    '#options' => array(
      '0' => t('Disable'),
      '1' => t('Enable')
    ),
  );
  // User CSS
  $form['options']['css_customize'] = array(
    '#type' => 'details',
    '#attributes' => array(),
    '#title' => t('Customize css'),
    '#weight' => -996,
    '#group' => 'options',
    '#open' => TRUE,
 );
 $form['customize']['customize_css'] = array(
    '#type' => 'textarea',
    '#title' => t('Add your own CSS'),
    '#group' => 'css_customize',
    '#attributes' => array('class' => array('code_css') ),
    '#default_value' => theme_get_setting('customize_css'),
  );

  /*--------- Setting Footer ------------ */
  $form['footer'] = array(
    '#type' => 'details',
    '#attributes' => array(),
    '#title' => t('Footer options'),
    '#weight' => -998,
    '#group' => 'options',
    '#open' => FALSE,
  );

  $form['footer']['footer_first_size'] = array(
    '#type' => 'select',
    '#title' => t('Footer First Size'),
    '#default_value' => theme_get_setting('footer_first_size') ? theme_get_setting('footer_first_size') : 3,
    '#options' => array('Default', 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 , 11, 12),
    '#description' => 'Setting width for grid boostrap / 12'
  );

  $form['footer']['footer_second_size'] = array(
    '#type' => 'select',
    '#title' => t('Footer Second Size'),
    '#default_value' => theme_get_setting('footer_second_size') ? theme_get_setting('footer_second_size') : 3,
    '#options' => array('Default', 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 , 11, 12),
    '#description' => 'Setting width for grid boostrap / 12'
  );

  $form['footer']['footer_third_size'] = array(
    '#type' => 'select',
    '#title' => t('Footer Third Size'),
    '#default_value' => theme_get_setting('footer_third_size') ? theme_get_setting('footer_third_size') : 3,
    '#options' => array('Default', 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 , 11, 12),
    '#description' => 'Setting width for grid boostrap / 12'
  );

  $form['footer']['footer_four_size'] = array(
    '#type' => 'select',
    '#title' => t('Footer Four Size'),
    '#default_value' => theme_get_setting('footer_four_size') ? theme_get_setting('footer_four_size') : 3,
    '#options' => array('Default', 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 , 11, 12),
    '#description' => 'Setting width for grid boostrap / 12'
  );


  //Customize color ----------------------------------

  $form['options']['settings_customize'] = array(
    '#type' => 'details',
    '#attributes' => array(),
    '#title' => t('Settings Customize'),
    '#weight' => -997,
    '#group' => 'options',
    '#open' => TRUE,
  );
  $form['options']['settings_customize']['settings'] = array(
    '#type' => 'details',
    '#open' => TRUE,
    '#attributes' => array(),
    '#title' => t('Cutomize Setting'),
    '#weight' => -999,
  );

   $form['options']['settings_customize']['settings']['theme_skin'] = array(
    '#type' => 'select',
    '#title' => t('Theme Skin'),
    '#default_value' => theme_get_setting('theme_skin'),
    '#group' => 'settings',
    '#options' => array(
      ''        => t('Default'),
      'green'   => t('Green'),
      'lilac'   => t('Lilac'),
      'orange'  => t('Orange'),
      'red'     => t('Red'),
      'yellow'  => t('Yellow'),
    ),
  );

  $form['options']['settings_customize']['settings']['enable_customize'] = array(
    '#type' => 'select',
    '#title' => t('Enable Use Color Customzie'),
    '#default_value' => theme_get_setting('enable_customize'),
    '#group' => 'settings',
    '#options' => array(
      '0'        => t('Disable'),
      '1'        => t('Enable'),
    ),
  );

  //Customize General color 
  $form['options']['settings_customize']['general_color'] = array(
    '#type' => 'details',
    '#open' => TRUE,
    '#attributes' => array(),
    '#title' => t('Gerenal Color'),
    '#weight' => -999,
    '#group' => 'settings_customize',
  );

  $form['theme_color'] =array(
    '#type' => 'textfield',
    '#class'  => 'input', 
    '#title' => t('Theme Color'),
    '#group'  => 'general_color',
    '#default_value' => theme_get_setting('theme_color'),
    '#attributes' => array('class' => array('color-picker') )
  ); 

  $form['text_color'] =array(
    '#type' => 'textfield',
    '#class'  => 'input', 
    '#title' => t('Text Color'),
    '#group'  => 'general_color',
    '#default_value' => theme_get_setting('text_color'),
    '#attributes' => array('class' => array('color-picker') )
  ); 

   $form['link_color'] =array(
    '#type' => 'textfield',
    '#class'  => 'input', 
    '#title' => t('Link Color'),
    '#group'  => 'general_color',
    '#default_value' => theme_get_setting('link_color'),
    '#attributes' => array('class' => array('color-picker') )
  ); 

  $form['link_hover_color'] =array(
    '#type' => 'textfield',
    '#class'  => 'input', 
    '#title' => t('Link Hover Color'),
    '#default_value' => theme_get_setting('link_hover_color'),
    '#group'  => 'general_color',
    '#attributes' => array('class' => array('color-picker') )
  ); 

  //Customize Header Color 
  $form['options']['settings_customize']['header_color'] = array(
    '#type' => 'details',
    '#open' => TRUE,
    '#attributes' => array(),
    '#title' => t('Header Color'),
    '#weight' => -999,
    '#group' => 'settings_customize',
  );

  $form['header_bg'] =array(
    '#type' => 'textfield',
    '#class'  => 'input', 
    '#title' => t('Header | Background'),
    '#group'  => 'header_color',
    '#default_value' => theme_get_setting('header_bg'),
    '#attributes' => array('class' => array('color-picker') )
  ); 

  $form['header_color_link'] =array(
    '#type' => 'textfield',
    '#class'  => 'input', 
    '#title' => t('Header | Link Color'),
    '#group'  => 'header_color',
    '#default_value' => theme_get_setting('header_color_link'),
    '#attributes' => array('class' => array('color-picker') )
  ); 

   $form['header_color_link_hover'] =array(
    '#type' => 'textfield',
    '#class'  => 'input', 
    '#title' => t('Header | Link Color Hover'),
    '#group'  => 'header_color',
    '#default_value' => theme_get_setting('header_color_link_hover'),
    '#attributes' => array('class' => array('color-picker') )
  ); 

//Customize MAIN MENU Color 
  $form['options']['settings_customize']['menu_color'] = array(
    '#type' => 'details',
    '#open' => TRUE,
    '#attributes' => array(),
    '#title' => t('Menu Color'),
    '#weight' => -999,
    '#group' => 'settings_customize',
  );

  $form['menu_bg'] =array(
    '#type' => 'textfield',
    '#class'  => 'input', 
    '#title' => t('Menu | Background'),
    '#group'  => 'menu_color',
    '#default_value' => theme_get_setting('menu_bg'),
    '#attributes' => array('class' => array('color-picker') )
  ); 

  $form['menu_color_link'] =array(
    '#type' => 'textfield',
    '#class'  => 'input', 
    '#title' => t('Menu | Link Color'),
    '#group'  => 'menu_color',
    '#default_value' => theme_get_setting('menu_color_link'),
    '#attributes' => array('class' => array('color-picker') )
  ); 

  $form['menu_color_link_hover'] =array(
    '#type' => 'textfield',
    '#class'  => 'input', 
    '#title' => t('Menu | Link Color Hover'),
    '#group'  => 'menu_color',
    '#default_value' => theme_get_setting('menu_color_link_hover'),
    '#attributes' => array('class' => array('color-picker') )
  ); 

  $form['submenu_background'] =array(
    '#type' => 'textfield',
    '#class'  => 'input', 
    '#title' => t('Sub Menu | Background'),
    '#group'  => 'menu_color',
    '#default_value' => theme_get_setting('submenu_background'),
    '#attributes' => array('class' => array('color-picker') )
  ); 

  $form['submenu_color'] =array(
    '#type' => 'textfield',
    '#class'  => 'input', 
    '#title' => t('Sub Menu | Text Color'),
    '#group'  => 'menu_color',
    '#default_value' => theme_get_setting('submenu_color'),
    '#attributes' => array('class' => array('color-picker') )
  ); 

  $form['submenu_color_link'] =array(
    '#type' => 'textfield',
    '#class'  => 'input', 
    '#title' => t('Sub Menu | Link Color'),
    '#group'  => 'menu_color',
    '#default_value' => theme_get_setting('submenu_color_link'),
    '#attributes' => array('class' => array('color-picker') )
  ); 

  $form['submenu_color_link_hover'] =array(
    '#type' => 'textfield',
    '#class'  => 'input', 
    '#title' => t('Sub Menu | Link Color Hover'),
    '#group'  => 'menu_color',
    '#default_value' => theme_get_setting('submenu_color_link_hover'),
    '#attributes' => array('class' => array('color-picker') )
  ); 

  //Customize Footer Color 
  $form['options']['settings_customize']['footer_customize_color'] = array(
    '#type' => 'details',
    '#open' => TRUE,
    '#attributes' => array(),
    '#title' => t('Footer Color'),
    '#weight' => -999,
    '#group' => 'settings_customize',
  );

  $form['footer_bg'] =array(
    '#type' => 'textfield',
    '#class'  => 'input', 
    '#title' => t('Footer | Background'),
    '#group'  => 'footer_customize_color',
    '#default_value' => theme_get_setting('footer_bg'),
    '#attributes' => array('class' => array('color-picker') )
  ); 

  $form['footer_color'] =array(
    '#type' => 'textfield',
    '#class'  => 'input', 
    '#title' => t('Footer | Link Color'),
    '#group'  => 'footer_customize_color',
    '#default_value' => theme_get_setting('footer_color'),
    '#attributes' => array('class' => array('color-picker') )
  ); 

  $form['footer_color_link'] =array(
    '#type' => 'textfield',
    '#class'  => 'input', 
    '#title' => t('Footer | Link Color'),
    '#group'  => 'footer_customize_color',
    '#default_value' => theme_get_setting('footer_color_link'),
    '#attributes' => array('class' => array('color-picker') )
  ); 

  $form['footer_color_link_hover'] =array(
    '#type' => 'textfield',
    '#class'  => 'input', 
    '#title' => t('Footer | Link Color Hover'),
    '#group'  => 'footer_customize_color',
    '#default_value' => theme_get_setting('footer_color_link_hover'),
    '#attributes' => array('class' => array('color-picker') )
  ); 

  //Customize Copyright Color 
  $form['options']['settings_customize']['copyright_customize_color'] = array(
    '#type' => 'details',
    '#open' => TRUE,
    '#attributes' => array(),
    '#title' => t('Copyright Color'),
    '#weight' => -999,
    '#group' => 'settings_customize',
  );

  $form['copyright_bg'] =array(
    '#type' => 'textfield',
    '#class'  => 'input', 
    '#title' => t('Footer | Background'),
    '#group'  => 'copyright_customize_color',
    '#default_value' => theme_get_setting('copyright_bg'),
    '#attributes' => array('class' => array('color-picker') )
  ); 

  $form['copyright_color'] =array(
    '#type' => 'textfield',
    '#class'  => 'input', 
    '#title' => t('Footer | Link Color'),
    '#group'  => 'copyright_customize_color',
    '#default_value' => theme_get_setting('copyright_color'),
    '#attributes' => array('class' => array('color-picker') )
  ); 

  $form['copyright_color_link'] =array(
    '#type' => 'textfield',
    '#class'  => 'input', 
    '#title' => t('Footer | Link Color'),
    '#group'  => 'copyright_customize_color',
    '#default_value' => theme_get_setting('copyright_color_link'),
    '#attributes' => array('class' => array('color-picker') )
  ); 

  $form['copyright_color_link_hover'] =array(
    '#type' => 'textfield',
    '#class'  => 'input', 
    '#title' => t('Footer | Link Color Hover'),
    '#group'  => 'copyright_customize_color',
    '#default_value' => theme_get_setting('copyright_color_link_hover'),
    '#attributes' => array('class' => array('color-picker') )
  ); 

  // ========== Font Typography ============
  $form['options']['settings_typography'] = array(
    '#type' => 'details',
    '#attributes' => array(),
    '#title' => t('Typography'),
    '#weight' => -997,
    '#group' => 'options',
    '#open' => TRUE,
  );

  // Font Typography Body
  $form['options']['settings_typography']['font_body'] = array(
    '#type' => 'details',
    '#attributes' => array(),
    '#title' => t('Font body'),
    '#weight' => -997,
    '#group' => 'settings_typography',
    '#open' => TRUE,
  );

  $form['options']['settings_typography']['font_body']['font_family_primary'] = array(
    '#type'          => 'select',
    '#title'         => t('Font primary'),
    '#group'         => 'font_body',
    '#default_value' => theme_get_setting('font_family_primary'),
    '#options'       => gavias_aquarius_fonts()
  );

  $form['options']['settings_typography']['font_body']['font_family_second'] = array(
    '#type'           => 'select',
    '#title'          => t('Font second'),
    '#group'          => 'font_body',
    '#default_value'  => theme_get_setting('font_family_second'),
    '#options'        => gavias_aquarius_fonts()
  );

  $form['options']['settings_typography']['font_body']['font_body_size'] = array(
    '#type'       => 'select',
    '#title'      => t('Font size'),
    '#group'      => 'font_body',
    '#options'    => gavias_aquarius_font_size()

  );

  $form['options']['settings_typography']['font_body']['font_body_weight'] = array(
    '#type'     => 'select',
    '#title'    => t('Font weight'),
    '#group'    => 'font_body',
    '#options'  => array(
          ''      => '-- Default --',
          '100'   => '100',
          '300'   => '300',
          '400'   => '400',
          '400'   => '600',
          '700'   => '700',
          '800'   => '800',
          '900'   => '900',
    )
  );



  $form['actions']['submit']['#value'] = t('Save');
} 




