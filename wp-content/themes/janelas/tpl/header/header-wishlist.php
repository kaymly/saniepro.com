<?php
// Cart Icon
if ( class_exists( 'YITH_WCWL' ) ) { ?>
    <div class="header-wishlist-wrapper">
        <a class="nav-wishlist-trigger" href="<?php echo esc_url( htmlspecialchars( YITH_WCWL()->get_wishlist_url() ) ); ?>" >
            <?php echo themesflat_svg( 'wishlist' ); ?>
            
            <?php if ( yith_wcwl_count_all_products() ): ?>
                <span class="wishlist-items-count"><?php echo yith_wcwl_count_all_products(); ?></span>
            <?php else: ?>
                <span class="wishlist-items-count">0</span>
            <?php endif ?>
        </a>
    </div>

<?php  } ?>
