<?php
class themesflat_socials extends WP_Widget {
    /**
     * Holds widget settings defaults, populated in constructor.
     *
     * @var array
     */
    protected $defaults;

    /**
     * Constructor
     *
     * @return themesflat_socials
     */
    function __construct() {
        $this->defaults = array(
            'title'         => 'Socials',
            'value'         => 'facebook',
        );
        parent::__construct(
            'widget_themesflat_socials',
            esc_html__( 'Themesflat - Socials', 'themesflat' ),
            array(
                'classname'   => 'widget_themesflat_socials',
                'description' => esc_html__( 'Themesflat Socials.', 'themesflat' )
            )
        );
    }

    /**
     * Display widget
     */
    function widget( $args, $instance ) {
        $instance = wp_parse_args( $instance, $this->defaults );
        extract( $instance );
        extract( $args );
        echo wp_kses_post( $before_widget );
        if ( !empty($title) ) echo wp_kses_post($before_title).esc_html($title).wp_kses_post($after_title);?>
        <?php $this->themesflat_render_social_widget('',$instance['value'],true);?>
        <?php echo wp_kses_post( $after_widget );
    }

    /**
     * Update widget
     */
    function update( $new_instance, $old_instance ) {
        $instance                   = $old_instance;
        $instance['title']          = strip_tags( $new_instance['title'] );
        $instance['value']          = ( $new_instance['value'] );
        
        return $instance;
    }

    /**
     * Widget setting
     */
    function form( $instance ) {
        wp_enqueue_script('themesflat_customizer_js');
        $instance = wp_parse_args( $instance, $this->defaults );
        $icons = $this->themesflat_available_social_icons_widget();
        $value = $instance['value'];
        $order = $icons['__ordering__'];
        if ( ! is_array( $value ) ) {
            $decoded_value = json_decode(str_replace('&quot;', '"', $value), true );
            $value = is_array( $decoded_value ) ? $decoded_value : array();
        }
        if ( isset( $value['__ordering__'] ) && is_array( $value['__ordering__'] ) )
            $order = $value['__ordering__'];
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'themesflat' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>">
        </p>
        <div class="themesflat_widget_socials themesflat-options-control-social-icons">
            <ul class="themesflat_icons">
                <li class="item-properties">
                    <label>
                        <span class="input-title"></span>
                        <input type="text" class="input-field" />
                    </label>
                    <button type="button" class="button button-primary confirm"><i class="fa fa-check"></i></button>
                </li>
                <?php foreach ( $order as $id ):
                    $params = $icons[$id];                    
                    $link = isset( $value[$id] ) ? sprintf( 'data-link="%s"', esc_attr( $value[$id] ) ) : '';
                    ?>
                    <li class="item flat-<?php  echo esc_attr( $id ) ?>" data-id="<?php  echo esc_attr( $id ) ?>" <?php  echo esc_attr($link) ?> data-title="<?php  echo esc_attr( $params['title'] ) ?>">
                        <i class="<?php  echo esc_attr( $params['iclass'] ) ?>"></i>
                    </li>
                <?php endforeach ?>
            </ul>
            <input type="hidden" id="typography-value"  name="<?php  echo esc_attr($this->get_field_name('value'));?>"  value="<?php  echo esc_attr(  $instance['value'] ) ?>" />
        </div>
    <?php
    }

