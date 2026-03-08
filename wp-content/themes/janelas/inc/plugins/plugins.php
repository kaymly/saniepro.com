<?php
// Register action to declare required plugins
add_action('tgmpa_register', 'themesflat_recommend_plugin');
function themesflat_recommend_plugin() {
    
    $plugins = array(
        array(
            'name' => esc_html__('Elementor', 'janelas'),
            'slug' => 'elementor',
            'required' => true
        ),
        array(
            'name' => esc_html__('ThemesFlat', 'janelas'),
            'slug' => 'themesflat',
            'source' => THEMESFLAT_DIR . 'inc/plugins/themesflat.zip',
            'required' => true
        ),
        array(
            'name' => esc_html__('Themesflat Elementor', 'janelas'),
            'slug' => 'themesflat-elementor',
            'source' => THEMESFLAT_DIR . 'inc/plugins/themesflat-elementor.zip',
            'required' => true
        ), 
        array(
            'name' => esc_html__('Advanced Custom Fields PRO', 'janelas'),
            'slug' => 'advanced-custom-fields-pro',
            'source' => THEMESFLAT_DIR . 'inc/plugins/advanced-custom-fields-pro.zip',
            'required' => true
        ),
        array(
            'name' => esc_html__('Revslider', 'janelas'),
            'slug' => 'revslider',
            'source' => THEMESFLAT_DIR . 'inc/plugins/revslider.zip',
            'required' => false
        ),
        array(
            'name' => esc_html__('Contact Form 7', 'janelas'),
            'slug' => 'contact-form-7',
            'required' => false
        ),    
        array(
            'name' => esc_html__('Mailchimp', 'janelas'),
            'slug' => 'mailchimp-for-wp',
            'required' => false
        ),        
        array(
            'name' => esc_html__('WooCommerce', 'janelas'),
            'slug' => 'woocommerce',
            'required' => false
        ),
        array(
            'name' => esc_html__('YITH WooCommerce Wishlist', 'janelas'),
            'slug' => 'yith-woocommerce-wishlist',
            'required' => false
        ),
        array(
            'name' => esc_html__('YITH WooCommerce Quick View', 'janelas'),
            'slug' => 'yith-woocommerce-quick-view',
            'required' => false
        ),
        array(
            'name' => esc_html__('YITH WooCommerce Badge Management', 'janelas'),
            'slug' => 'yith-woocommerce-badges-management',
            'required' => false
        ),     
        array(
            'name' => esc_html__('One Click Demo Import', 'janelas'),
            'slug' => 'one-click-demo-import',
            'required' => false
        )   
    );
    
    tgmpa($plugins);
}

