<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Business_One_Page
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function business_one_page_body_classes( $classes ) {
	
    global $post;
    
    // Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}
    
    // Adds a class of custom-background-image to sites with a custom background image.
	if ( get_background_image() ) {
		$classes[] = 'custom-background-image';
	}
    
    // Adds a class of custom-background-color to sites with a custom background color.
    if ( get_background_color() != 'ffffff' ) {
		$classes[] = 'custom-background-color';
	}
    
    if( !( is_active_sidebar( 'right-sidebar' )) || is_page_template( 'template-home.php' ) ) {
		$classes[] = 'full-width';	
	}
    
    if( is_page() ){
		$sidebar_layout = get_post_meta( $post->ID, 'business_one_page_sidebar_layout', true );
        if( $sidebar_layout == 'no-sidebar' )
		$classes[] = 'full-width';
	}
        
	return $classes;
}
add_filter( 'body_class', 'business_one_page_body_classes' );

/** 
* Hook to move comment text field to the bottom in WP 4.4
* 
* @link http://www.wpbeginner.com/wp-tutorials/how-to-move-comment-text-field-to-bottom-in-wordpress-4-4/ 
*/
function business_one_page_move_comment_field_to_bottom( $fields ) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;
    return $fields;
}
add_filter( 'comment_form_fields', 'business_one_page_move_comment_field_to_bottom' );

/**
 * Callback function for Comment List *
 * 
 * @link https://codex.wordpress.org/Function_Reference/wp_list_comments 
 */
function business_one_page_theme_comment( $comment, $args, $depth ){
    $GLOBALS['comment'] = $comment;
	extract( $args, EXTR_SKIP );

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
	<<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
	<div class="comment-author vcard">
	<?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
	<?php printf( __( '<b class="fn">%s</b>', 'business-one-page' ), get_comment_author_link() ); ?>
	</div>
	<?php if ( $comment->comment_approved == '0' ) : ?>
		<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'business-one-page' ); ?></em>
		<br />
	<?php endif; ?>

	<div class="comment-metadata commentmetadata">
    <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
		<time>
        <?php
			/* translators: 1: date, 2: time */
			printf( __( '%1$s - %2$s', 'business-one-page' ), get_comment_date( 'M n, Y' ), get_comment_time() ); ?>
        </time>
    </a>
	</div>
    
    <div class="comment-content"><?php comment_text(); ?></div>
    
	<div class="reply">
	<?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
	</div>
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php
}

/**
 * Callback for Home Page Slider 
 **/
function business_one_page_slider_cb(){
    
    $slider_caption    = get_theme_mod( 'business_one_page_slider_caption', '1' );
    $slider_readmore   = get_theme_mod( 'business_one_page_slider_readmore', __( 'Learn More', 'business-one-page' ) );
    $slider_post_one   = get_theme_mod( 'business_one_page_slider_post_one' );
    $slider_post_two   = get_theme_mod( 'business_one_page_slider_post_two' );
    $slider_post_three = get_theme_mod( 'business_one_page_slider_post_three' );
    $slider_post_four  = get_theme_mod( 'business_one_page_slider_post_four' );
    $slider_posts      = array( $slider_post_one, $slider_post_two, $slider_post_three, $slider_post_four );
    $slider_posts      = array_diff( array_unique( $slider_posts ), array('') );
        
    if( $slider_posts ){
        $qry = new WP_Query ( array( 
            'post_type'     => 'post', 
            'post_status'   => 'publish',
            'posts_per_page'=> -1,                    
            'post__in'      => $slider_posts, 
            'orderby'       => 'post__in'
        ) );
        
        if( $qry->have_posts() ){?>
            <div class="banner">
                <div class="flexslider">
                    <ul class="slides">
                    <?php
                    while( $qry->have_posts() ){
                        $qry->the_post();
                        $image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'business-one-page-slider' );
                    ?>
                        <?php if( has_post_thumbnail() ){?>
                        <li>
                            <img src="<?php echo esc_url( $image[0] ); ?>" alt="<?php the_title_attribute(); ?>" />
                            <?php if( $slider_caption ){ ?>
        				    <div class="banner-text">
        						<div class="container">
        							<div class="text">
        								<span class="category"><?php business_one_page_categories(); ?></span>
        								<strong class="title"><?php the_title(); ?></strong>
                                        <?php if( $slider_readmore ){ ?> 
                                        <a class="btn-more" href="<?php the_permalink(); ?>"><?php echo esc_html( $slider_readmore );?></a>
                                        <?php } ?>
        							</div>
        						</div>
        					</div>
                            <?php } ?>
                        </li>
                        <?php } ?>
                    <?php
                    }
                    ?>
                    </ul>
                </div>
            </div>
            <?php
        }
        wp_reset_postdata();       
    }    
}
add_action( 'business_one_page_slider', 'business_one_page_slider_cb' );
 
