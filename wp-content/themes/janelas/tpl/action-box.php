<?php if ( is_page_template( 'tpl/front-page.php' ) || is_404() || get_page_template_slug( get_queried_object_id() ) == 'elementor_header_footer' ) { return; } ?>

<?php 
    $show_action_box = themesflat_get_opt('show_action_box');
    if( $show_action_box == 1 ): 
?>
<div class="action-box themesflat-action-box">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="inner">
                    <div class="heading-wrap">
                        <h2 class="heading"><?php echo themesflat_get_opt('heading_action_box'); ?></h2>
                        <p><?php echo themesflat_get_opt('text_action_box'); ?></p>
                    </div>                
                    <div class="button-wrap">
                        <a href="#" class="themesflat-button"><?php echo wp_kses( themesflat_get_opt('text_button_action_box'), themesflat_kses_allowed_html() ); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
