<?php
namespace CUSREVIEW;

$saved_form_data = get_form_settings( get_the_ID() );
$saved_form_data = shortcode_atts( get_default_form_switchers(), $saved_form_data );

extract( $saved_form_data );

wp_nonce_field( 'gstm_form_meta', 'gstm_nonce_field' );
?>

<div class="gstm-filed-lists">
	<ul>
		<li><label><input type="checkbox" name="gstm_title" <?php checked( $gstm_title, 'on' ); ?>><?php esc_html_e( 'Testimonial Title', 'gs-testimonial' ); ?></label></li>
		<li><label><input type="checkbox" name="gstm_content" <?php checked( $gstm_content, 'on' ); ?>><?php esc_html_e( 'Testimonial Content', 'gs-testimonial' ); ?></label></li>
		<li><label><input type="checkbox" name="gstm_name" <?php checked( $gstm_name, 'on' ); ?>><?php esc_html_e( 'Reviewer Name', 'gs-testimonial' ); ?></label></li>
		<li><label><input type="checkbox" name="gstm_rating" <?php checked( $gstm_rating, 'on' ); ?>><?php esc_html_e( 'Rating', 'gs-testimonial' ); ?></label></li>
		<li><label><input type="checkbox" name="gstm_email" <?php checked( $gstm_email, 'on' ); ?>><?php esc_html_e( 'Email', 'gs-testimonial' ); ?></label></li>
		<li><label><input type="checkbox" name="gstm_address" <?php checked( $gstm_address, 'on' ); ?>><?php esc_html_e( 'Address', 'gs-testimonial' ); ?></label></li>
		<li><label><input type="checkbox" name="gstm_phone" <?php checked( $gstm_phone, 'on' ); ?>><?php esc_html_e( 'Phone', 'gs-testimonial' ); ?></label></li>
		<li><label><input type="checkbox" name="gstm_designation" <?php checked( $gstm_designation, 'on' ); ?>><?php esc_html_e( 'Designation', 'gs-testimonial' ); ?></label></li>
		<li><label><input type="checkbox" name="gstm_company_name" <?php checked( $gstm_company_name, 'on' ); ?>><?php esc_html_e( 'Company Name', 'gs-testimonial' ); ?></label></li>
		<li><label><input type="checkbox" name="gstm_company_logo" <?php checked( $gstm_company_logo, 'on' ); ?>><?php esc_html_e( 'Company Logo', 'gs-testimonial' ); ?></label></li>
		<li><label><input type="checkbox" name="gstm_company_url" <?php checked( $gstm_company_url, 'on' ); ?>><?php esc_html_e( 'Company URL', 'gs-testimonial' ); ?></label></li>
		<li><label><input type="checkbox" name="gstm_video_url" <?php checked( $gstm_video_url, 'on' ); ?>><?php esc_html_e( 'Video URL', 'gs-testimonial' ); ?></label></li>
		<li><label><input type="checkbox" name="gstm_social_profiles" <?php checked( $gstm_social_profiles, 'on' ); ?>><?php esc_html_e( 'Social Profiles', 'gs-testimonial' ); ?></label></li>
		<li><label><input type="checkbox" name="gstm_categories_list" <?php checked( $gstm_categories_list, 'on' ); ?>><?php esc_html_e( 'Categories', 'gs-testimonial' ); ?></label></li>
		<li><label><input type="checkbox" name="gstm_image" <?php checked( $gstm_image, 'on' ); ?>><?php esc_html_e( 'Reviewer Image', 'gs-testimonial' ); ?></label></li>
	</ul>
</div>
