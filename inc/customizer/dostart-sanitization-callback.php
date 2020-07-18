<?php 
	public function dostart_sanitize_checkbox( $checked ) {
			// Boolean check.
			return ((isset($checked) && true == $checked) ? true : false);
		}


		public function dostart_sanitize_text_field( $str ) {
  		  	$filtered = _sanitize_text_fields( $str, false );
		    return apply_filters( 'sanitize_text_field', $filtered, $str );
		}

		public function dostart_sanitize_select( $input, $setting ) {
			// Ensure input is a slug.
			$input = sanitize_key($input);
			
			// Get list of choices from the control associated with the setting.
			$choices = $setting->manager->get_control($setting->id)->choices;
			
			// If the input is a valid key, return it; otherwise, return the default.
			return (array_key_exists($input, $choices) ? $input : $setting->default);
		}


		public function dostart_sanitize_color( $color ) {
		    if ( empty($color) || is_array($color) ) {
		        return '';
		    }

		    // If string does not start with 'rgba', then treat as hex.
			// sanitize the hex color and finally convert hex to rgba
		    if ( false === strpos($color, 'rgba') ) {
		        return sanitize_hex_color($color);
		    }

		    // By now we know the string is formatted as an rgba color so we need to further sanitize it.
		    $color = str_replace(' ', '', $color);
		    sscanf($color, 'rgba(%d,%d,%d,%f)', $red, $green, $blue, $alpha);

		    return 'rgba('.$red.','.$green.','.$blue.','.$alpha.')';
		}

		public function dostart_esc_url_raw( $url, $protocols = null ) { 
			 return esc_url( $url, $protocols, 'db' );
		}

?>