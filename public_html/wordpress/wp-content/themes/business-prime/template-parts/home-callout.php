<?php 
$cta_page_id = get_theme_mod('business_prime_callout', 0);
$style ='';
if(isset($cta_page_id) && absint($cta_page_id) >0 ){
	$image_src = wp_get_attachment_image_src(get_post_thumbnail_id($cta_page_id), 'full')[0];
	$style = 'background-image:URL('.esc_url($image_src).')';
}
?>
<!-- Services  Start -->
<div class="bs-p-callout-con">
	<div class="blur-backgound callout-backgound" style="<?php echo (!empty($style))? esc_attr($style):''; ?>"></div>
	<div class="container-fluid bp-callout">
		<div class="row wc_heading">
			<?php if(isset($cta_page_id) && absint($cta_page_id) >0 ): ?>
			<h1 class="section_heading"> <?php echo get_the_title($cta_page_id); ?> </h1>
			<p class="section_description"> <?php echo get_the_excerpt( $cta_page_id ); ?> </p>
			<?php endif; ?>
		</div>
		<div class="container">
			<div class="callout-buttons">
				<a class="btn call-link bt-1" href="<?php echo esc_url(get_theme_mod('business_prime_home_cta_one_url')); ?>"> <?php echo esc_html(get_theme_mod('business_prime_home_cta_one_text')); ?> </a>
				<a class="btn call-link bt-2" href="<?php echo esc_url(get_theme_mod('business_prime_home_cta_two_url')); ?>"> <?php echo esc_html(get_theme_mod('business_prime_home_cta_two_text')); ?> </a>
			</div>
		</div>
	</div>
</div>
<!-- Services End -->