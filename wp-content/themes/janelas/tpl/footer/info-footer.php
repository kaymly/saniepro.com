<?php
$show_footer_info = themesflat_get_opt('show_footer_info');
if (themesflat_get_opt_elementor('show_footer_info') != '') {
    $show_footer_info = themesflat_get_opt_elementor('show_footer_info');
}

if ($show_footer_info == 1) :         
?>  
    <div class="info-footer"> 
        <div class="container">
            <div class="wrap-info-item">
                <div class="info-item">
                    <div class="wrap-address wrap-info">
                        <div class="icon-info">
                            <svg xmlns="http://www.w3.org/2000/svg" width="17.897" height="25.852" viewBox="0 0 17.897 25.852">
                              <path data-name="Icon ionic-ios-pin" d="M16.824,3.375c-4.94,0-8.949,3.722-8.949,8.309,0,6.463,8.949,17.543,8.949,17.543s8.949-11.08,8.949-17.543C25.772,7.1,21.764,3.375,16.824,3.375Zm0,11.863a2.915,2.915,0,1,1,2.915-2.915A2.915,2.915,0,0,1,16.824,15.238Z" transform="translate(-7.875 -3.375)"/>
                            </svg>
                        </div>
                        <div class="content">
                            <span class="text"><?php echo themesflat_get_opt('footer_info_text_address'); ?></span>
                            <span class="info"><?php echo themesflat_get_opt('footer_info_address'); ?></span> 
                        </div>
                    </div>
                </div>
                <div class="info-item">
                    <div class="wrap-phone wrap-info">
                        <div class="icon-info">
                            <svg xmlns="http://www.w3.org/2000/svg" width="21.141" height="21.168" viewBox="0 0 21.141 21.168">
                                <path data-name="Icon zocial-call" d="M3.312,7.1a1.558,1.558,0,0,1,.4-.846L6.88,3.083q.37-.317.555.106L10,8a.692.692,0,0,1-.132.819L8.7,9.981a1.315,1.315,0,0,0-.37.819,4.035,4.035,0,0,0,.819,2.035,17.38,17.38,0,0,0,1.612,2.115l.819.845c.247.247.563.551.952.912a15.957,15.957,0,0,0,1.915,1.427,4.287,4.287,0,0,0,2.1.885,1.151,1.151,0,0,0,.846-.344L18.774,17.3a.581.581,0,0,1,.792-.106l4.626,2.722a.386.386,0,0,1,.211.278.338.338,0,0,1-.106.3l-3.172,3.172a1.553,1.553,0,0,1-.845.4,6.394,6.394,0,0,1-2.921-.357,13.217,13.217,0,0,1-3.012-1.44q-1.388-.9-2.577-1.823t-1.9-1.586L9.181,18.2q-.264-.264-.7-.727T6.959,15.65a26.544,26.544,0,0,1-1.877-2.656,15.5,15.5,0,0,1-1.374-2.947A6.269,6.269,0,0,1,3.312,7.1Z" transform="translate(-3.267 -2.947)"/>
                            </svg>
                        </div>
                        <div class="content">
                            <span class="text"><?php echo themesflat_get_opt('footer_info_text_phone'); ?></span>
                            <a class="info" href="tel:<?php echo esc_attr(str_replace(' ', '', themesflat_get_opt('footer_info_phone'))); ?>"><?php echo themesflat_get_opt('footer_info_phone'); ?></a> 
                        </div>
                    </div>
                </div>
                <div class="info-item">
                    <div class="wrap-mail wrap-info">
                        <div class="icon-info">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25.184" height="17" viewBox="0 0 25.184 17">
                              <path data-name="Icon zocial-email" d="M.072,19.562V5.574q0-.024.073-.461l8.233,7.043L.169,20.048a2.058,2.058,0,0,1-.1-.486ZM1.165,4.141a1.047,1.047,0,0,1,.413-.073H23.75a1.375,1.375,0,0,1,.437.073l-8.257,7.067-1.093.874-2.161,1.773-2.161-1.773-1.093-.874ZM1.189,21l8.281-7.941,3.206,2.6,3.206-2.6L24.163,21a1.166,1.166,0,0,1-.413.073H1.578A1.1,1.1,0,0,1,1.189,21Zm15.786-8.84,8.209-7.043a1.45,1.45,0,0,1,.073.461V19.562a1.861,1.861,0,0,1-.073.486Z" transform="translate(-0.072 -4.068)"/>
                            </svg>

                        </div>
                        <div class="content">
                            <span class="text"><?php echo themesflat_get_opt('footer_info_text_mail'); ?></span>
                            <a class="info" href="mailto:<?php echo esc_attr(themesflat_get_opt('footer_info_mail')) ?>"><?php echo themesflat_get_opt('footer_info_mail'); ?></a> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>