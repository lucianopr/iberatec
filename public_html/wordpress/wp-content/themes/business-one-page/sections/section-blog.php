<?php
/**
 * Template part for displaying Blog Section
 *
 * @package Business_One_Page
 */

$blog_section_title    = get_theme_mod( 'business_one_page_blog_section_title' );
$blog_section_content  = get_theme_mod( 'business_one_page_blog_section_content' );
$blog_section_view_all = get_theme_mod( 'business_one_page_blog_section_view_all', __( 'View All Blogs', 'business-one-page' ) );
$blog_page             = get_option( 'page_for_posts' );


    if( $blog_section_title || $blog_section_content ){ ?>
        <header class="heading">
        	<h1><?php echo esc_html( $blog_section_title ); ?></h1>
        	<?php echo wpautop( esc_html( $blog_section_content ) ); ?>
        </header>
    <?php 
    }
    
    if( $blog_page ){
        echo '<div class="blog-post-holder"><div class="row">';
        $cat = get_theme_mod( 'business_one_page_exclude_cat' );
        if( $cat ) $cat = array_diff( array_unique( $cat ), array('') );
        
        $blog_qry = new WP_Query( array( 'posts_per_page' => 3, 'ignore_sticky_posts' => true, 'category__not_in' => $cat ) );
        if( $blog_qry->have_posts() ){
            while( $blog_qry->have_posts()  ){
                $blog_qry->the_post();
                ?>
                <div class="columns-3">
					<div class="post">
						<?php if( has_post_thumbnail() ){?>
                        <div class="img-holder">
							<a href="<?php the_permalink(); ?>" class="post-thumbnail">
                                <?php the_post_thumbnail( 'business-one-page-blog' ); ?>
                            </a>
                            <?php business_one_page_categories(); ?>
						</div>
                        <?php } ?>
						<header class="entry-header">
							<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						</header>
						<div class="entry-content">
							<?php the_excerpt(); ?>
						</div>
						<div class="entry-meta">
							<span class="posted-on">
                                <a href="<?php the_permalink(); ?>">
                                    <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() );?></time>
                                </a>
                            </span>
							<?php esc_html_e( '/', 'business-one-page' ); ?>
                            <span class="comments-link">
                                <a href="<?php the_permalink(); ?>"><?php printf( esc_html( _nx( '1 Comment', '%1$s Comments', get_comments_number(), 'comments title', 'business-one-page' ) ), number_format_i18n( get_comments_number() ) ); ?></a>
                            </span>                            
						</div>
					</div>
				</div>
                <?php                
            }
        }
        wp_reset_postdata();
        
        echo '</div>';
        echo '<div class="btn-holder"><a href="' . esc_url( get_permalink( $blog_page ) ) . '">' . esc_html( $blog_section_view_all ) . '</a></div>';
        echo '</div>';
    }