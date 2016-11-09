<div class="topbar" id="menu">
    <div class="rainbow top"><div><span></span><span></span><span></span><span></span><span></span><span></span><span></span></div></div>
    <div class="top-bar static-bar<?php echo (is_front_page()) ? ' front-page' : ''; ?><?php echo (is_404()) ? ' er404' : ''; ?>">
        <div class="top-bar-content">
            <div class="page-wrap">
                <section>
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4">
                            <a href="<?php echo site_url(); ?>" title="<?php bloginfo('name'); ?>" class="logo">
                                <img src="<?php echo IMAGES_URI . 'logo1.png'; ?>" alt="<?php bloginfo('name'); ?>" />
                            </a>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
                            <div class="menu-home">
                                <div class="header-home-menu">
                                    <?php
                                    $menu = array(
                                        'theme_location'  => 'general',
                                        'container'       => 'div',
                                        'container_class' => '',
                                        'container_id'    => '',
                                        'menu_class'      => 'general table-row',
                                        'menu_id'         => '',
                                        'echo'            => true,
                                    );

                                    if(!is_front_page()){

                                        $menu['walker'] = new Single_Page_Menu();

                                    }

                                    wp_nav_menu($menu);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>