/**
 * Function to get Sections 
 */
function business_one_page_get_sections(){
    $sections = array( 'about', 'services', 'cta1', 'portfolio', 'team', 'clients', 'blog', 'testimonial', 'cta2', 'contact' );
    $enabled_section = array();
    foreach ( $sections as $section ){
        if ( esc_attr( get_theme_mod( 'business_one_page_ed_' . $section . '_section' ) ) == 1 ){
            $enabled_section[] = array(
                'id' => $section,
                'menu_text' => esc_attr( get_theme_mod( 'business_one_page_' . $section . '_section_menu_title','' ) ),
            );
        }
    }
    return $enabled_section;
}

/**
 * Callback for Social Links  
*/
function business_one_page_social_cb(){
    $facebook = get_theme_mod( 'business_one_page_facebook' );
    $twitter = get_theme_mod( 'business_one_page_twitter' );
    $pinterest = get_theme_mod( 'business_one_page_pinterest' );
    $linkedin = get_theme_mod( 'business_one_page_linkedin' );
    $google_plus = get_theme_mod( 'business_one_page_google_plus' ); 
    
    if( $facebook || $twitter || $pinterest || $linkedin || $google_plus ){ ?>
    <ul class="social-networks">
		<?php 
            if( $facebook ) echo '<li><a href="'. esc_url( $facebook ) .'" target="_blank" title="'. esc_html__( 'Facebook', 'business-one-page' ) .'"><span class="fa fa-facebook"></span></a></li>';
            if( $twitter ) echo '<li><a href="'. esc_url( $twitter ) .'" target="_blank" title="'. esc_html__( 'Twitter', 'business-one-page' ) .'"><span class="fa fa-twitter"></span></a></li>'; 
            if( $pinterest ) echo '<li><a href="'. esc_url( $pinterest ) .'" target="_blank" title="'. esc_html__( 'Pinterest', 'business-one-page' ) .'"><span class="fa fa-pinterest-p"></span></a></li>';
            if( $linkedin ) echo '<li><a href="'. esc_url( $linkedin ) .'" target="_blank" title="'. esc_html__( 'LinkedIn', 'business-one-page' ) .'"><span class="fa fa-linkedin"></span></a></li>';
            if( $google_plus ) echo '<li><a href="'. esc_url( $google_plus ) .'" target="_blank" title="'. esc_html__( 'Google Plus', 'business-one-page' ) .'"><span class="fa fa-google-plus"></a></li>';
        ?>
	</ul>
    <?php }
}
add_action( 'business_one_page_social', 'business_one_page_social_cb' );

/**
 * Custom CSS
*/
function business_one_page_custom_css(){
    $custom_css = get_theme_mod( 'business_one_page_custom_css' );
    if( !empty( $custom_css ) ){
		echo '<style type="text/css">';
		echo wp_strip_all_tags( $custom_css );
		echo '</style>';
	}
}
add_action( 'wp_head', 'business_one_page_custom_css', 100 );

