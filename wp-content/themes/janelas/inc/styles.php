<?php
/**
 * @package janelas
 */
//Output all custom styles for this theme

function themesflat_custom_styles( $custom ) {
	$custom = '';

	//GROUP FONT
		$font = themesflat_get_json('typography_body');

		$font_style = themesflat_font_style($font['style']);

		/*Typography Body*/
			$body_fonts = $font['family'];
			$body_line_height = $font['line_height'];
			$body_font_weight = $font_style[0];
			$body_font_style = $font_style[1];
			$body_size = $font['size'];
			$body_letter_spacing = $font['letter_spacing'];
		
			// font family
			if ( $body_fonts !='' ) {
				$custom .= "body,button,input,select,textarea { font-family:" . $body_fonts . ";}"."\n";
			}

			// font family important
			if ( $body_fonts !='' ) {
				$custom .= ".blog-single .entry-content .icon-list { font-family:" . $body_fonts . "!important;}"."\n";
			}

			// font weight
			if ( $body_font_weight !='' ) {
				$custom .= "body,button,input,select,textarea { font-weight:" . $body_font_weight . ";}"."\n";
			}
			// font style
			if ( isset( $body_font_style ) ) {
		        $custom .= "body,button,input,select,textarea { font-style:" . $body_font_style . "; }"."\n";        
			}
		    // font size
		    if ( $body_size !=''  ) {
		        $custom .= "body,button,input,select,textarea { font-size:" . intval( $body_size ) . "px; }"."\n";    
		    }
		    // line height
		    if ( $body_line_height != '' ) {
		        $custom .= "body,button,input,select,textarea { line-height:" . $body_line_height . ";}"."\n";    
		    }
		    // letter spacing
		    if ( $body_letter_spacing != '' ) {
		        $custom .= "body,button,input,select,textarea { letter-spacing:" . $body_letter_spacing . ";}"."\n";    
		    }

		/*Typography Headings*/
			$headings_fonts_ = themesflat_get_json('typography_headings');
			$headings_fonts_family = $headings_fonts_['family'];
			$headings_style = themesflat_font_style( $headings_fonts_['style'] );
			$headings_font_weight = $headings_style[0];
			$headings_font_style = $headings_style[1];
			$headings_line_height = $headings_fonts_['line_height'];
			$headings_letter_spacing = $headings_fonts_['letter_spacing'];
	    	    	
			// font family
			if ( $headings_fonts_family !='' ) {
				$custom .= "h1,h2,h3,h4,h5,h6 { font-family:" . $headings_fonts_family . ";}"."\n";

			}
			//font weight
			if ( $headings_font_weight !='' ) {
				$custom .= "h1,h2,h3,h4,h5,h6 { font-weight:" . $headings_font_weight . ";}"."\n";
			}
			//line height
			if ( $headings_line_height !='' ) {
				$custom .= "h1,h2,h3,h4,h5,h6 { line-height:" . $headings_line_height . ";}"."\n";
			}
			// letter spacing
			if ( $headings_letter_spacing !='' ) {
				$custom .= "h1,h2,h3,h4,h5,h6 { letter-spacing:" . $headings_letter_spacing . ";}"."\n";
			}
			// font style
			if ( isset( $headings_font_style )) {
		        $custom .= "h1,h2,h3,h4,h5,h6  { font-style:" . $headings_font_style . "; }"."\n";
			}

			// H1 font size
			if ( $h1_size = themesflat_get_opt( 'h1_size' ) ) {
				$custom .= "h1 { font-size:" . intval($h1_size) . "px; }"."\n";
			}
		    // H2 font size
		    if ( $h2_size = themesflat_get_opt( 'h2_size' ) ) {
		        $custom .= "h2 { font-size:" . intval($h2_size) . "px; }"."\n";
		    }
		    // H3 font size
		    if ( $h3_size = themesflat_get_opt( 'h3_size' ) ) {
		        $custom .= "h3 { font-size:" . intval($h3_size) . "px; }"."\n";
		    }
		    // H4 font size
		    if ( $h4_size = themesflat_get_opt( 'h4_size' ) ) {
		        $custom .= "h4 { font-size:" . intval($h4_size) . "px; }"."\n";
		    }
		    // H5 font size
		    if ( $h5_size = themesflat_get_opt( 'h5_size' ) ) {
		        $custom .= "h5 { font-size:" . intval($h5_size) . "px; }"."\n";
		    }
		    // H6 font size
		    if ( $h6_size = themesflat_get_opt( 'h6_size' ) ) {
		        $custom .= "h6 { font-size:" . intval($h6_size) . "px; }"."\n";
		    }

		/*Typography Menu*/	
			$menu_fonts_ = themesflat_get_json('typography_menu');
			$menu_fonts_family = $menu_fonts_['family'];
			$menu_fonts_size = $menu_fonts_['size'];
			$menu_line_height = $menu_fonts_['line_height'];
			$menu_letter_spacing = $menu_fonts_['letter_spacing'];
			$menu_style = themesflat_font_style( $menu_fonts_['style'] );
			$menu_font_weight = $menu_style[0];
			$menu_font_style = $menu_style[1];
				
			// font family
			if ( $menu_fonts_family != '') {
				$custom .= "#mainnav > ul > li > a, .header-modal-menu-left-btn .text, header .flat-information li { font-family:" . $menu_fonts_family . ";}"."\n";
			}
			// font weight
			if ( $menu_font_weight != '' ) {
				$custom .= "#mainnav > ul > li > a, .header-modal-menu-left-btn .text { font-weight:" . $menu_font_weight . ";}"."\n";
			}
			// font style
			if ( isset( $menu_font_style )) {
		        $custom .= "#mainnav > ul > li > a, .header-modal-menu-left-btn .text  { font-style:" . $menu_font_style . "; }"."\n";   
			}
		    // font size
		    if ( $menu_fonts_size != '' ) {
		        $custom .= "#mainnav ul li a, .header-modal-menu-left-btn .text, header .flat-information li { font-size:" . intval($menu_fonts_size) . "px;}"."\n";
		    }
		    // line height
		    if ( $menu_line_height != '' ) {
		        $custom .= "#mainnav > ul > li > a, #header .show-search, header .block a, #header .mini-cart-header .cart-count, #header .mini-cart .cart-count, .button-menu { line-height:" . $menu_line_height . ";}"."\n";
		        $custom .= "#header.header-sticky #mainnav > ul > li > a, #header.header-sticky .show-search a, #header.header-sticky .block a, #header.header-sticky .mini-cart-header .cart-count, #header.header-sticky .mini-cart .cart-count, #header.header-sticky .button-menu { line-height:calc(" . $menu_line_height . " / 1.2);}"."\n";
		    }
		    // letter spacing
		    if ( $menu_letter_spacing != '' ) {
		        $custom .= "#mainnav > ul > li > a, #header .show-search a, header .block a, #header .mini-cart-header .cart-count, #header .mini-cart .cart-count, .button-menu { letter-spacing:" . $menu_letter_spacing . ";}"."\n";
		    }

		/*Typography Sub menu*/
			$sub_menu_fonts_ = themesflat_get_json('typography_sub_menu');
			$sub_menu_fonts_family = $sub_menu_fonts_['family'];
			$sub_menu_fonts_size = $sub_menu_fonts_['size'];
			$sub_menu_line_height = $sub_menu_fonts_['line_height'];
			$sub_menu_letter_spacing = $sub_menu_fonts_['letter_spacing'];
			$sub_menu_style = themesflat_font_style( $sub_menu_fonts_['style'] );
			$sub_menu_font_weight = $sub_menu_style[0];
			$sub_menu_font_style = $sub_menu_style[1];
		
			// font family
			if ( $sub_menu_fonts_family != '') {
				$custom .= "#mainnav ul.sub-menu > li > a { font-family:" . $sub_menu_fonts_family . ";}"."\n";
			}
			// font weight
			if ( $sub_menu_font_weight != '' ) {
				$custom .= "#mainnav ul.sub-menu > li > a { font-weight:" . $sub_menu_font_weight . ";}"."\n";
			}
			// font style
			if ( isset( $sub_menu_font_style )) {
		        $custom .= "#mainnav ul.sub-menu > li > a  { font-style:" . $sub_menu_font_style . "; }"."\n";   
			}
		    // font size
		    if ( $sub_menu_fonts_size != '' ) {
		        $custom .= "#mainnav ul.sub-menu > li > a { font-size:" . intval($sub_menu_fonts_size) . "px;}"."\n";
		    }
		    // line height
		    if ( $sub_menu_line_height != '' ) {
		        $custom .= "#mainnav ul.sub-menu > li > a { line-height:" . $sub_menu_line_height . ";}"."\n";
		    } 
		    // letter spacing
		    if ( $sub_menu_letter_spacing != '' ) {
		        $custom .= "#mainnav ul.sub-menu > li > a { letter-spacing:" . $sub_menu_letter_spacing . ";}"."\n";
		    } 

		/*Typography Blockquote*/	
		    $blockquote_fonts_ = themesflat_get_json('typography_blockquote');
			$blockquote_fonts_family = $blockquote_fonts_['family'];
			$blockquote_fonts_size = $blockquote_fonts_['size'];
			$blockquote_line_height = $blockquote_fonts_['line_height'];
			$blockquote_letter_spacing = $blockquote_fonts_['letter_spacing'];
			$blockquote_style = themesflat_font_style( $blockquote_fonts_['style'] );
			$blockquote_font_weight = $blockquote_style[0];
			$blockquote_font_style = $blockquote_style[1]; 
			// font family
			if ( $blockquote_fonts_family != '') {
				$custom .= "blockquote { font-family:" . $blockquote_fonts_family . ";}"."\n";
			}
			// font weight
			if ( $blockquote_font_weight != '' ) {
				$custom .= "blockquote { font-weight:" . $blockquote_font_weight . ";}"."\n";
			}
			// font style
			if ( isset( $blockquote_font_style )) {
		        $custom .= "blockquote { font-style:" . $blockquote_font_style . "; }"."\n";  
			}
		    // font size
		    if ( $blockquote_fonts_size != '' ) {
		        $custom .= "blockquote { font-size:" . intval($blockquote_fonts_size) . "px;}"."\n";
		    }
		    // line height
		    if ( $blockquote_line_height != '' ) {
		        $custom .= "blockquote { line-height:" . $blockquote_line_height . ";}"."\n";
		    } 
		    // letter spacing
		    if ( $blockquote_letter_spacing != '' ) {
		        $custom .= "blockquote { letter-spacing:" . $blockquote_letter_spacing . ";}"."\n";
		    }

		/*Typography blog post title*/ 
			$blog_post_title_fonts_ = themesflat_get_json('typography_blog_post_title');
			$blog_post_title_fonts_family = $blog_post_title_fonts_['family'];
			$blog_post_title_fonts_size = $blog_post_title_fonts_['size'];
			$blog_post_title_line_height = $blog_post_title_fonts_['line_height'];
			$blog_post_title_letter_spacing = $blog_post_title_fonts_['letter_spacing'];
			$blog_post_title_style = themesflat_font_style( $blog_post_title_fonts_['style'] );
			$blog_post_title_font_weight = $blog_post_title_style[0];
			$blog_post_title_font_style = $blog_post_title_style[1]; 
			// font family
			if ( $blog_post_title_fonts_family != '') {
				$custom .= "article .entry-title { font-family:" . $blog_post_title_fonts_family . ";}"."\n";
			}
			// font weight
			if ( $blog_post_title_font_weight != '' ) {
				$custom .= "article .entry-title { font-weight:" . $blog_post_title_font_weight . ";}"."\n";
			}
			// font style
			if ( isset( $blog_post_title_font_style )) {
		        $custom .= "article .entry-title { font-style:" . $blog_post_title_font_style . "; }"."\n";  
			}
		    // font size
		    if ( $blog_post_title_fonts_size != '' ) {
		        $custom .= "article .entry-title { font-size:" . intval($blog_post_title_fonts_size) . "px;}"."\n";
		    }
		    // line height
		    if ( $blog_post_title_line_height != '' ) {
		        $custom .= "article .entry-title { line-height:" . $blog_post_title_line_height . ";}"."\n";
		    } 
		    // letter spacing
		    if ( $blog_post_title_letter_spacing != '' ) {
		        $custom .= "article .entry-title { letter-spacing:" . $blog_post_title_letter_spacing . ";}"."\n";
		    }

		/*Typography blog post title*/ 
			$blog_post_meta_fonts_ = themesflat_get_json('typography_blog_post_meta');
			$blog_post_meta_fonts_family = $blog_post_meta_fonts_['family'];
			$blog_post_meta_fonts_size = $blog_post_meta_fonts_['size'];
			$blog_post_meta_line_height = $blog_post_meta_fonts_['line_height'];
			$blog_post_meta_letter_spacing = $blog_post_meta_fonts_['letter_spacing'];
			$blog_post_meta_style = themesflat_font_style( $blog_post_meta_fonts_['style'] );
			$blog_post_meta_font_weight = $blog_post_meta_style[0];
			$blog_post_meta_font_style = $blog_post_meta_style[1]; 
			// font family
			if ( $blog_post_meta_fonts_family != '') {
				$custom .= "article .post-meta .item-meta { font-family:" . $blog_post_meta_fonts_family . ";}"."\n";
			}
			// font weight
			if ( $blog_post_meta_font_weight != '' ) {
				$custom .= "article .post-meta .item-meta { font-weight:" . $blog_post_meta_font_weight . ";}"."\n";
			}
			// font style
			if ( isset( $blog_post_meta_font_style )) {
		        $custom .= "article .post-meta .item-meta { font-style:" . $blog_post_meta_font_style . "; }"."\n";  
			}
		    // font size
		    if ( $blog_post_meta_fonts_size != '' ) {
		        $custom .= "article .post-meta .item-meta { font-size:" . intval($blog_post_meta_fonts_size) . "px;}"."\n";
		    }
		    // line height
		    if ( $blog_post_meta_line_height != '' ) {
		        $custom .= "article .post-meta .item-meta { line-height:" . $blog_post_meta_line_height . ";}"."\n";
		    } 
		    // letter spacing
		    if ( $blog_post_meta_letter_spacing != '' ) {
		        $custom .= "article .post-meta .item-meta { letter-spacing:" . $blog_post_meta_letter_spacing . ";}"."\n";
		    }

		/*Typography blog post buttons*/	
		    $blog_post_buttons_fonts_ = themesflat_get_json('typography_blog_post_buttons');
			$blog_post_buttons_fonts_family = $blog_post_buttons_fonts_['family'];
			$blog_post_buttons_fonts_size = $blog_post_buttons_fonts_['size'];
			$blog_post_buttons_line_height = $blog_post_buttons_fonts_['line_height'];
			$blog_post_buttons_letter_spacing = $blog_post_buttons_fonts_['letter_spacing'];
			$blog_post_buttons_style = themesflat_font_style( $blog_post_buttons_fonts_['style'] );
			$blog_post_buttons_font_weight = $blog_post_buttons_style[0];
			$blog_post_buttons_font_style = $blog_post_buttons_style[1]; 
			// font family
			if ( $blog_post_buttons_fonts_family != '') {
				$custom .= "article .themesflat-button { font-family:" . $blog_post_buttons_fonts_family . ";}"."\n";
			}
			// font weight
			if ( $blog_post_buttons_font_weight != '' ) {
				$custom .= "article .themesflat-button { font-weight:" . $blog_post_buttons_font_weight . ";}"."\n";
			}
			// font style
			if ( isset( $blog_post_buttons_font_style )) {
		        $custom .= "article .themesflat-button { font-style:" . $blog_post_buttons_font_style . "; }"."\n";  
			}
		    // font size
		    if ( $blog_post_buttons_fonts_size != '' ) {
		        $custom .= "article .themesflat-button { font-size:" . intval($blog_post_buttons_fonts_size) . "px;}"."\n";
		    }
		    // line height
		    if ( $blog_post_buttons_line_height != '' ) {
		        $custom .= "article .themesflat-button { line-height:" . $blog_post_buttons_line_height . ";}"."\n";
		    } 
		    // letter spacing
		    if ( $blog_post_buttons_letter_spacing != '' ) {
		        $custom .= "article .themesflat-button { letter-spacing:" . $blog_post_buttons_letter_spacing . ";}"."\n";
		    }

		/*Typography blog single title*/	
		    $blog_single_title_fonts_ = themesflat_get_json('typography_blog_single_title');
			$blog_single_title_fonts_family = $blog_single_title_fonts_['family'];
			$blog_single_title_fonts_size = $blog_single_title_fonts_['size'];
			$blog_single_title_line_height = $blog_single_title_fonts_['line_height'];
			$blog_single_title_letter_spacing = $blog_single_title_fonts_['letter_spacing'];
			$blog_single_title_style = themesflat_font_style( $blog_single_title_fonts_['style'] );
			$blog_single_title_font_weight = $blog_single_title_style[0];
			$blog_single_title_font_style = $blog_single_title_style[1]; 
			// font family
			if ( $blog_single_title_fonts_family != '') {
				$custom .= ".single article .entry-title { font-family:" . $blog_single_title_fonts_family . ";}"."\n";
			}
			// font weight
			if ( $blog_single_title_font_weight != '' ) {
				$custom .= ".single article .entry-title { font-weight:" . $blog_single_title_font_weight . ";}"."\n";
			}
			// font style
			if ( isset( $blog_single_title_font_style )) {
		        $custom .= ".single article .entry-title { font-style:" . $blog_single_title_font_style . "; }"."\n";  
			}
		    // font size
		    if ( $blog_single_title_fonts_size != '' ) {
		        $custom .= ".single article .entry-title { font-size:" . intval($blog_single_title_fonts_size) . "px;}"."\n";
		    }
		    // line height
		    if ( $blog_single_title_line_height != '' ) {
		        $custom .= ".single article .entry-title { line-height:" . $blog_single_title_line_height . ";}"."\n";
		    } 
		    // letter spacing
		    if ( $blog_single_title_letter_spacing != '' ) {
		        $custom .= ".single article .entry-title { letter-spacing:" . $blog_single_title_letter_spacing . ";}"."\n";
		    }

		/*Typography blog single comment title*/	
		    $blog_single_comment_title_fonts_ = themesflat_get_json('typography_blog_single_comment_title');
			$blog_single_comment_title_fonts_family = $blog_single_comment_title_fonts_['family'];
			$blog_single_comment_title_fonts_size = $blog_single_comment_title_fonts_['size'];
			$blog_single_comment_title_line_height = $blog_single_comment_title_fonts_['line_height'];
			$blog_single_comment_title_letter_spacing = $blog_single_comment_title_fonts_['letter_spacing'];
			$blog_single_comment_title_style = themesflat_font_style( $blog_single_comment_title_fonts_['style'] );
			$blog_single_comment_title_font_weight = $blog_single_comment_title_style[0];
			$blog_single_comment_title_font_style = $blog_single_comment_title_style[1]; 
			// font family
			if ( $blog_single_comment_title_fonts_family != '') {
				$custom .= ".comment-title, .comment-reply-title, .comment-reply-title a { font-family:" . $blog_single_comment_title_fonts_family . ";}"."\n";
			}
			// font weight
			if ( $blog_single_comment_title_font_weight != '' ) {
				$custom .= ".comment-title, .comment-reply-title, .comment-reply-title a { font-weight:" . $blog_single_comment_title_font_weight . ";}"."\n";
			}
			// font style
			if ( isset( $blog_single_comment_title_font_style )) {
		        $custom .= ".comment-title, .comment-reply-title, .comment-reply-title a { font-style:" . $blog_single_comment_title_font_style . "; }"."\n";  
			}
		    // font size
		    if ( $blog_single_comment_title_fonts_size != '' ) {
		        $custom .= ".comment-title, .comment-reply-title, .comment-reply-title a { font-size:" . intval($blog_single_comment_title_fonts_size) . "px;}"."\n";
		    }
		    // line height
		    if ( $blog_single_comment_title_line_height != '' ) {
		        $custom .= ".comment-title, .comment-reply-title, .comment-reply-title a { line-height:" . $blog_single_comment_title_line_height . ";}"."\n";
		    } 
		    // letter spacing
		    if ( $blog_single_comment_title_letter_spacing != '' ) {
		        $custom .= ".comment-title, .comment-reply-title, .comment-reply-title a { letter-spacing:" . $blog_single_comment_title_letter_spacing . ";}"."\n";
		    }

		/*Typography sidebar widget title*/	
		    $sidebar_widget_title_fonts_ = themesflat_get_json('typography_sidebar_widget_title');
			$sidebar_widget_title_fonts_family = $sidebar_widget_title_fonts_['family'];
			$sidebar_widget_title_fonts_size = $sidebar_widget_title_fonts_['size'];
			$sidebar_widget_title_line_height = $sidebar_widget_title_fonts_['line_height'];
			$sidebar_widget_title_letter_spacing = $sidebar_widget_title_fonts_['letter_spacing'];
			$sidebar_widget_title_style = themesflat_font_style( $sidebar_widget_title_fonts_['style'] );
			$sidebar_widget_title_font_weight = $sidebar_widget_title_style[0];
			$sidebar_widget_title_font_style = $sidebar_widget_title_style[1]; 
			// font family
			if ( $sidebar_widget_title_fonts_family != '') {
				$custom .= ".sidebar .widget .widget-title, .sidebar .widget h2, .sidebar .wp-block-search .wp-block-search__label, .sidebar .wc-block-product-search .wc-block-product-search__label { font-family:" . $sidebar_widget_title_fonts_family . ";}"."\n";
			}
			// font weight
			if ( $sidebar_widget_title_font_weight != '' ) {
				$custom .= ".sidebar .widget .widget-title, .widget h2, .sidebar .wp-block-search .wp-block-search__label, .sidebar .wc-block-product-search .wc-block-product-search__label { font-weight:" . $sidebar_widget_title_font_weight . ";}"."\n";
			}
			// font style
			if ( isset( $sidebar_widget_title_font_style )) {
		        $custom .= ".sidebar .widget .widget-title, .widget h2, .sidebar .wp-block-search .wp-block-search__label, .sidebar .wc-block-product-search .wc-block-product-search__label { font-style:" . $sidebar_widget_title_font_style . "; }"."\n";  
			}
		    // font size
		    if ( $sidebar_widget_title_fonts_size != '' ) {
		        $custom .= ".sidebar .widget .widget-title, .widget h2, .sidebar .wp-block-search .wp-block-search__label, .sidebar .wc-block-product-search .wc-block-product-search__label { font-size:" . intval($sidebar_widget_title_fonts_size) . "px;}"."\n";
		    }
		    // line height
		    if ( $sidebar_widget_title_line_height != '' ) {
		        $custom .= ".sidebar .widget .widget-title, .widget h2, .sidebar .wp-block-search .wp-block-search__label, .sidebar .wc-block-product-search .wc-block-product-search__label { line-height:" . $sidebar_widget_title_line_height . ";}"."\n";
		    } 
		    // letter spacing
		    if ( $sidebar_widget_title_letter_spacing != '' ) {
		        $custom .= ".sidebar .widget .widget-title, .widget h2, .sidebar .wp-block-search .wp-block-search__label, .sidebar .wc-block-product-search .wc-block-product-search__label { letter-spacing:" . $sidebar_widget_title_letter_spacing . ";}"."\n";
		    }

		/*Typography footer widget title*/	
		    $footer_widget_title_fonts_ = themesflat_get_json('typography_footer_widget_title');
			$footer_widget_title_fonts_family = $footer_widget_title_fonts_['family'];
			$footer_widget_title_fonts_size = $footer_widget_title_fonts_['size'];
			$footer_widget_title_line_height = $footer_widget_title_fonts_['line_height'];
			$footer_widget_title_letter_spacing = $footer_widget_title_fonts_['letter_spacing'];
			$footer_widget_title_style = themesflat_font_style( $footer_widget_title_fonts_['style'] );
			$footer_widget_title_font_weight = $footer_widget_title_style[0];
			$footer_widget_title_font_style = $footer_widget_title_style[1]; 
			// font family
			if ( $footer_widget_title_fonts_family != '') {
				$custom .= "footer .widget .widget-title, footer .widget h2, footer .wp-block-search .wp-block-search__label { font-family:" . $footer_widget_title_fonts_family . ";}"."\n";
			}
			// font weight
			if ( $footer_widget_title_font_weight != '' ) {
				$custom .= "footer .widget .widget-title, footer .widget h2, footer .wp-block-search .wp-block-search__label { font-weight:" . $footer_widget_title_font_weight . ";}"."\n";
			}
			// font style
			if ( isset( $footer_widget_title_font_style )) {
		        $custom .= "footer .widget .widget-title, footer .widget h2, footer .wp-block-search .wp-block-search__label { font-style:" . $footer_widget_title_font_style . "; }"."\n";  
			}
		    // font size
		    if ( $footer_widget_title_fonts_size != '' ) {
		        $custom .= "footer .widget .widget-title, footer .widget h2, footer .wp-block-search .wp-block-search__label { font-size:" . intval($footer_widget_title_fonts_size) . "px;}"."\n";
		    }
		    // line height
		    if ( $footer_widget_title_line_height != '' ) {
		        $custom .= "footer .widget .widget-title, footer .widget h2, footer .wp-block-search .wp-block-search__label { line-height:" . $footer_widget_title_line_height . ";}"."\n";
		    } 
		    // letter spacing
		    if ( $footer_widget_title_letter_spacing != '' ) {
		        $custom .= "footer .widget .widget-title, footer .widget h2, footer .wp-block-search .wp-block-search__label { letter-spacing:" . $footer_widget_title_letter_spacing . ";}"."\n";
		    }

		/*Typography page title*/	
		    $page_title_fonts_ = themesflat_get_json('typography_page_title');
			$page_title_fonts_family = $page_title_fonts_['family'];
			$page_title_fonts_size = $page_title_fonts_['size'];
			$page_title_line_height = $page_title_fonts_['line_height'];
			$page_title_letter_spacing = $page_title_fonts_['letter_spacing'];
			$page_title_style = themesflat_font_style( $page_title_fonts_['style'] );
			$page_title_font_weight = $page_title_style[0];
			$page_title_font_style = $page_title_style[1]; 
			// font family
			if ( $page_title_fonts_family != '') {
				$custom .= ".page-title .page-title-heading { font-family:" . $page_title_fonts_family . ";}"."\n";
			}
			// font weight
			if ( $page_title_font_weight != '' ) {
				$custom .= ".page-title .page-title-heading { font-weight:" . $page_title_font_weight . ";}"."\n";
			}
			// font style
			if ( isset( $page_title_font_style )) {
		        $custom .= ".page-title .page-title-heading { font-style:" . $page_title_font_style . "; }"."\n";  
			}
		    // font size
		    if ( $page_title_fonts_size != '' ) {
		        $custom .= ".page-title .page-title-heading { font-size:" . intval($page_title_fonts_size) . "px;}"."\n";
		    }
		    // line height
		    if ( $page_title_line_height != '' ) {
		        $custom .= ".page-title .page-title-heading { line-height:" . $page_title_line_height . ";}"."\n";
		    } 
		    // letter spacing
		    if ( $page_title_letter_spacing != '' ) {
		        $custom .= ".page-title .page-title-heading { letter-spacing:" . $page_title_letter_spacing . ";}"."\n";
		    }

		/*Typography breadcrumb*/	
		    $breadcrumb_fonts_ = themesflat_get_json('typography_breadcrumb');
			$breadcrumb_fonts_family = $breadcrumb_fonts_['family'];
			$breadcrumb_fonts_size = $breadcrumb_fonts_['size'];
			$breadcrumb_line_height = $breadcrumb_fonts_['line_height'];
			$breadcrumb_letter_spacing = $breadcrumb_fonts_['letter_spacing'];
			$breadcrumb_style = themesflat_font_style( $breadcrumb_fonts_['style'] );
			$breadcrumb_font_weight = $breadcrumb_style[0];
			$breadcrumb_font_style = $breadcrumb_style[1]; 
			// font family
			if ( $breadcrumb_fonts_family != '') {
				$custom .= ".breadcrumbs, .breadcrumbs span a, .breadcrumbs a, .breadcrumbs span { font-family:" . $breadcrumb_fonts_family . ";}"."\n";
			}
			// font weight
			if ( $breadcrumb_font_weight != '' ) {
				$custom .= ".breadcrumbs, .breadcrumbs span a, .breadcrumbs a, .breadcrumbs span { font-weight:" . $breadcrumb_font_weight . ";}"."\n";
			}
			// font style
			if ( isset( $breadcrumb_font_style )) {
		        $custom .= ".breadcrumbs, .breadcrumbs span a, .breadcrumbs a, .breadcrumbs span { font-style:" . $breadcrumb_font_style . "; }"."\n";  
			}
		    // font size
		    if ( $breadcrumb_fonts_size != '' ) {
		        $custom .= ".breadcrumbs, .breadcrumbs span a, .breadcrumbs a, .breadcrumbs span { font-size:" . intval($breadcrumb_fonts_size) . "px;}"."\n";
		    }
		    // line height
		    if ( $breadcrumb_line_height != '' ) {
		        $custom .= ".breadcrumbs, .breadcrumbs span a, .breadcrumbs a, .breadcrumbs span { line-height:" . $breadcrumb_line_height . ";}"."\n";
		    } 
		    // letter spacing
		    if ( $breadcrumb_letter_spacing != '' ) {
		        $custom .= ".breadcrumbs, .breadcrumbs span a, .breadcrumbs a, .breadcrumbs span { letter-spacing:" . $breadcrumb_letter_spacing . ";}"."\n";
		    }

		/*Typography buttons*/	
		    $buttons_fonts_ = themesflat_get_json('typography_buttons');
			$buttons_fonts_family = $buttons_fonts_['family'];
			$buttons_fonts_size = $buttons_fonts_['size'];
			$buttons_line_height = $buttons_fonts_['line_height'];
			$buttons_letter_spacing = $buttons_fonts_['letter_spacing'];
			$buttons_style = themesflat_font_style( $buttons_fonts_['style'] );
			$buttons_font_weight = $buttons_style[0];
			$buttons_font_style = $buttons_style[1]; 
			// font family
			if ( $buttons_fonts_family != '') {
				$custom .= ".themesflat-button, button, input[type=\"button\"], input[type=\"reset\"], input[type=\"submit\"] { font-family:" . $buttons_fonts_family . ";}"."\n";
			}
			// font weight
			if ( $buttons_font_weight != '' ) {
				$custom .= ".themesflat-button, button, input[type=\"button\"], input[type=\"reset\"], input[type=\"submit\"] { font-weight:" . $buttons_font_weight . ";}"."\n";
			}
			// font style
			if ( isset( $buttons_font_style )) {
		        $custom .= ".themesflat-button, button, input[type=\"button\"], input[type=\"reset\"], input[type=\"submit\"] { font-style:" . $buttons_font_style . "; }"."\n";  
			}
		    // font size
		    if ( $buttons_fonts_size != '' ) {
		        $custom .= ".themesflat-button, button, input[type=\"button\"], input[type=\"reset\"], input[type=\"submit\"] { font-size:" . intval($buttons_fonts_size) . "px;}"."\n";
		    }
		    // line height
		    if ( $buttons_line_height != '' ) {
		        $custom .= ".themesflat-button, button, input[type=\"button\"], input[type=\"reset\"], input[type=\"submit\"] { line-height:" . $buttons_line_height . ";}"."\n";
		    } 
		    // letter spacing
		    if ( $buttons_letter_spacing != '' ) {
		        $custom .= ".themesflat-button, button, input[type=\"button\"], input[type=\"reset\"], input[type=\"submit\"] { letter-spacing:" . $buttons_letter_spacing . ";}"."\n";
		    }

		/*Typography pagination*/	
		    $pagination_fonts_ = themesflat_get_json('typography_pagination');
			$pagination_fonts_family = $pagination_fonts_['family'];
			$pagination_fonts_size = $pagination_fonts_['size'];
			$pagination_line_height = $pagination_fonts_['line_height'];
			$pagination_letter_spacing = $pagination_fonts_['letter_spacing'];
			$pagination_style = themesflat_font_style( $pagination_fonts_['style'] );
			$pagination_font_weight = $pagination_style[0];
			$pagination_font_style = $pagination_style[1]; 
			// font family
			if ( $pagination_fonts_family != '') {
				$custom .= ".navigation a, .pagination > span, .navigation.paging-navigation span, .page-links a, .page-links > span, .woocommerce-pagination ul li span, .woocommerce-pagination ul li a { font-family:" . $pagination_fonts_family . ";}"."\n";
			}
			// font weight
			if ( $pagination_font_weight != '' ) {
				$custom .= ".navigation a, .pagination > span, .navigation.paging-navigation span, .page-links a, .page-links > span, .woocommerce-pagination ul li span, .woocommerce-pagination ul li a { font-weight:" . $pagination_font_weight . ";}"."\n";
			}
			// font style
			if ( isset( $pagination_font_style )) {
		        $custom .= ".navigation a, .pagination > span, .navigation.paging-navigation span, .page-links a, .page-links > span, .woocommerce-pagination ul li span, .woocommerce-pagination ul li a { font-style:" . $pagination_font_style . "; }"."\n";  
			}
		    // font size
		    if ( $pagination_fonts_size != '' ) {
		        $custom .= ".navigation a, .pagination > span, .navigation.paging-navigation span, .page-links a, .page-links > span, .woocommerce-pagination ul li span, .woocommerce-pagination ul li a { font-size:" . intval($pagination_fonts_size) . "px;}"."\n";
		    }
		    // line height
		    if ( $pagination_line_height != '' ) {
		        $custom .= ".navigation a, .pagination > span, .navigation.paging-navigation span, .page-links a, .page-links > span, .woocommerce-pagination ul li span, .woocommerce-pagination ul li a { line-height:" . $pagination_line_height . ";}"."\n";
		    } 
		    // letter spacing
		    if ( $pagination_letter_spacing != '' ) {
		        $custom .= ".navigation a, .pagination > span, .navigation.paging-navigation span, .page-links a, .page-links > span, .woocommerce-pagination ul li span, .woocommerce-pagination ul li a { letter-spacing:" . $pagination_letter_spacing . ";}"."\n";
		    }

		/*Typography copyright*/	
		    $copyright_fonts_ = themesflat_get_json('typography_bottom_copyright');
			$copyright_fonts_family = $copyright_fonts_['family'];
			$copyright_fonts_size = $copyright_fonts_['size'];
			$copyright_line_height = $copyright_fonts_['line_height'];
			$copyright_letter_spacing = $copyright_fonts_['letter_spacing'];
			$copyright_style = themesflat_font_style( $copyright_fonts_['style'] );
			$copyright_font_weight = $copyright_style[0];
			$copyright_font_style = $copyright_style[1]; 
			// font family
			if ( $copyright_fonts_family != '') {
				$custom .= ".copyright { font-family:" . $copyright_fonts_family . ";}"."\n";
			}
			// font weight
			if ( $copyright_font_weight != '' ) {
				$custom .= ".copyright { font-weight:" . $copyright_font_weight . ";}"."\n";
			}
			// font style
			if ( isset( $copyright_font_style )) {
		        $custom .= ".copyright { font-style:" . $copyright_font_style . "; }"."\n";  
			}
		    // font size
		    if ( $copyright_fonts_size != '' ) {
		        $custom .= ".copyright { font-size:" . intval($copyright_fonts_size) . "px;}"."\n";
		    }
		    // line height
		    if ( $copyright_line_height != '' ) {
		        $custom .= ".copyright { line-height:" . $copyright_line_height . ";}"."\n";
		    } 
		    // letter spacing
		    if ( $copyright_letter_spacing != '' ) {
		        $custom .= ".copyright { letter-spacing:" . $copyright_letter_spacing . ";}"."\n";
		    }

		/*Typography bottom menu*/	
		    $bottom_menu_fonts_ = themesflat_get_json('typography_bottom_menu');
			$bottom_menu_fonts_family = $bottom_menu_fonts_['family'];
			$bottom_menu_fonts_size = $bottom_menu_fonts_['size'];
			$bottom_menu_line_height = $bottom_menu_fonts_['line_height'];
			$bottom_menu_letter_spacing = $bottom_menu_fonts_['letter_spacing'];
			$bottom_menu_style = themesflat_font_style( $bottom_menu_fonts_['style'] );
			$bottom_menu_font_weight = $bottom_menu_style[0];
			$bottom_menu_font_style = $bottom_menu_style[1]; 
			// font family
			if ( $bottom_menu_fonts_family != '') {
				$custom .= ".bottom { font-family:" . $bottom_menu_fonts_family . ";}"."\n";
			}
			// font weight
			if ( $bottom_menu_font_weight != '' ) {
				$custom .= ".bottom { font-weight:" . $bottom_menu_font_weight . ";}"."\n";
			}
			// font style
			if ( isset( $bottom_menu_font_style )) {
		        $custom .= ".bottom { font-style:" . $bottom_menu_font_style . "; }"."\n";  
			}
		    // font size
		    if ( $bottom_menu_fonts_size != '' ) {
		        $custom .= ".bottom { font-size:" . intval($bottom_menu_fonts_size) . "px;}"."\n";
		    }
		    // line height
		    if ( $bottom_menu_line_height != '' ) {
		        $custom .= ".bottom { line-height:" . $bottom_menu_line_height . ";}"."\n";
		    } 
		    // letter spacing
		    if ( $bottom_menu_letter_spacing != '' ) {
		        $custom .= ".bottom { letter-spacing:" . $bottom_menu_letter_spacing . ";}"."\n";
		    }
	//GROUP LAYOUT
		$content_controls = themesflat_decode(themesflat_get_opt('content_controls'));
	    themesflat_render_box_position("#themesflat-content",$content_controls);

	//GROUP TOP BAR 
	    if ( themesflat_get_opt( 'topbar_background_color' ) !='' ) {
			$custom .= ".themesflat-top .container-inside, .header-default .themesflat-top { background-color:" . esc_attr(themesflat_get_opt ('topbar_background_color')) ." ; } "."\n";
	    }
	    if ( themesflat_get_opt( 'topbar_textcolor' ) !='' ) {
			$custom .= ".themesflat-top { color:" . esc_attr( themesflat_get_opt( 'topbar_textcolor' ) ) ." ;} "."\n";
	    }
	    if ( themesflat_get_opt( 'topbar_link_color' ) !='' ) {
			$custom .= ".themesflat-top a { color:" . esc_attr( themesflat_get_opt( 'topbar_link_color' ) ) ." ;} "."\n";
	    }
	    if ( themesflat_get_opt( 'topbar_link_color_hover' ) !='' ) {
			$custom .= ".themesflat-top a:hover { color:" . esc_attr( themesflat_get_opt( 'topbar_link_color_hover' ) ) ." ;} "."\n";
	    }
	    $topbar_controls = themesflat_decode(themesflat_get_opt('topbar_controls'));
	    themesflat_render_box_position(".themesflat-top .container-inside",$topbar_controls);
	    /*Typography Topbar*/	
		    $topbar_fonts_ = themesflat_get_json('typography_topbar');
			$topbar_fonts_family = $topbar_fonts_['family'];
			$topbar_fonts_size = $topbar_fonts_['size'];
			$topbar_line_height = $topbar_fonts_['line_height'];
			$topbar_letter_spacing = $topbar_fonts_['letter_spacing'];
			$topbar_style = themesflat_font_style( $topbar_fonts_['style'] );
			$topbar_font_weight = $topbar_style[0];
			$topbar_font_style = $topbar_style[1]; 
			// font family
			if ( $topbar_fonts_family != '') {
				$custom .= ".themesflat-top { font-family:" . $topbar_fonts_family . ";}"."\n";
			}
			// font weight
			if ( $topbar_font_weight != '' ) {
				$custom .= ".themesflat-top { font-weight:" . $topbar_font_weight . ";}"."\n";
			}
			// font style
			if ( isset( $topbar_font_style )) {
		        $custom .= ".themesflat-top { font-style:" . $topbar_font_style . "; }"."\n";  
			}
		    // font size
		    if ( $topbar_fonts_size != '' ) {
		        $custom .= ".themesflat-top { font-size:" . intval($topbar_fonts_size) . "px;}"."\n";
		    }
		    // line height
		    if ( $topbar_line_height != '' ) {
		        $custom .= ".themesflat-top { line-height:" . $topbar_line_height . ";}"."\n";
		    } 
		    // letter spacing
		    if ( $topbar_letter_spacing != '' ) {
		        $custom .= ".themesflat-top { letter-spacing:" . $topbar_letter_spacing . ";}"."\n";
		    }

	//GROUP HEADER
	    $header_backgroundcolor = themesflat_get_opt( 'header_backgroundcolor');
		if ( $header_backgroundcolor !='' ) {
			$custom .= "#header.header-default, #header.header-style1 .header-wrap, #header.header-style2 .header-wrap, #header.header-style4 .header-wrap, #header.header-style3 .header-ct-center, #header.header-style3 .header-ct-right, #header.header-style3:before { background:" . esc_attr($header_backgroundcolor) . ";}"."\n";
		}

		$header_backgroundcolor_sticky = themesflat_get_opt( 'header_backgroundcolor_sticky');
		if ( $header_backgroundcolor_sticky !='' ) {		
			$custom .= "#header.header-sticky { background:" . esc_attr( $header_backgroundcolor_sticky ) . ";}"."\n";
		}

		$mainnav_color = themesflat_get_opt( 'mainnav_color');
		if ( $mainnav_color !='' ) {
			$custom .= "#mainnav > ul > li > a, .header-modal-menu-left-btn .text, header .flat-information li, header .flat-information li a, #header.header-style1 .btn-header { color:" . esc_attr($mainnav_color) . ";}"."\n";
			$custom .= ".header-modal-menu-left-btn .modal-menu-left-btn .line { background:" . esc_attr($mainnav_color) . ";}"."\n";
		}

		$mainnav_hover_color = themesflat_get_opt( 'mainnav_hover_color');
		if ( $mainnav_hover_color !='' ) {
			$custom .= "#mainnav > ul > li > a:hover { color:" . esc_attr($mainnav_hover_color) . ";}"."\n";
			$custom .= "#mainnav > ul > li > a:after { background:" . esc_attr($mainnav_hover_color) . ";}"."\n";
		}

		$mainnav_active_color = themesflat_get_opt( 'mainnav_active_color');
		if ( $mainnav_active_color !='' ) {
			$custom .= "#mainnav > ul > li.current-menu-item > a, #mainnav > ul > li.current-menu-ancestor > a, #mainnav > ul > li.current-menu-parent > a { color:" . esc_attr($mainnav_active_color) . ";}"."\n";
			$custom .= "#mainnav > ul > li.current-menu-item > a:after, #mainnav > ul > li.current-menu-ancestor > a:after, #mainnav > ul > li.current-menu-parent > a:after { background:" . esc_attr($mainnav_active_color) . ";}"."\n";
		}

		//Subnav a color
		$sub_nav_color = themesflat_get_opt( 'sub_nav_color');
		if ( $sub_nav_color !='' ) {
			$custom .= "#mainnav ul.sub-menu > li > a, #mainnav li.megamenu > ul.sub-menu > .menu-item-has-children > a,#mainnav_canvas ul li a { color:" . esc_attr( $sub_nav_color ) . ";}"."\n";
		}
		//Subnav background color
		$sub_nav_background = themesflat_get_opt( 'sub_nav_background');
		if ( $sub_nav_background !='' ) {
			$custom .= "#mainnav ul.sub-menu,#mainnav ul.sub-menu:before { background-color:" . esc_attr( $sub_nav_background ) . ";}"."\n";			
		}

		//sub_nav_color_hover
		$sub_nav_color_hover = themesflat_get_opt( 'sub_nav_color_hover');
		if ( $sub_nav_color_hover !='' ) {
			$custom .= "#mainnav ul.sub-menu > li > a:hover, #mainnav ul.sub-menu > li.current-menu-item > a,#mainnav_canvas ul li.current-menu-item > a:hover,#mainnav_canvas ul li a:hover,#mainnav_canvas ul li.current-menu-item > a, #mainnav_canvas ul li.current_page_item > a, #mainnav_canvas ul li.current-menu-ancestor > a, #mainnav_canvas ul li.current-menu-parent > a, #mainnav-mobi ul li.current-menu-item > a, #mainnav-mobi ul li.current-menu-ancestor > a, #mainnav ul.sub-menu > li.current-menu-ancestor > a, #mainnav-mobi ul li .current-menu-item > a, #mainnav-mobi ul li.current-menu-item .btn-submenu:before, #mainnav-mobi ul li .current-menu-item .btn-submenu:before { color:" . esc_attr( $sub_nav_color_hover ) . ";}"."\n";
		}
		//sub_nav_background_hover
		$sub_nav_background_hover = themesflat_get_opt( 'sub_nav_background_hover');
		if ( $sub_nav_background_hover !='' ) {
			$custom .= "#mainnav ul.sub-menu > li > a:before { background-color:" . esc_attr($sub_nav_background_hover) . ";}"."\n";
		}
		//sub_nav_border_color
		$sub_nav_border_color = themesflat_get_opt( 'sub_nav_border_color');
		if ( $sub_nav_border_color !='' ) {
			$custom .= "#mainnav ul.sub-menu > li { border-top-color:" . esc_attr($sub_nav_border_color) . ";}"."\n";
		}

		$logo_controls = themesflat_decode(themesflat_get_opt('logo_controls'));
	    themesflat_render_box_position("#header #logo",$logo_controls);

	    $logo_width = themesflat_get_opt( 'logo_width');
		if ( $logo_width !='' ) {
			$custom .= "#header #logo a img, .modal-menu__panel-footer .logo-panel a img { max-width:" . esc_attr($logo_width) . "px;height: auto;}"."\n";
		}

		$menu_distance_between = themesflat_get_opt( 'menu_distance_between');
		if ( $menu_distance_between !='' ) {
			$custom .= "#mainnav > ul > li { margin-left:" . esc_attr($menu_distance_between) . "px; margin-right:". esc_attr($menu_distance_between) ."px;}"."\n";
		}

	//GROUP FOOTER
		$footer_controls = themesflat_decode(themesflat_get_opt('footer_controls'));
	    themesflat_render_box_position("#footer",$footer_controls);

	    $footer_background_color = themesflat_get_opt( 'footer_background_color');
		if ( $footer_background_color !='' ) {
			$custom .= ".footer_background { background:" . esc_attr($footer_background_color) . ";}"."\n";
		}
		$footer_background_image = themesflat_get_opt('footer_background_image');
		$footer_image_size = themesflat_get_opt('footer_image_size');
	    if ( $footer_background_image !='' ) { 
		    $custom .= '.footer_background .overlay-footer {background-image: url('.$footer_background_image.');}'."\n";
		    $custom .= '.footer_background .overlay-footer {background-size: '.$footer_image_size.';}'."\n";    
		}
		$footer_title_widget_color = themesflat_get_opt( 'footer_title_widget_color');
		if ( $footer_title_widget_color !='' ) {
			$custom .= "#footer .widget-title, #footer h2, #footer h3, #footer h4, #footer h5, #footer h6, #footer .wp-block-search .wp-block-search__label { color:" . esc_attr($footer_title_widget_color) . ";}"."\n";
		}
		$footer_text_color = themesflat_get_opt( 'footer_text_color');
		if ( $footer_text_color !='' ) {
			$custom .= "#footer,#footer select,#footer textarea, #footer a, footer .widget.widget-recent-news li .text .post-date, footer .widget.widget_latest_news li .text .post-date, #footer .footer-widgets .widget.widget_themesflat_socials ul li a, #footer .footer-widgets .widget.widget_themesflat_socials ul li a:hover, footer select option, footer .widget.widget_recent_entries ul li .post-date, #footer .wp-block-latest-posts__post-author, #footer .wp-block-latest-posts__post-date { color:" . esc_attr($footer_text_color) . ";}"."\n";
		}
		if ( $footer_text_color !='' ) {
			$custom .= "#footer .footer-widgets .widget.widget_themesflat_socials ul li a:hover { color:" . esc_attr($footer_text_color) . "!important;}"."\n";
		}
		$footer_text_color_hover = themesflat_get_opt( 'footer_text_color_hover');
		if ( $footer_text_color_hover !='' ) {
			$custom .= "#footer a:hover { color:" . esc_attr($footer_text_color_hover) . ";}"."\n";
			$custom .= "footer .widget.widget_product_categories ul > li > a:before, footer .widget.widget_categories ul > li > a:before, footer .widget.widget_pages ul > li > a:before, footer .widget.widget_archive ul > li > a:before, footer .widget.widget_meta ul > li > a:before, footer .widget.widget_block ul > li > a:before { background:" . esc_attr($footer_text_color_hover) . ";}"."\n";
		}		

		$bottom_background_color = themesflat_get_opt( 'bottom_background_color');
		if ( $bottom_background_color !='' ) {
			$custom .= ".bottom { background:" . esc_attr($bottom_background_color) . ";}"."\n";
		}
		$bottom_text_color = themesflat_get_opt( 'bottom_text_color');
		if ( $bottom_text_color !='' ) {
			$custom .= ".bottom, .bottom a { color:" . esc_attr($bottom_text_color) . ";}"."\n";
		}
		$bottom_link_color = themesflat_get_opt( 'bottom_link_color');
		if ( $bottom_link_color !='' ) {
			$custom .= ".bottom .copyright a { color:" . esc_attr($bottom_link_color) . ";}"."\n";
		}
		$bottom_text_color_hover = themesflat_get_opt( 'bottom_text_color_hover');
		if ( $bottom_text_color_hover !='' ) {
			$custom .= ".bottom a:hover, .bottom .copyright a:hover { color:" . esc_attr($bottom_text_color_hover) . ";}"."\n";
			$custom .= ".bottom .copyright a:before { background:" . esc_attr($bottom_text_color_hover) . ";}"."\n";
		}
		
	//GROUP ACTION BOX
		$action_box_background_image = themesflat_get_opt('action_box_background_image');
	    if ( $action_box_background_image !='' ) {
		    $custom .= '.themesflat-action-box {background-image: url('.$action_box_background_image.');}'."\n";  
		}		
		// Action Box Background Color
		$action_box_background_color = themesflat_get_opt( 'action_box_background_color');
		if ( $action_box_background_color !='' ) {
			$custom .= ".themesflat-action-box .overlay { background-color:" . esc_attr($action_box_background_color) . ";}"."\n";
		}
		// Action Box Heading Color
		$action_box_heading_color = themesflat_get_opt( 'action_box_heading_color');
		if ( $action_box_heading_color !='' ) {
			$custom .= ".themesflat-action-box .heading, .themesflat-action-box h2, .themesflat-action-box h3, .themesflat-action-box h4, .themesflat-action-box h5, .themesflat-action-box h6 { color:" . esc_attr($action_box_heading_color) . ";}"."\n";
		}
		// Action Box Text Color
		$action_box_text_color = themesflat_get_opt( 'action_box_text_color');
		if ( $action_box_text_color !='' ) {
			$custom .= ".themesflat-action-box, .themesflat-action-box p { color:" . esc_attr($action_box_text_color) . ";}"."\n";
		}
		// Action Box button Text Color
		$action_box_button_text_color = themesflat_get_opt( 'action_box_button_text_color');
		if ( $action_box_button_text_color !='' ) {
			$custom .= ".themesflat-action-box .themesflat-button, .themesflat-action-box .themesflat-button:hover { color:" . esc_attr($action_box_button_text_color) . ";}"."\n";
		}
		// Action Box button Background Color
		$action_box_button_background_color = themesflat_get_opt( 'action_box_button_background_color');
		if ( $action_box_button_background_color !='' ) {
			$custom .= ".themesflat-action-box .themesflat-button { background-color:" . esc_attr($action_box_button_background_color) . ";}"."\n";			
		}

	//GROUP PARTNER BOX
		$partner_box_controls = themesflat_decode(themesflat_get_opt('partner_box_controls'));
	    themesflat_render_box_position(".themesflat-partner-box",$partner_box_controls);
	    $partner_box_background_color = themesflat_get_opt( 'partner_box_background_color');
		$custom .= ".themesflat-partner-box { background: ". esc_attr($partner_box_background_color) .";}"."\n";
	
    //GROUP PAGE TITLE
		$page_title_controls = themesflat_decode(themesflat_get_opt('page_title_controls'));
	    themesflat_render_box_position(".page-title",$page_title_controls);

	    //  Page Title Opacity
		$page_title_background_color = themesflat_get_opt( 'page_title_background_color');
		$custom .= ".page-title .overlay { background: ". esc_attr($page_title_background_color) .";}"."\n";

		$page_title_background_color_opacity = themesflat_get_opt( 'page_title_background_color_opacity');
		if ( $page_title_background_color_opacity !='' ) {
			$custom .= ".page-title .overlay { opacity:" . esc_attr($page_title_background_color_opacity) . "%; filter:alpha(opacity=" . esc_attr($page_title_background_color_opacity) . "); }"."\n";
		}
		
		$page_title_img = themesflat_get_opt('page_title_background_image');
		$page_title_image_size = themesflat_get_opt('page_title_image_size');
	    if ( $page_title_img !='' ) { 
		    $custom .= '.page-title {background-image: url('.$page_title_img.');}'."\n";
		    $custom .= '.page-title {background-size: '.$page_title_image_size.';}'."\n";  
		}				    

		$custom .= ".page-title h1 {color:" . themesflat_get_opt('page_title_text_color') . "!important;}"."\n";
		$custom .= ".page-title.parallax h1:after, .page-title.video h1:after {background:" . themesflat_get_opt('page_title_text_color') . ";}"."\n";

		$custom .= ".breadcrumbs span, .breadcrumbs span a, .breadcrumbs a, .breadcrumbs span i, .breadcrumbs span.trail-browse i {color:" . themesflat_get_opt('breadcrumb_color') . ";}"."\n";
				

	//GROUP BODY
		// Body color
		$body_text = themesflat_get_opt( 'body_text_color' );
		if ($body_text !='') {
			$custom .= "body, input, select, textarea { color:" . esc_attr($body_text) . "}"."\n";
			$custom .= ".themesflat-portfolio .item .category-post a:hover,ul.iconlist .list-title .testimonial-content blockquote,.testimonial-content .author-info,.themesflat_counter.style2 .themesflat_counter-content-right,.themesflat_counter.style2 .themesflat_counter-content-left, .page-links a:focus,.widget_search .search-form input[type=search],.entry-meta ul,.entry-meta ul.meta-right,.entry-footer strong, .themesflat_button_container .themesflat-button.no-background, .portfolio-single .entry-content, article .entry-meta ul li a, .blog-single .entry-footer .tags-links a, .navigation.posts-navigation .nav-links li a .meta-nav, .flat-language ul.unstyled-child li a, .themesflat-price-product del { color:" . esc_attr($body_text) . "}"."\n";
			//border bodycolor
			$custom .= ".widget .widget-title:after, .widget .widget-title:before,ul.iconlist li.circle:before { background-color:" . esc_attr($body_text) . "}"."\n";
		}

		// background bodycolor
	    if ( themesflat_get_opt ('body_background_color') !='' ) {
			$custom .= "body, .page-wrap, .boxed .themesflat-boxed { background-color:" . esc_attr(themesflat_get_opt ('body_background_color')) ." ; } "."\n";
	    }
	
	//GROUP COLOR
	    // Primary color
	    $primary_color = themesflat_get_opt( 'primary_color' );
	    if ( $primary_color !='' ) { 
	    	$custom .= "h1, h2, h3, h4, h5, h6 { color:" . esc_attr($primary_color) . ";}"."\n";

	    	$custom .= "article .entry-title a,.widget .tagcloud a,.woocommerce-MyAccount-navigation ul li.is-active a,.wishlist_table .product-add-to-cart a:hover,.themesflat-button,.widget.widget-recent-news li .text .post-date i, .item article .entry-title a, .widget.widget_categories ul li a, .widget.widget_archive ul li a, .widget.widget_block .wp-block-archives li a, .widget.widget_block .wp-block-categories li a, article .post-meta .item-meta a, .tags-links a, .logged-in-as a, blockquote em a, .wp-block-search .wp-block-search__button:after, .footer-widgets .widget.widget_themesflat_socials ul li:hover a i, .mc4wp-form .btn-submit, .project-post .content .tf-button, .project-filter li.active a, .project-filter li a, .navigation.loadmore.project a, .block-company-profile a.btn, button, .product_list_widget .amount, .woocommerce-pagination ul li a, .woo-single-post-class .woocommerce-tabs ul li>a, .woo-single-post-class .woocommerce-product-details__short-description li:before, .woocommerce-page .cart_totals .shop_table .order-total td, .woocommerce-page .shop_table th,.woocommerce-page .shop_table td,.woocommerce-page .woocommerce-checkout-payment p { color:" . esc_attr($primary_color) . ";}"."\n";

	    	//Sidebar
	    	$custom .= ".sidebar .widget ul li a { color:" . esc_attr($primary_color) . ";}"."\n";

	    	$custom .= ".widget_infor .icon-box .icon svg { fill:" . esc_attr($primary_color) . ";}"."\n";

	    	$custom .= ".comment-list .comement_reply a:hover, .sidebar .widget_recent_comments ul li, .sidebar .widget.widget_block ol.wp-block-latest-comments li, .sidebar .widget.widget_recent_comments ul li, .sidebar .widget.widget_rss ul li, .sidebar .widget.widget_block ol.wp-block-latest-comments li, .sidebar .wp-block-search .wp-block-search__label, .sidebar .wc-block-product-search .wc-block-product-search__label, .contact-get-quote button:hover, .contact-home2.style-3 .contact-get-quote button { color:" . esc_attr($primary_color) . ";}"."\n";

	    	$custom .= ".tf-posts .blog-post .tf-button:hover, .tf-posts .blog-post .title a { color:" . esc_attr($primary_color) . ";}"."\n";

	    	$custom .= "#commentform .wrap-input-submit:before, .wp-block-button__link:before, .draw-border a:before, .block-get-a-quote a:before, button:before, .btn:before, input[type=\"button\"]:hover, input[type=\"reset\"]:hover, input[type=\"submit\"]:hover, .go-top, .wishlist_table .product-add-to-cart a:before, .widget_shopping_cart_content .buttons>a:before, .widget_shopping_cart_content .buttons a.checkout:before, #header.header-style1 .draw-border a:before, .widget_infor .content-bottom, .contact-get-quote button, .contact-get-quote button:hover, .project-post .content, .block-company-profile, .contact-get-quote button, .contact-home2.style-3 .contact-get-quote button:before,.products li .wrap-btn-action .button,.products li .product-info .added_to_cart, .widget .tagcloud a:hover, .products li .wrap-btn-action .loading:after, .wishlist_table .product-add-to-cart a, .btn-menu span,.btn-menu:before, .btn-menu:after { background-color:" . esc_attr($primary_color) . ";}"."\n";

	    	$custom .= ".modal-menu__panel-body .search-form input[type=\"search\"]:focus { border-color:" . esc_attr($primary_color) . "}"."\n";

			$custom .= ' :root { --theme-primary-color:' . esc_attr($primary_color) . " }"."\n";
	    }

	    // Secondary color
	    $secondary_color = themesflat_get_opt( 'secondary_color' );
    	if ( $secondary_color !='' ) {
			//color
	    	$custom .= "a:hover, .footer-widgets .widget.widget_themesflat_socials ul li a i,.mc4wp-form .btn-submit:hover,.wishlist_table .product-add-to-cart a,  .comment-list .comement_reply a,.themesflat-button i,.themesflat-button:hover, .wp-block-pullquote cite, blockquote em, blockquote em a:hover, blockquote i, blockquote cite, blockquote cite a, article .entry-title a:hover, .navigation.posts-navigation .nav-links a:hover, .widget_calendar table #today:hover, .widget_calendar table #today a:hover, .widget_calendar table tbody tr a:hover, .widget_calendar nav a:hover, article .post-meta .item-meta a:hover, .social-share-article ul li a:hover, .widget.widget_latest_news li .text .post-date i, .widget.widget-recent-news li .text h6 a:hover, .widget.widget_latest_news li .text h6 a:hover, .themesflat-services-taxonomy .services-post .post-icon i, .portfolios-post .content .post-meta a:hover, .portfolios-post .content .title a:hover, .project-post .content .post-meta a:hover, .project-post .content .title a:hover, .tf-posts .blog-post .tf-button, .tf-posts .blog-post .title a:hover, .tf-services-wrap.style2 .services-post:hover .post-icon i, .tf-services-wrap.style2 .services-post .tf-button-container a, .breadcrumbs a:hover, .breadcrumbs span a:hover, .breadcrumbs a:hover span, .breadcrumbs span a:hover span, blockquote a:hover, .widget.widget_recent_entries ul li a:hover, .widget.widget_block ul.wp-block-latest-posts li a:hover, .tags-links a:hover, .logged-in-as a:hover, .comments-area ol.comment-list article .comment_content .comment_meta .comment_author a:hover, .single-portfolios .entry-content .meta-post a:hover, .single-project .entry-content .meta-post a:hover, .services-post .title a:hover, .services-post .tf-button-container a:hover, .info-header .phone:hover, .post-meta a:hover, article .entry-title a:hover, .item article .entry-title a:hover, .widget ul li a:hover, .widget ol li a:hover, .sidebar .widget.widget_nav_menu ul li a:hover, .widget.widget_meta ul li a:hover, .tf-posts.style3 .content .post-meta a:hover, .tf-posts.style3 .blog-post .tf-button:hover, .tf-posts.style3 .blog-post .tf-button:hover:after, .tf-posts.style4 .content .post-meta a:hover, .tf-posts.style4 .blog-post .tf-button:hover, .tf-posts.style4 .blog-post .tf-button:hover:after, .navigation.loadmore.project a:hover, .contact-home2.style-3 .contact-get-quote button:hover, button:hover, btn-header:hover, .widget .tagcloud a:hover, .products li h2:hover, .product_list_widget .product-title:hover, .widget_recent_reviews .product_list_widget a:hover { color:" . esc_attr($secondary_color) . ";}"."\n";

	    	//sidebar
	    	$custom .= ".sidebar .widget ul li a:hover { color:" . esc_attr($secondary_color) . ";}"."\n";

	    	$custom .= "button:hover, input[type=\"button\"]:hover, input[type=\"reset\"]:hover, input[type=\"submit\"]:hover, mark, ins, .go-top:hover, #commentform .wrap-input-submit, .draw-border a, .widget.widget_archive ul li a:hover, .widget.widget_categories ul li a:hover,.widget_categories li a:hover, button, input[type=\"button\"], input[type=\"reset\"], input[type=\"submit\"], .themesflat-services-taxonomy .services-post:hover .post-icon, .wp-block-button__link, .wp-block-file .wp-block-file__button, .is-style-outline .wp-block-button__link:before, .page-links a:hover, .page-links a:focus, .page-links > span, input[type='radio']:checked:before, .block-get-a-quote .overlay-color, .themesflat-top .btn-topbar { background:" . esc_attr($secondary_color) . ";}"."\n";

	    	$custom .= "textarea:focus, input[type=\"text\"]:focus, input[type=\"password\"]:focus, input[type=\"datetime\"]:focus, input[type=\"datetime-local\"]:focus, input[type=\"date\"]:focus, input[type=\"month\"]:focus, input[type=\"time\"]:focus, input[type=\"week\"]:focus, input[type=\"number\"]:focus, input[type=\"email\"]:focus, input[type=\"url\"]:focus, input[type=\"search\"]:focus, input[type=\"tel\"]:focus, input[type=\"color\"]:focus, .widget.widget_archive ul li a:hover, .widget_categories li a:hover, .widget.widget_categories ul li a:hover, .sidebar .wpcf7-form textarea:focus, .single-portfolios .entry-content .meta-post .inner-meta-post, .single-project .entry-content .meta-post .inner-meta-post, #header.header-style1 .btn-header, #header.header-style1 .btn-header:hover, .is-style-outline>.wp-block-button__link, .wp-block-button__link.is-style-outline, input[type='radio']:checked { border-color:" . esc_attr($secondary_color) . ";}"."\n";
	    	
	    	$custom .= ".draw-border.second-color a:hover, .draw-border.second-color button:hover, #footer a:hover, .wishlist_table span.wishlist-in-stock, #footer .widget_calendar nav a:hover, #footer .widget_calendar table tbody tr a:hover { color:" . esc_attr($secondary_color) . "!important;}"."\n";
		    $custom .= "input:focus, textarea:focus, select:focus, .draw-border.second-color a:hover::before, .draw-border.second-color a:hover::after, .draw-border.second-color button:hover > span::before, .draw-border.second-color button:hover > span::after, .widget_search form input[type=\"search\"]:focus, .wp-block-search .wp-block-search__input:focus, .footer .mc4wp-form input[type=\"email\"]:focus { border-color:" . esc_attr($secondary_color) . " !important;}"."\n";

		    $custom .= ".double-bounce3, .double-bounce4, .navigation.paging-navigation .current, .navigation.paging-navigation a:hover, .navigation.paging-navigation a.next:hover, .widget .widget-title:after, .go-top:hover, .search-form .search-submit, .footer-widgets .widget.widget_themesflat_socials ul li a:hover, .footer .mc4wp-form input[type=\"submit\"]:hover, .info-footer .wrap-info-item, a.btn.s2:before, .portfolio-filter li.active a, .services-filter li.active a, .project-filter li.active a, .portfolio-filter li a:hover, .services-filter li a:hover, .project-filter li a:hover, .single-portfolios .entry-footer .social-share-article a:hover, .portfolios-post .content .tf-button:hover, .single-project .entry-footer .social-share-article a:hover, .project-post .content .tf-button:hover, .tf-posts.style1 .post-meta a, .tf-posts.style2 .blog-post:after, .tf-posts.style2 .bg-overlay, .tf-posts.style3 .featured-post .post-meta, .tf-posts.style3 .blog-post .tf-button:hover:before, .tf-posts.style4 .blog-post .tf-button:hover:before, .widget_search form button, .wp-block-search .wp-block-search__button  { background: ". esc_attr($secondary_color) .";}"."\n";
		    //svg
		    $custom .= ".info-header .icon-info svg, .themesflat-services-taxonomy .services-post .post-icon svg, .tf-services-wrap.style2 .services-post:hover .post-icon svg, .list-infor ul li svg { fill:" . esc_attr($secondary_color) . "}"."\n";

		    //color shop
	    	$custom .= ".widget_shopping_cart_content ul li a.remove, .widget_shopping_cart_content .total span.woocommerce-Price-amount, .wc-block-grid__product.wc-block-grid__product .wc-block-grid__product-link:hover, .woocommerce .shop_table.order_details tr td .woocommerce-Price-amount, .woocommerce .shop_table.order_details th a:hover, .woocommerce .shop_table.order_details tr td.woocommerce-table__product-name a:hover, .woocommerce-page .shop_table.cart .product-name a:hover, .woo-single-post-class .summary a:hover { color:" . esc_attr($secondary_color) . "!important;}"."\n";
	    	$custom .= ".widget_product_categories ul li a:hover, .wc-block-product-categories ul li a:hover { color:" . esc_attr($secondary_color) . " !important;}"."\n";
	    	$custom .= ".woocommerce-page .woo-single-post-class .summary .stock.in-stock, .product .onsale, .woo-single-post-class .woocommerce-tabs ul li>a:hover, .woo-single-post-class .woocommerce-tabs ul li.active>a, .woocommerce-pagination ul li span.current, .woocommerce-pagination ul li a:hover, .woocommerce-page .wc-proceed-to-checkout .button, .sidebar .widget.woocommerce .widget-title:before, .sidebar .widget.woocommerce .widget-title:after, .header-cart-wrapper .shopping-cart-items-count, .tf-team .inner-image:before, .widget_shopping_cart_content .buttons>a, .widget_shopping_cart_content .buttons a.checkout, .woocommerce-page .shop_table.cart .product-remove a:hover, .widget_shopping_cart_content ul li a.remove:hover, .header-cart-wrapper .nav-cart-trigger, .products li .wrap-btn-action .loading:after, .wc-block-grid__product-onsale, .products li .wrap-btn-action .yith-wcwl-add-to-wishlist, .products li .wrap-btn-action .button, .products li .product-info .added_to_cart, .tf-services-wrap.style3 .services-post .tf-button-container a, .widget_infor .icon-box .icon, .footer-widgets .widget.widget_themesflat_socials ul li:hover, .contact-home2 .contact-get-quote button::before, .project-post .content .tf-button, .block-company-profile a.btn, .contact-home2.style-3 .contact-get-quote button, .sidebar .wc-block-product-search .wc-block-product-search__label:before,.sidebar .wc-block-product-search .wc-block-product-search__label:after, .sidebar .widget.woocommerce .widget-title:before, .sidebar .widget.woocommerce .widget-title:after, .woo-single-post-class .images .woocommerce-product-gallery__trigger:hover:after, .wishlist_table .product-add-to-cart a:before, .woocommerce-MyAccount-navigation ul li.is-active { background-color:" . esc_attr($secondary_color) . ";}"."\n";

	    	$custom .= ".woocommerce-notice--success:after { background-color:" . esc_attr($secondary_color) . "!important;}"."\n";

	    	$custom .= ".woocommerce-pagination ul li span.current, .woocommerce-pagination ul li a:hover, .products li:hover .inner, .woocommerce textarea:focus, .woocommerce input:focus, blockquote,  .woocommerce-page div.product div.images img:hover,.woocommerce-page div.product div.images img.flex-active { border-color:" . esc_attr($secondary_color) . " !important;}"."\n";
	    	//rgba
	    	$secondary_color_rgba = themesflat_hex2rgba($secondary_color, 0.2);
	    	$custom .= ".woo-single-post-class .woocommerce-tabs ul li>a, .woocommerce-page .shop_table.cart .product-remove a, .widget_shopping_cart_content ul li a.remove { background:" . esc_attr($secondary_color_rgba) . ";}"."\n";

	    	$custom .= "footer .widget.widget_categories ul li>a:hover:after, footer .widget.widget_archive ul li>a:hover:after, footer .widget.widget_pages ul li>a:hover:after, footer .widget.widget_meta ul li>a:hover:after { color:" . esc_attr($secondary_color) . ";}"."\n";
			$custom .= ' :root { --theme-secondary-color:' . esc_attr($secondary_color) . " }"."\n";
	    } 	

	    // Accent color
	    $accent_color = themesflat_get_opt( 'accent_color' );
    	if ( $accent_color !='' ) {
    		$custom .= 'a, .products li.product-style2 h2:hover, .flat-language ul.unstyled-child li a:hover { color:' . esc_attr($accent_color) . " }"."\n";
    		$custom .= ' .product-style2.product .onsale, .tf-services-wrap.style3 .services-post .post-icon, .tf-services-wrap.style3 .services-post .tf-button-container a:hover, .dark-form.style2 button, .dark-form.style2 input[type="submit"], #header.header-style3 .header-wrap .header-ct-left, .footer-style-3 footer .widget .widget-title:after, .footer-style-3 footer .widget h2:after, .footer-style-3 footer .wp-block-search .wp-block-search__label:after, .footer-style-4 footer .widget .widget-title:after, .footer-style-4 footer .widget h2:after, .footer-style-4 footer .wp-block-search .wp-block-search__label:after, .footer-style-2 #footer .footer-widgets .widget.widget_themesflat_socials ul li a:hover, .footer-style-4 #footer .footer-widgets .widget.widget_themesflat_socials ul li a:hover { background-color:' . esc_attr($accent_color) . " }"."\n";
    		$custom .= ' .tf-team.style1 .content:before, .tf-team.style1 .content:after, .line-top .tf-imagebox .content:before, .services-post .content:before { background-color:' . esc_attr($accent_color) . " !important}"."\n";
    		$custom .= ' :root { --theme-accent-color:' . esc_attr($accent_color) . " }"."\n";
    	}			    

	$custom = apply_filters('themesflat/render/style',$custom);
	wp_add_inline_style( 'themesflat-inline-css', $custom );

}

add_action( 'wp_enqueue_scripts', 'themesflat_custom_styles' );