<?php
/**
 * Template part for displaying Contact Section
 *
 * @package Business_One_Page
 */

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

$contact_section_page         = get_theme_mod( 'business_one_page_contact_section_page' );
$contact_section_form         = get_theme_mod( 'business_one_page_contact_section_form' );
$contact_section_info_title   = get_theme_mod( 'business_one_page_contact_section_info_title' );
$contact_section_info_content = get_theme_mod( 'business_one_page_contact_section_info_content' );
$contact_section_address      = get_theme_mod( 'business_one_page_contact_section_address' );
$contact_section_phone        = get_theme_mod( 'business_one_page_contact_section_phone' );
$contact_section_fax          = get_theme_mod( 'business_one_page_contact_section_fax' );
$contact_section_email        = get_theme_mod( 'business_one_page_contact_section_email' );

    if( $contact_section_page ){
        
        $contact_qry = new WP_Query( array( 'page_id' => $contact_section_page ) );
    
        if( $contact_qry->have_posts() ){
            while( $contact_qry->have_posts() ){
                $contact_qry->the_post();
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
?>

	<div class="row">
		<?php if( is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) ){ ?>
        
            <div class="columns-6">
    			<h2><?php esc_html_e( 'Leave a message', 'business-one-page' );?></h2>
    			<?php echo do_shortcode( wp_kses_post( $contact_section_form ) );?>
    		</div>
            
		<?php } ?>
        
        <?php if( $contact_section_info_title || $contact_section_info_content || $contact_section_address || $contact_section_phone || $contact_section_fax || $contact_section_email ){ ?>
        <div class="columns-6">
			<?php 
                if( $contact_section_info_title ) echo '<h2>' . esc_html( $contact_section_info_title ) . '</h2>';
                if( $contact_section_info_content ) echo wpautop( esc_html( $contact_section_info_content ) );
            ?>
            
            <ul class="contact-info-lists">
				<?php
                    if( $contact_section_address ) echo '<li class="address"><address>' . wpautop( esc_html( $contact_section_address ) ) . '</address></li>';
                    if( $contact_section_phone ) echo '<li class="phone">' . esc_html( $contact_section_phone ) . '</li>';
                    if( $contact_section_fax ) echo '<li class="fax">' . esc_html( $contact_section_fax ) . '</li>';
                    if( $contact_section_email ) echo '<li class="email"><a href="mailto:' . esc_attr( $contact_section_email ) . '">' . esc_html( $contact_section_email ) . '</a></li>';
                ?>
			</ul>
			
            <?php do_action( 'business_one_page_social' ); ?>
		</div>
        <?php } ?>
	</div>