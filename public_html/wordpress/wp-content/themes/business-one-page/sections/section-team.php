<?php
/**
 * Template part for displaying Team Section
 *
 * @package Business_One_Page
 */

$team_section_page = get_theme_mod( 'business_one_page_team_section_page' );
$team_section_cat  = get_theme_mod( 'business_one_page_team_section_cat' );

    if( $team_section_page ){
        
        $team_qry = new WP_Query( array( 'page_id' => $team_section_page ) );
    
        if( $team_qry->have_posts() ){
            while( $team_qry->have_posts() ){
                $team_qry->the_post();
            ?>
                <header class="heading">
                	<h1><?php the_title(); ?></h1>
                	<?php the_content(); ?>
                </header>
            <?php            
            }
        }
        wp_reset_postdata();
    }
    
    if( $team_section_cat ){ ?>
    
        <div class="team-holder">
            <ul id="lightSlider">
            
            <?php 
                $team_query = new WP_Query( array( 'cat' => $team_section_cat, 'posts_per_page' => -1, 'ignore_sticky_posts' => true ) );
                if( $team_query->have_posts() ){
                    while( $team_query->have_posts() ){
                        $team_query->the_post();
                        if( has_post_thumbnail() ){
                        ?>
                        <li>
    						<div class="box">
    							<div class="img-holder"><?php the_post_thumbnail( 'business-one-page-team' ); ?></div>
    							<strong class="name"><?php the_title(); ?></strong>
    							<em class="designation"><?php the_excerpt(); ?></em>
    							<div class="hover-state">
    								<div class="table">
    									<div class="tabel-row">
    										<div class="tabel-cell">
    											<strong class="name"><?php the_title(); ?></strong>
    											<em class="designation"><?php the_excerpt(); ?></em>
    											<?php the_content(); ?>
    										</div>
    									</div>
    								</div>
    							</div>
    						</div>
                        </li>
                        <?php
                        }
                    }
                }
                wp_reset_postdata();
            ?>
            
            </ul>
        </div>
    <?php    
    }