<?php
/**
* Sanitization Functions.
*
* @package Blog Prime
*/


if ( ! function_exists( 'blog_prime_sanitize_select' ) ) :

	/**
	 * Sanitize select.
	 */
	function blog_prime_sanitize_select( $input, $setting ) {

		// Ensure input is a slug.
		$input = sanitize_text_field( $input );

		// Get list of choices from the control associated with the setting.
		$choices = $setting->manager->get_control( $setting->id )->choices;

		// If the input is a valid key, return it; otherwise, return the default.
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

	}

endif;

if ( ! function_exists( 'blog_prime_sanitize_checkbox' ) ) :

	/**
	 * Sanitize checkbox.
	 */
	function blog_prime_sanitize_checkbox( $checked ) {

		return ( ( isset( $checked ) && true === $checked ) ? true : false );

	}

endif;