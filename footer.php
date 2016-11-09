        </div>
        <footer id="footer">
            <section class="s1">
                <div class="page-wrap">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <a href="<?php echo (is_front_page()) ? '#start' : site_url(); ?>" title="<?php bloginfo('name'); ?>" class="footer-logo">
                                <img src="<?php echo IMAGES_URI . 'logo2.png'; ?>" alt="<?php bloginfo('name'); ?>" />
                            </a>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="footer-content">
                                <?php the_field('text_center','option'); ?>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <div class="footer-headline"><?php the_field('right_heading','option'); ?></div>
                            <ul class="footer-contact">
                                <?php if(get_field('adres','option')): ?><li class="adres"><a href="#gMap" title="<?php the_field('adres','option'); ?>"><?php the_field('adres','option'); ?></a></li><?php endif; ?>
                                <?php if(get_field('telefon','option')): ?><li class="telefon"><a href="tel:<?php the_field('telefon','option'); ?>" title="<?php the_field('telefon','option'); ?>"><?php the_field('telefon','option'); ?></a></li><?php endif; ?>
                                <?php if(get_field('fax','option')): ?><li class="fax"><a href="tel:<?php the_field('fax','option'); ?>" title="<?php the_field('fax','option'); ?>"><?php the_field('fax','option'); ?></a></li><?php endif; ?>
                                <?php if(get_field('email','option')): ?><li class="email"><a href="mailto:<?php the_field('email','option'); ?>" title="email"><?php the_field('email','option'); ?></a></li><?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
            <section class="s2">
                <div class="page-wrap">
                    <?php the_field('copyright','option'); ?>&nbsp;Created by <a href="http://kerris.pl/" title="Kerris">Kerris</a>
                </div>
            </section>
        </footer>
    <?php wp_footer(); ?>
    </body>
</html>