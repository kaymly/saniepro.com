<?php 
add_filter( 'elementor/icons_manager/additional_tabs', 'themesflat_iconpicker_register' );

function themesflat_iconpicker_register( $icons = array() ) {
	
	$icons['janelas_icon'] = array(
		'name'          => 'janelas_icon',
		'label'         => esc_html__( 'janelas Icons', 'themesflat-elementor' ),
		'labelIcon'     => 'janelas-icon-tall-window',
		'prefix'        => '',
		'displayPrefix' => '',
		'url'           => THEMESFLAT_LINK . 'css/icon-janelas.css',
		'fetchJson'     => URL_THEMESFLAT_ADDONS_ELEMENTOR_THEME . 'assets/css/janelas_fonts_default.json',
		'ver'           => '1.0.0',
	);	

	return $icons;
}