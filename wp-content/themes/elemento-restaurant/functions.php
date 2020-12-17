<?php
function elemento_restaurant_customize_register( $wp_customize ) {

    require 'inc/restaurant.php';
    require 'inc/booking.php';

}
add_action( 'customize_register', 'elemento_restaurant_customize_register' );
function elemento_restaurant_enqueue_styles() {

    $parent_style = 'elemento-style'; 

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'elemento-restaurant-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}
add_action( 'wp_enqueue_scripts', 'elemento_restaurant_enqueue_styles' );

if( ! function_exists('elemento_restaurant_footer_callout') ):

function elemento_restaurant_co($wp_customize) {
   
    $wp_customize->add_setting(
        's_title_color',
        array(
            'default'           => '#ED564B',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            's_title_color',
            array(
                'label' => __('Site Title Color', 'elemento-restaurant'),
                'section' => 'colors_header',
                'priority' => 1
            )
        )
    );  
	
	$wp_customize->add_setting(
        's_des_color',
        array(
            'default'           => '#ffffff',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            's_des_color',
            array(
                'label' => __('Site Description Color', 'elemento-restaurant'),
                'section' => 'colors_header',
                'priority' => 2
            )
        )
    );  

	$wp_customize->add_setting(
        'ft_bg_color',
        array(
            'default'           => '#000000',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'ft_bg_color',
            array(
                'label' => __('Footer background Color', 'elemento-restaurant'),
                'section' => 'colors_footer',
                'priority' => 1
            )
        )
    );  
}
add_action('customize_register', 'elemento_restaurant_co');

endif;


if( ! function_exists('elemento_restaurant_dynamic_css') ):
function elemento_restaurant_dynamic_css(){
    ob_start();

    ?>
    <style>
    
    
    .site-title a {
    color:<?php echo esc_attr( get_theme_mod('s_title_color') ); ?>;
	}
    .site-description {
	color:<?php echo esc_attr( get_theme_mod('s_des_color') ); ?>;	
	}    
    #footer {
		background:<?php echo esc_attr( get_theme_mod('ft_bg_color') ); ?>;
	}    
    </style>
    <?php 
    echo ob_get_clean();
}
add_action( 'wp_head' , 'elemento_restaurant_dynamic_css' , 55 );
endif;


add_editor_style('editor-style.css');


require 'inc/activation.php';

/**
 * Sanitize Category.
 * @param $input
 * @return int
 */
function elemento_restaurant_sanitize_category($input){
    $output=intval($input);
    return $output;
}
if ( ! class_exists( 'WP_Customize_Control' ) )
  return NULL;

/**
 * Class Ithemer_Customize_Dropdown_Taxonomies_Control
 */
class Elemento_Restaurant_Customize_Dropdown_Taxonomies_Control extends WP_Customize_Control {

  public $elemento_restaurant_type = 'dropdown-taxonomies';

  public $taxonomy = '';


  public function __construct( $manager, $id, $args = array() ) {

    $our_taxonomy = 'category';
    if ( isset( $args['taxonomy'] ) ) {
      $taxonomy_exist = taxonomy_exists( esc_attr( $args['taxonomy'] ) );
      if ( true === $taxonomy_exist ) {
        $our_taxonomy = esc_attr( $args['taxonomy'] );
      }
    }
    $args['taxonomy'] = $our_taxonomy;
    $this->taxonomy = esc_attr( $our_taxonomy );

    parent::__construct( $manager, $id, $args );
  }

  public function render_content() {

    $tax_args = array(
      'hierarchical' => 0,
      'taxonomy'     => $this->taxonomy,
    );
    $all_taxonomies = get_categories( $tax_args );

    ?>
    <label>
      <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
         <select <?php echo $this->link(); ?>>
            <?php
              printf('<option value="%s" %s>%s</option>', '', selected($this->value(), '', false),__('Select', 'elemento-restaurant') );
             ?>
            <?php if ( ! empty( $all_taxonomies ) ): ?>
              <?php foreach ( $all_taxonomies as $key => $tax ): ?>
                <?php
                  printf('<option value="%s" %s>%s</option>', $tax->term_id, selected($this->value(), $tax->term_id, false), $tax->name );
                 ?>
              <?php endforeach ?>
           <?php endif ?>
         </select>

    </label>
    <?php
  }

}
/**
 * Drop-down Pages sanitization callback example.
 *
 * - Sanitization: dropdown-pages
 * - Control: dropdown-pages
 * 
 * Sanitization callback for 'dropdown-pages' type controls. This callback sanitizes `$page_id`
 * as an absolute integer, and then validates that $input is the ID of a published page.
 * 
 * @see absint() https://developer.wordpress.org/reference/functions/absint/
 * @see get_post_status() https://developer.wordpress.org/reference/functions/get_post_status/
 *
 * @param int                  $page    Page ID.
 * @param WP_Customize_Setting $setting Setting instance.
 * @return int|string Page ID if the page is published; otherwise, the setting default.
 */
function elemento_restaurant_sanitize_dropdown_pages( $page_id, $setting ) {
    // Ensure $input is an absolute integer.
    $page_id = absint( $page_id );
    
    // If $page_id is an ID of a published page, return it; otherwise, return the default.
    return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
}

/**
 * Checkbox sanitization callback example.
 * 
 * Sanitization callback for 'checkbox' type controls. This callback sanitizes `$checked`
 * as a boolean value, either TRUE or FALSE.
 *
 * @param bool $checked Whether the checkbox is checked.
 * @return bool Whether the checkbox is checked.
 */
function elemento_restaurant_sanitize_checkbox( $checked ) {
    // Boolean check.
    return ( ( isset( $checked ) && true == $checked ) ? true : false );
}


