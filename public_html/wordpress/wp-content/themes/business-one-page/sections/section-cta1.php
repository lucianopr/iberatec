<?php
/**
 * Template part for displaying Promotional Block Section
 *
 * @package Business_One_Page
 */

$cta1_section_title      = get_theme_mod( 'business_one_page_cta1_section_title' );
$cta1_section_content    = get_theme_mod( 'business_one_page_cta1_section_content' );
$cta1_section_button     = get_theme_mod( 'business_one_page_cta1_section_button' );
$cta1_section_button_url = get_theme_mod( 'business_one_page_cta1_section_button_url' );

    if( $cta1_section_title || $cta1_section_content ) {
        $cta = '<strong class="title">' . esc_html( $cta1_section_title ) . '</strong>';        
        $cta .= wpautop( esc_html( $cta1_section_content ) );
        
        if( $cta1_section_button && $cta1_section_button_url )
        $cta .= '<a href="' . esc_url( $cta1_section_button_url ) . '" class="btn-start">' . esc_html( $cta1_section_button ) . '</a>';
    }
    
    echo $cta;