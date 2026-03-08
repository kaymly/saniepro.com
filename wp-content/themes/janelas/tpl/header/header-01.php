<?php 
$header_search_box = themesflat_get_opt('header_search_box');
if (themesflat_get_opt_elementor('header_search_box') != '') {
    $header_search_box = themesflat_get_opt_elementor('header_search_box');
}
$header_wishlist_icon = themesflat_get_opt('header_wishlist_icon');
if (themesflat_get_opt_elementor('header_wishlist_icon') != '') {
    $header_wishlist_icon = themesflat_get_opt_elementor('header_wishlist_icon');
}
$header_cart_icon = themesflat_get_opt('header_cart_icon');
if (themesflat_get_opt_elementor('header_cart_icon') != '') {
    $header_cart_icon = themesflat_get_opt_elementor('header_cart_icon');
}
$header_sidebar_toggler = themesflat_get_opt('header_sidebar_toggler');
if (themesflat_get_opt_elementor('header_sidebar_toggler') != '') {
    $header_sidebar_toggler = themesflat_get_opt_elementor('header_sidebar_toggler');
}
?>
<?php get_template_part( 'tpl/topbar'); ?>
<header id="header" class="header header-style1 <?php echo themesflat_get_opt_elementor('extra_classes_header'); ?>">
    <div class="inner-header">  
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="header-wrap clearfix">
                        <div class="header-ct-left"><?php get_template_part( 'tpl/header/brand'); ?></div>
                        <div class="header-ct-center"><?php get_template_part( 'tpl/header/navigator'); ?></div>
                        <div class="header-ct-right">
                            <?php if ( $header_search_box == 1 ) :?>
                            <div class="show-search">
                                <a href="#"><i class="janelas-icon-search"></i></a> 
                                <div class="submenu top-search widget_search">
                                    <?php get_search_form(); ?>
                                </div>        
                            </div> 
                            <?php endif;?>

                            <?php if ( $header_wishlist_icon == 1 ) :?>
                                <?php get_template_part( 'tpl/header/header-wishlist'); ?>
                            <?php endif;?>

                            <?php if ( $header_cart_icon == 1 ) :?>
                                <?php get_template_part( 'tpl/header/header-cart'); ?>
                            <?php endif;?>

                            <div class="btn-menu">
                                <span class="line-1"></span>
                            </div><!-- //mobile menu button -->

                            <?php if ( themesflat_get_opt('header_button_text') != '' && themesflat_get_opt('header_button_url') != '' ) :?>
                            <div class="wrap-btn-header draw-border">
                                <a class="btn-header" href="<?php echo esc_url(themesflat_get_opt('header_button_url')) ?>"><?php echo themesflat_get_opt('header_button_text'); ?></a> 
                            </div>
                            <?php endif;?>

                            <?php if ( $header_sidebar_toggler == 1 ) :?>
                            <div class="header-modal-menu-left-btn">
                                <div class="modal-menu-left-btn">
                                    <div class="line line--1"></div>
                                    <div class="line line--2"></div>
                                    <div class="line line--3"></div>
                                </div>
                            </div><!-- /.header-modal-menu-left-btn -->
                            <?php endif;?>

                            
                        </div>
                    </div>                
                </div><!-- /.col-md-12 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </div>

    <div class="canvas-nav-wrap">
        <div class="overlay-canvas-nav"><div class="canvas-menu-close"><span></span></div></div>
        <div class="inner-canvas-nav">
            <?php get_template_part( 'tpl/header/brand-mobile'); ?>
            <nav id="mainnav_canvas" class="mainnav_canvas" role="navigation">
                <?php
                    wp_nav_menu( array( 'theme_location' => 'primary', 'fallback_cb' => 'themesflat_menu_fallback', 'container' => false ) );
                ?>
            </nav><!-- #mainnav_canvas -->  
        </div>
    </div><!-- /.canvas-nav-wrap --> 
</header><!-- /.header --> 