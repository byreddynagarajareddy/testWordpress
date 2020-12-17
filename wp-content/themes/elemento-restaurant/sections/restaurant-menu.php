<?php

/**

 * Template part for displaying posts

 *

 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/

 *

 * @package Elemento

 */

?>

<?php
            $r_title   = get_theme_mod( 'elemento_restaurant_title' );
            ?>
                        <h2><?php echo esc_html($r_title); ?></h2>
<?php
            $menu_catId   = esc_attr( get_theme_mod( 'elemento_restaurant_category_id' ) );
            $menu_catLink = get_category_link( $menu_catId );
            $menu_CatName = get_category( $menu_catId );
            $args         = array(
              'post_type'      => 'post',
              'posts_per_page' => 3,
              'post_status'    => 'publish',
              'cat'            => $menu_catId,

            );

            $menuloop = new WP_Query( $args );

            while ( $menuloop->have_posts() ) :
              $menuloop->the_post();
              ?>

<div id="post-<?php the_ID(); ?>" <?php post_class('post-wrap'); ?>>

    <div class="article-wrap">

            <?php if( elemento_feat_image() ):?>

                <div class="article-img-wrap">

                    <a href="<?php the_permalink();?>"><?php the_post_thumbnail('elemento-img-525-350'); ?></a>

                </div>

            <?php endif; ?>







        



        <?php elemento_categories(); ?>  




        <h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>



          <?php 

            elemento_post_excerpt();

           ?>



         <?php if( ! esc_attr( get_theme_mod( 'hide_meta_index' ) ) && ( 'post' == get_post_type() ) ):?>                            

               <?php elemento_author();?> 

            <?php endif;?>

              



    </div>

</div>
<?php endwhile;
            wp_reset_postdata();
            ?>
