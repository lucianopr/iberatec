<?php
/**
 * Template Name: Home Page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Business_One_Page
 */

get_header(); 

    $enabled_sections = business_one_page_get_sections();
    
    if( is_array( $enabled_sections ) ){
        foreach( $enabled_sections as $section ){
            
            if( ( $section['id'] == 'cta1' ) || ( $section['id'] == 'cta2' ) ){
            ?>
            
                <section id="<?php echo esc_attr( $section['id'] ); ?>" class="promotional-block">
            		<div class="container">
                        <?php get_template_part( 'sections/section', esc_attr( $section['id'] ) ); ?>
                    </div>
                </section>
                
            <?php }elseif( $section['id'] == 'team' ) { ?>
            
                <section id="<?php echo esc_attr( $section['id'] ); ?>" class="our-team">
            		<div class="container">
                        <?php get_template_part( 'sections/section', esc_attr( $section['id'] ) ); ?>
                    </div>
                </section>
                
            <?php }elseif( $section['id'] == 'blog' ){ ?>
            
                <section id="<?php echo esc_attr( $section['id'] ); ?>" class="blog-section">
            		<div class="container">
                        <?php get_template_part( 'sections/section', esc_attr( $section['id'] ) ); ?>
                    </div>
                </section>
                
            <?php }else{ ?>
            
                <section id="<?php echo esc_attr( $section['id'] ); ?>">
            		<div class="container">
                        <?php get_template_part( 'sections/section', esc_attr( $section['id'] ) ); ?>
                    </div>
                </section>
            
            <?php
            } 
        }
    }
get_footer();