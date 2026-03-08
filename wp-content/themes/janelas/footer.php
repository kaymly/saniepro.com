<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package janelas
 */
?>        
        </div><!-- #content -->
    </div><!-- #main-content -->

    <?php get_template_part( 'tpl/action-box'); ?>
    <?php get_template_part( 'tpl/partner'); ?>

    <!-- Start Footer -->   
    <div class="footer_background <?php echo themesflat_get_opt_elementor('extra_classes_footer'); ?>">
        <div class="overlay-footer"></div>
        <!-- Info Footer -->
        <?php get_template_part( 'tpl/footer/info-footer'); ?>

        <!-- Footer Widget -->
        <?php get_template_part( 'tpl/footer/footer-widgets'); ?>
       
        <!-- Bottom -->
        <?php get_template_part( 'tpl/footer/bottom'); ?>
        
    </div> <!-- Footer Background Image --> 
    <!-- End Footer --> 

    <?php if ( themesflat_get_opt( 'go_top') == 1 ) : ?>
        <!-- Go Top -->
        <a class="go-top">
            <i class="fa fa-chevron-up"></i>
        </a>
    <?php endif; ?> 
</div><!-- /#boxed -->
<?php wp_footer(); ?>
</body>
</html>