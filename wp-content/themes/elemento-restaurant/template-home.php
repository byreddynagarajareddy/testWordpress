<?php
/**
 * Template Name: Fontpage
 *
 * This page is used as front page.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Elemento
 */

get_header(); 

get_template_part( 'template-parts/banner' );?>
<div id="content">
    <section id="postList" class="jr-site-blog-list all-article-wrap post-<?php echo esc_attr(elemento_blog_layout())?>-view pd-t-100 pd-b-100">
    	<div class="<?php echo esc_attr(elemento_site_container());?> content-all">
    		<div class="aGrid">              
    			<div class="cols">
                
    			
    			<?php 
            get_template_part( 'sections/restaurant', 'menu' );
            get_template_part( 'sections/restaurant', 'booking' );
            ?>    				 
    				
    			</div>  
    		</div>
    	</div>
    </section>

	
<?php

get_footer();
