<?php 
// ADD SECTION SHOP ARCHIVE
$wp_customize->add_section('section_shop_archive',array(
    'title'         => 'Shop Archive',
    'priority'      => 1,
    'panel'         => 'shop_panel',
));
require THEMESFLAT_DIR . "inc/customizer/shop/shop-archive.php";

// ADD SECTION SHOP SINGLE
$wp_customize->add_section('section_shop_single',array(
    'title'         => 'Shop Single',
    'priority'      => 20,
    'panel'         => 'shop_panel',
));
require THEMESFLAT_DIR . "inc/customizer/shop/shop-single.php";