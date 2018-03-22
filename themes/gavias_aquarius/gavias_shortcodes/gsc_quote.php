<?php 
namespace Drupal\gavias_blockbuilder\shortcodes;
if(!class_exists('gsc_quote')):
   class gsc_quote{
      
      public function render_form(){
         $fields =array(
            'type' => 'gsc_quote',
            'title' => ('Box Info Quote'), 
            'size' => 3,
            'fields' => array(
               array(
                  'id'        => 'title',
                  'type'      => 'text',
                  'title'     => t('Title for Admin'),
                  'class'     => 'display-admin'
               ),
               array(
                  'id'        => 'content',
                  'type'      => 'textarea',
                  'title'     => t('Content'),
               ),
               array(
                  'id'        => 'name',
                  'type'      => 'text',
                  'title'     => t('Name'),
               ),
               array(
                  'id'        => 'position',
                  'type'      => 'text',
                  'title'     => t('Position'),
                  'desc'      => 'Sample: Ceo Pictor'
               ),
               array(
                  'id'        => 'image',
                  'type'      => 'upload',
                  'title'     => t('Avata for Quote'),
               ),
               array(
                  'id'        => 'signature',
                  'type'      => 'text',
                  'title'     => t('Signature'),
               ),
               
               array(
                  'id'        => 'animate',
                  'type'      => 'select',
                  'title'     => t('Animation'),
                  'sub_desc'  => t('Entrance animation'),
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
         print self::sc_quote( $item['fields'] );
      }

      public static function sc_quote( $attr, $content = null ){
         extract(shortcode_atts(array(
            'content'      => '',
            'name'         => '',
            'image'        => '',
            'position'     => '',
            'signature'    => '',
            'animate'      => '',
            'el_class'     => ''
         ), $attr));
            
         $image = substr(base_path(), 0, -1) . $image; 
         if($animate){
            $class .= ' wow';
            $class .= ' '. $animate;
         }
         ?>
            <div class="widget gsc-quote <?php print $el_class ?>">
               <div class="widget-content">
                  <span class="icon-quote">“</span>
                  <div class="row">
                     <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                        <div class="content"><?php print $content ?></div>
                        
                        <div class="info">
                           <span class="name"><?php print $name ?></span>,
                           <span class="position"><?php print $position ?></span>
                        </div>

                        <?php if($signature){ ?>
                           <div class="signature"><?php print $signature ?></div>
                        <?php } ?>
                     </div>
                     <div class="right-image col-lg-3 col-md-3 hidden-xs hidden-sm">   
                        <?php if($image){ ?>
                           <div class="avata">
                              <img src="<?php print $image ?>" alt="quote" />
                           </div> 
                        <?php } ?>  
                     </div>
                  </div>      
               </div>
            </div>      
         <?php       
      }

      public function load_shortcode(){
         add_shortcode( 'quote', array('gsc_quote', 'sc_quote') );
      }
   }
endif;   