if ( ! function_exists( 'business_one_page_excerpt_more' ) && ! is_admin() ) :
/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... * 
 */
function business_one_page_excerpt_more() {
	return ' &hellip; ';
}
add_filter( 'excerpt_more', 'business_one_page_excerpt_more' );
endif;

if ( ! function_exists( 'business_one_page_excerpt_length' ) ) :
/**
 * Changes the default 55 character in excerpt 
*/
function business_one_page_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'business_one_page_excerpt_length' );
endif;

/**
 * excerpt length for portfolio section
*/
function business_one_page_excerpt_length_alt( $length ){
    return 12;
}

/**
 * Footer Credits 
*/
function business_one_page_footer_credit(){
    $text  = '<div class="site-info">';
    $text .= sprintf( esc_html__( 'Copyright &copy;  %s', 'business-one-page' ), date_i18n( 'Y' ) . ' <a href="' . esc_url( home_url( '/' ) ) .'">' . esc_html( get_bloginfo( 'name' ) ) . '</a> &middot; ' );
    $text .= sprintf( esc_html__( '%s', 'business-one-page' ), '<a href="' . esc_url( __( 'http://raratheme.com/wordpress-themes/business-one-page/', 'business-one-page' ) ) .'" rel="designer" target="_blank">Business One Page by: Rara Theme</a> &middot; ' );
    $text .= sprintf( esc_html__( 'Powered by: %s', 'business-one-page' ), '<a href="'. esc_url( __( 'https://wordpress.org/', 'business-one-page' ) ) .'" target="_blank">WordPress</a>' );
    $text .= '</div>';
    echo apply_filters( 'business_one_page_footer_text', $text );    
}
add_action( 'business_one_page_footer', 'business_one_page_footer_credit' );

/**
 * Return sidebar layouts for pages
*/
function business_one_page_sidebar_layout(){
    global $post;
    
    if( get_post_meta( $post->ID, 'business_one_page_sidebar_layout', true ) ){
        return get_post_meta( $post->ID, 'business_one_page_sidebar_layout', true );    
    }else{
        return 'right-sidebar';
    }
}

/**
 * Exclude post with Category from blog and archive page. 
*/
function business_one_page_exclude_cat( $query ){
    $cat = get_theme_mod( 'business_one_page_exclude_cat' );
    
    if( $cat && ! is_admin() && $query->is_main_query() ){
        $cat = array_diff( array_unique( $cat ), array('') );
        if( $query->is_home() || $query->is_archive() ) {
			$query->set( 'category__not_in', $cat );
		}
    }    
}
add_filter( 'pre_get_posts', 'business_one_page_exclude_cat' );

/** 
 * Exclude Categories from Category Widget 
*/ 
function business_one_page_custom_category_widget( $arg ) {
	$cat = get_theme_mod( 'business_one_page_exclude_cat' );
    
    if( $cat ){
        $cat = array_diff( array_unique( $cat ), array('') );
        $arg["exclude"] = $cat;
    }
	return $arg;
}
add_filter( "widget_categories_args", "business_one_page_custom_category_widget" );
add_filter( "widget_categories_dropdown_args", "business_one_page_custom_category_widget" );

/**
 * Exclude post from recent post widget of excluded catergory
 * 
 * @link http://blog.grokdd.com/exclude-recent-posts-by-category/
*/
function business_one_page_exclude_posts_from_recentPostWidget_by_cat(){
    $s = '';
    $i = 1;
    $cat = get_theme_mod( 'business_one_page_exclude_cat' );
    
    if( $cat ){
        $cat = array_diff( array_unique( $cat ), array('') );
        foreach( $cat as $c ){
            $i++;
            $s .= '-'.$c;
            if( count($cat) >= $i )
            $s .= ', ';
        }
    }
    
    $exclude = array( 'cat' => $s );
    
    return $exclude;   
}
add_filter( "widget_posts_args", "business_one_page_exclude_posts_from_recentPostWidget_by_cat" );