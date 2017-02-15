<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package business-prime
 * Template Name: Blog
 */
get_header();
business_prime_page_header();
?>
<div class="container-fluid bp-space w_blog">
	<div class="container">
		<div class="row w_blog_detail">
			<div class="col-md-9 w_right_side">
				<div class="row w_blogs blog_gallery">
					<?php 
						$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
						$args = array( 'post_type' => 'post', 'paged'=>$paged, 'posts_per_page' => 9);
						$wp_query = new WP_Query( $args );
						if($wp_query->have_posts()):
							while($wp_query->have_posts()){
								$wp_query->the_post();
								get_template_part('template-parts/content','index'); 
							}
							wp_reset_postdata(); 
							?>
							<div class="clearfix"></div>
							<div class="row w_blog_pagination">
								<ul class="pager">
									<li class="previous"> <?php previous_posts_link( '<i class="fa fa-angle-left icon"></i>'.__('Previous Page', 'business-prime') ); ?></a></li>
									<li class="next"> <?php next_posts_link( __('Next Page', 'business-prime').'<i class="fa fa-angle-right icon"></i>' ); ?> </a></li>
								</ul>
							</div>
							<?php
							else :
								get_template_part( 'template-parts/content', 'none' );
						endif; ?>
				</div>
			</div>
			<?php get_sidebar(); ?>
		</div>
	</div>
</div>
<?php
get_footer();
