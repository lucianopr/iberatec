<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Business_One_Page
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	
	<div id="home">
        
        <header id="masthead" class="site-header" role="banner">
        	
            <div class="container">
				
                <div class="site-branding">
            		
                    <?php 
                        if( function_exists( 'has_custom_logo' ) && has_custom_logo() ){
                            the_custom_logo();
                        } 
                    ?>		
           			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>                   		
                    <?php
                		$description = get_bloginfo( 'description', 'display' );
                		if ( $description || is_customize_preview() ) : ?>
                			<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
            		<?php
          		        endif;
                    ?>
            	</div><!-- .site-branding -->
                
                <div id="nav-anchor"></div>
				
                <?php 
                    $enabled_sections = business_one_page_get_sections();
                    $home_link_label  = get_theme_mod( 'business_one_page_home_link_label', __( 'Home', 'business-one-page' ) );
                    $ed_section_menu  = get_theme_mod( 'business_one_page_ed_secion_menu' );
                    
                    if( $enabled_sections && ( 'page' == get_option( 'show_on_front' ) ) && ( $ed_section_menu != 1 ) ){ 
                ?>
                    <nav id="site-navigation" class="main-navigation" role="navigation">
                        <ul>
                        <?php if( ! get_theme_mod( 'business_one_page_ed_home_link' ) ){ ?>
                            <li class="current-menu-item"><a href="<?php echo esc_url( home_url( '#home' ) ); ?>"><?php echo esc_html( $home_link_label ); ?></a></li>
                        <?php }
                            foreach( $enabled_sections as $section ){ 
                                if( $section['menu_text'] ){
                        ?>
                                <li><a href="<?php echo esc_url( home_url( '#' . esc_attr( $section['id'] ) ) ); ?>"><?php echo esc_html( $section['menu_text'] );?></a></li>                        
                        <?php 
                                } 
                            }
                        ?>
                        </ul>
                    </nav>
                <?php }else{ ?>
                    <nav id="site-navigation" class="main-navigation" role="navigation">
                        <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
                    </nav><!-- #site-navigation -->
                <?php } ?>
                
			</div><!-- .container -->
            
        </header><!-- #masthead -->
        
        <?php 
            if( is_front_page() ){                 
                $business_one_page_ed_slider = get_theme_mod( 'business_one_page_ed_slider' );
                if( $business_one_page_ed_slider ) do_action( 'business_one_page_slider' );
            } 
        ?>
        
    </div><!-- #home -->
    
    <?php if( !is_page_template( 'template-home.php' ) ){?>
        <div id="content" class="site-content">
            <div class="container">
                <div class="row">
                <?php } ?>