    function themesflat_available_social_icons_widget() {
        $icons = apply_filters( 'themesflat_available_icons', array(
            'twitter'        => array( 'iclass' => 'fab fa-twitter', 'title' => 'Twitter' ),
            'facebook'       => array( 'iclass' => 'fab fa-facebook-f', 'title' => 'Facebook' ),
            'google-plus'    => array( 'iclass' => 'fab fa-google-plus-g', 'title' => 'Google Plus' ),
            'pinterest'      => array( 'iclass' => 'fab fa-pinterest', 'title' => 'Pinterest' ),
            'instagram'      => array( 'iclass' => 'fab fa-instagram', 'title' => 'Instagram' ),
            'youtube'        => array( 'iclass' => 'fab fa-youtube', 'title' => 'Youtube' ),
            'vimeo'          => array( 'iclass' => 'fab fa-vimeo', 'title' => 'Vimeo' ),
            'linkedin'       => array( 'iclass' => 'fab fa-linkedin-in', 'title' => 'LinkedIn' ),
            'behance'        => array( 'iclass' => 'fab fa-behance', 'title' => 'Behance' ),
            'bitcoin'        => array( 'iclass' => 'fab fa-bitcoin', 'title' => 'Bitcoin' ),
            'bitbucket'      => array( 'iclass' => 'fab fa-bitbucket', 'title' => 'BitBucket' ),
            'codepen'        => array( 'iclass' => 'fab fa-codepen', 'title' => 'Codepen' ),
            'delicious'      => array( 'iclass' => 'fab fa-delicious', 'title' => 'Delicious' ),
            'deviantart'     => array( 'iclass' => 'fab fa-deviantart', 'title' => 'DeviantArt' ),
            'digg'           => array( 'iclass' => 'fab fa-digg', 'title' => 'Digg' ),
            'dribbble'       => array( 'iclass' => 'fab fa-dribbble', 'title' => 'Dribbble' ),
            'flickr'         => array( 'iclass' => 'fab fa-flickr', 'title' => 'Flickr'),
            'foursquare'     => array( 'iclass' => 'fab fa-foursquare', 'title' => 'Foursquare' ),
            'github'         => array( 'iclass' => 'fab fa-github-alt', 'title' => 'Github' ),
            'jsfiddle'       => array( 'iclass' => 'fab fa-jsfiddle', 'title' => 'JSFiddle' ),
            'reddit'         => array( 'iclass' => 'fab fa-reddit', 'title' => 'Reddit' ),
            'skype'          => array( 'iclass' => 'fab fa-skype', 'title' => 'Skype' ),
            'slack'          => array( 'iclass' => 'fab fa-slack', 'title' => 'Slack' ),
            'soundcloud'     => array( 'iclass' => 'fab fa-soundcloud', 'title' => 'SoundCloud' ),
            'spotify'        => array( 'iclass' => 'fab fa-spotify', 'title' => 'Spotify' ),
            'stack-exchange' => array( 'iclass' => 'fab fa-stack-exchange', 'title' => 'Stack Exchange' ),
            'stack-overflow' => array( 'iclass' => 'fab fa-stack-overflow', 'title' => 'Stach Overflow' ),
            'steam'          => array( 'iclass' => 'fab fa-steam', 'title' => 'Steam' ),
            'stumbleupon'    => array( 'iclass' => 'fab fa-stumbleupon', 'title' => 'Stumbleupon'),
            'tumblr'         => array( 'iclass' => 'fab fa-tumblr', 'title' => 'Tumblr' ),
            'rss'            => array( 'iclass' => 'fas fa-rss', 'title' => 'RSS' )
        ) );

        $icons['__ordering__'] = array_keys( $icons );

        return $icons;
    }

    function themesflat_render_social_widget($prefix = '',$value='',$show_title=false) {
        if ($value == '') {
            $value = $this->themesflat_get_json_widget('social_links');
        }
        $class= array();
        $class[] = ($show_title == false ? 'themesflat-socials' : 'themesflat-shortcode-socials');

        if ( ! is_array( $value ) ) {
            $decoded_value = json_decode($value, true );
            $value = is_array( $decoded_value ) ? $decoded_value : array();
        }

        $icons = $this->themesflat_available_social_icons_widget();

        ?>
        <ul class="<?php echo esc_attr(implode(" ", $class));?>">
            <?php
            foreach ( $value as $key => $val ) {
                if ($key != '__ordering__') {
                    $title = ($show_title == false ? '' : $icons[$key]['title']);
                    $icon = ($show_title == false ? '' : $icons[$key]['iclass']);
                    printf(
                        '<li class="%s">
                            <a href="%s" target="_blank" rel="alternate" title="%s">
                                <i class="%s"></i>                            
                            </a>
                        </li>',
                        esc_attr( $key ),
                        esc_url( $val ),
                        esc_attr( $val ),
                        esc_attr( $icon ),
                        esc_html($title)
                    );
                }
        }
            ?>
        </ul><!-- /.social -->       
        <?php 
    }
}

add_action( 'widgets_init', 'themesflat_socials_widget' );

/**
 * Register widget
 *
 * @return void
 * @since 1.0
 */
function themesflat_socials_widget() {
    register_widget( 'themesflat_socials' );
}