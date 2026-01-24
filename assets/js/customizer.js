/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function ( $ ) {
	'use strict';

	//------- Site title and description. --------/
	wp.customize(
		'blogname', function ( value ) {
			value.bind(
				function ( to ) {
					$( '.site-title a' ).text( to );
				}
			);
		}
	);

	//------- Blog Description --------/
	wp.customize(
		'blogdescription', function ( value ) {
			value.bind(
				function ( to ) {
					$( '.site-description' ).text( to );
				}
			);
		}
	);

	//------- Typography - Font Family --------/
	wp.customize(
		'dostart_typography_font_family', function ( value ) {
			value.bind(
				function ( to ) {
					var fontFamily;
					if ( '' === to ) {
						fontFamily = '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif';
					} else {
						fontFamily = '"' + to + '", sans-serif';
					}
					
					// Load Google Font if not default
					if ( '' !== to ) {
						var fontUrlName = to.replace( /\s+/g, '+' );
						var fontUrl = 'https://fonts.googleapis.com/css?family=' + fontUrlName + ':300,400,500,600,700,800,900&display=swap';
						
						// Remove existing Google Font link if any
						$( 'link[id*="dostart-google-fonts"]' ).remove();
						
						// Add new Google Font link
						$( '<link>' )
							.attr( {
								id: 'dostart-google-fonts',
								rel: 'stylesheet',
								href: fontUrl
							} )
							.appendTo( 'head' );
					} else {
						// Remove Google Font link if default selected
						$( 'link[id*="dostart-google-fonts"]' ).remove();
					}
					
					// Apply font to body
					$( 'body' ).css( 'font-family', fontFamily );
				}
			);
		}
	);

	//------- Typography - Font Size --------/
	wp.customize(
		'dostart_typography_font_size', function ( value ) {
			value.bind(
				function ( to ) {
					$( 'body' ).css( 'font-size', to );
				}
			);
		}
	);

	//------- Typography - Line Height --------/
	wp.customize(
		'dostart_typography_line_height', function ( value ) {
			value.bind(
				function ( to ) {
					$( 'body' ).css( 'line-height', to );
				}
			);
		}
	);

	//------- Typography - Text Color --------/
	wp.customize(
		'dostart_typography_color', function ( value ) {
			value.bind(
				function ( to ) {
					$( 'body' ).css( 'color', to );
				}
			);
		}
	);

	//------- Theme Primary Color --------/
	wp.customize(
		'dostart_theme_primary_color', function ( value ) {
			value.bind(
				function ( to ) {
					var primaryColor = to;
					$( '.excerpt-readmore a, .back-to-top, .dostart-post .excerpt-date, .widget-title:before, .search-form:after, .comment-form p > input[type="submit"], .pagination .nav-links .page-numbers.current, .pagination .nav-links .page-numbers:hover, .search-form::before, .woocommerce ul.products li.product .onsale, .download-item-image .onsale, .preview-btn li a:hover, .button' )
						.css( 'background-color', primaryColor + ' !important' );
					$( '.preview-btn li a' )
						.css( {
							'border-color': primaryColor + ' !important',
							'color': primaryColor
						} );
					$( '.woocommerce-MyAccount-navigation ul li.is-active a' )
						.css( 'color', primaryColor );
				}
			);
		}
	);

	//------- Theme Title Color --------/
	wp.customize(
		'dostart_theme_title_color', function ( value ) {
			value.bind(
				function ( to ) {
					$( 'h1, h2, h3, h4, h5, h6' ).css( 'color', to );
				}
			);
		}
	);

	//------- Back To Top Background --------/
	wp.customize(
		'dostart_backtotop_bg', function ( value ) {
			value.bind(
				function ( to ) {
					$( 'div.back-to-top' ).css( 'background', to );
				}
			);
		}
	);

	//------- Primary Menu Color --------/
	wp.customize(
		'dostart_primary_menu_color', function ( value ) {
			value.bind(
				function ( to ) {
					$( '.dostart-mainmenu ul li a' ).css( 'color', to );
				}
			);
		}
	);

	//------- Breadcrumb Background Color --------/
	wp.customize(
		'dostart_breaccrumb_bg_color', function ( value ) {
			value.bind(
				function ( to ) {
					$( '.dostart-breadcrumb' ).css( 'background-color', to );
				}
			);
		}
	);

	//------- Breadcrumb Background Image --------/
	wp.customize(
		'dostart_breaccrumb_bg_image', function ( value ) {
			value.bind(
				function ( to ) {
					if ( '' !== to ) {
						$( '.dostart-breadcrumb' ).css( {
							'background-image': 'url("' + to + '")',
							'background-repeat': 'repeat',
							'background-position': 'center center',
							'background-size': 'cover',
							'background-attachment': 'scroll'
						} );
					} else {
						$( '.dostart-breadcrumb' ).css( 'background-image', 'none' );
					}
				}
			);
		}
	);

	//------- Breadcrumb Title Color --------/
	wp.customize(
		'dostart_breadcrumb_title_color', function ( value ) {
			value.bind(
				function ( to ) {
					$( '.breadcrumb-inner-content h1, .dostart-breadcrumb a, .dostart-breadcrumb li' ).css( 'color', to );
				}
			);
		}
	);

	//------- Footer Widget Background --------/
	wp.customize(
		'dostart_footer_widget_bg', function ( value ) {
			value.bind(
				function ( to ) {
					$( '.footer-top-widgets' ).css( 'background', to );
				}
			);
		}
	);

	//-------- Footer Background --------------
	wp.customize(
		'dostart_footer_bg', function ( value ) {
			value.bind(
				function ( newval ) {
					$( '.dostart-footer-area' ).css( 'background-color', newval );
				}
			);
		}
	);

	//------- Footer Copyright Text Color --------/
	wp.customize(
		'dostart_copyright_text_color', function ( value ) {
			value.bind(
				function ( to ) {
					$( '.copyright-text p' ).css( 'color', to );
				}
			);
		}
	);

	//------- Copyright Text --------/
	wp.customize(
		'dostart_copyright_text', function ( value ) {
			value.bind(
				function ( to ) {
					$( '.copyright-text' ).html( to );
				}
			);
		}
	);

}( jQuery ) );
