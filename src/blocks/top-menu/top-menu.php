	$aero_l10n = array();

//	write_log('main-menu-test');

	if ( has_nav_menu( 'main-menu-top' ) ) {
//		write_log('HAS main-menu-top');
		wp_enqueue_script( 'aero-navigation', get_theme_file_uri( '/js/main-menu.js' ), array(), '1.0', true );
		$aero_l10n['expand']   = __( 'Expand child menu', 'aero' );
		$aero_l10n['collapse'] = __( 'Collapse child menu', 'aero' );
		$aero_l10n['icon']     = aero_get_svg(
			array(
				'icon'     => 'angle-down',
				'fallback' => true,
			)
		);
	}

	wp_localize_script( 'aero-navigation', 'aeroScreenReaderText', $aero_l10n );
