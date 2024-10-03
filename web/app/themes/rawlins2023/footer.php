<?php
$global_options = get_field('global_options', 'option');
$emails = $global_options['contact_email_addresses'];
?>
<footer class="footer">
    <div class="footer__inner l-container">
        <div class="footer__content">
            <ul class="footer__emails">
                <?php foreach ( $emails as $item ) : ?>
                    <li><?php if ( $item['target_audience'] ) { echo $item['target_audience'] . ': '; } ?><a href="mailto:<?php echo $item['email']; ?>"><?php echo $item['email']; ?></a></li>
                <?php endforeach; ?>
            </ul>     
            <div class="footer__since">Since 2016.</div>
            <div class="footer__copyright">&copy;<?php echo date('Y'); ?> Super Conscious&reg;</div>
        </div>
        <div class="footer__skull"><a target="_blank" href="https://open.spotify.com/user/31rsi3owjmpkkppsgdilnfsvwvay"><img src="<?php echo get_stylesheet_directory_uri() . '/images/icon-playlist.svg'; ?>" alt="" /></a></div>
    </div>
</footer>

</div> <!--site-container-->
<?php if ( is_front_page() ) : ?>
    <section id="modal" class="modal">
        <div class="modal__inner">
            <div class="modal__close"><span><?php echo file_get_contents(get_stylesheet_directory() . '/images/icon__modal--close.svg'); ?></span></div>
            <nav class="modal__nav l-container">
                <span class="modal__nav__item modal__nav__item--prev"><?php echo file_get_contents(get_stylesheet_directory() . '/images/icon__modal--prev.svg'); ?></span>
                <span class="modal__nav__item modal__nav__item--next"><?php echo file_get_contents(get_stylesheet_directory() . '/images/icon__modal--next.svg'); ?></span>
            </nav>
            <div class="modal__images">
            </div>
        </div>
    </section>
<?php endif; ?>
<?php wp_footer(); ?>

</body>
</html>
