<?php 
namespace Drupal\gavias_blockbuilder\shortcodes;
if(!class_exists('gsc_coming_soon')):
   class gsc_coming_soon{
      public function render_form(){
         $fields = array(
            'type'      => 'gsc_coming_soon',
            'title'  => t('Coming soon'), 
            'size'      => 3, 
            
            'fields' => array(
               array(
                  'id'        => 'title',
                  'type'      => 'text',
                  'title'     => t('Title'),
                  'class'     => 'display-admin'
               ),
               array(
                  'id'        => 'subtitle',
                  'type'      => 'text',
                  'title'     => t('Sub Title')
               ),
               array(
                  'id'        => 'time',
                  'type'      => 'text',
                  'title'     => t('Time'),
                  'class'     => 'input_datetime'
               ),
               array(
                  'id'        => 'animate',
                  'type'      => 'select',
                  'title'     => ('Animation'),
                  'desc'      => t('Entrance animation for element'),
                  'options'   => gavias_blockbuilder_animate(),
               ),
               array(
                  'id'        => 'el_class',
                  'type'      => 'text',
                  'title'     => t('Extra class name'),
                  'desc'      => t('Style particular content element differently - add a class name and refer to it in custom CSS.'),
               ),
            ),                                       
         );
         return $fields;
      } 
      
      public function render_content( $item ) {
         print self::sc_render_content( $item['fields']);
      }

      public static function sc_render_content( $attr){
         extract(shortcode_atts(array(
            'title'        => '',
            'subtitle'     => '',
            'time'         => '',
            'el_class'     => '',
            'animate'      => ''
         ), $attr));
         $timestamp = strtotime($time);
         if( $timestamp < time())
            return;
         ?>
         <div class="gsc-coming-soon <?php print $el_class; ?>">
            <?php if($title){ ?>
            <div class="heading">
               <div class="subtitle"><?php print $subtitle ?> </div>
               <div class="title"><?php print $title ?></div>
            </div>
            <?php } ?>
            <div class="coming-soon-time">
                 <div class="pts-countdown clearfix" data-countdown="countdown"
                     data-date="<?php echo date('m',$timestamp).'-'.date('d',$timestamp).'-'.date('Y',$timestamp).'-'. date('H',$timestamp) . '-' . date('i',$timestamp) . '-' .  date('s',$timestamp) ; ?>">
                 </div>
             </div>
         </div>
         <?php
      }

      public function load_shortcode(){
         add_shortcode( 'coming_soon', array('gsc_coming_soon', 'sc_render_content') );
      }
   }
endif;

