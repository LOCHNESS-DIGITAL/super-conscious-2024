<?php
// Template Name: Info Template
global $post;
$info = get_field('info', 'option');
$services = get_field('services', 'option');
$brand_services = $services['brand'];
$experience_services = $services['experience'];
$content_services = $services['content'];
$partners = get_field('our_partners', 'option');
$services_description = $services['description'];
$partners_description = $partners['description'];
get_header();
?>
<?php if ( !post_password_required( $post ) ): ?>
<section class="info-intro">
    <div class="info-intro__inner l-container">
        <div class="info-intro__content">
            <?php echo $info['description']; ?>
        </div>
        <div class="info-intro__content info-intro__content--mobile">
            <?php echo $info['mobile_description']; ?>
        </div>
        <div class="info-intro__image" style="background-image: url(<?php echo $info['image']['url']; ?>)"></div>
        <div class="info-intro__image info-intro__image--mobile" style="background-image: url(<?php echo $info['mobile_image']['url']; ?>)"></div>
    </div>
</section>

<section class="services">
    <div class="services__inner l-container">
        <div class="services__row">
            <div class="services__column">
                <h2>Services</h2>
                <?php if ( $services_description ) : ?>
                    <div class="services__description"><?php echo $services_description; ?></div>
                <?php endif; ?>
            </div>
            <div class="services__column">
                <h3>Brand</h3>
                <ul class="services__list">
                    <?php foreach ( $brand_services as $item ) : ?>
                        <li><?php echo $item['service']; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="services__column">
                <h3>Experience</h3>
                <ul class="services__list">
                    <?php foreach ( $experience_services as $item ) : ?>
                        <li><?php echo $item['service']; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="services__column">
                <h3>Content</h3>
                <ul class="services__list">
                    <?php foreach ( $content_services as $item ) : ?>
                        <li><?php echo $item['service']; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="partners">
    <div class="partners__inner l-container">
        <div class="partners__row">
            <div class="partners__column">
                <h2>Our Partners</h2>
                <?php if ( $partners_description ) : ?>
                    <?php if ( $partners_description ) : ?>
                        <div class="partners__description"><?php echo $partners_description; ?></div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
            <div class="partners__column">
                <ul class="partners__list">
                    <?php foreach ( $partners['column_1'] as $item ) : ?>
                        <?php if ( $item['partner_name'] ) : ?>
                            <li><?php echo $item['partner_name']; ?> <?php if ( $item['subtitle'] ) { ?><span><?php echo $item['subtitle']; ?></span><?php } ?></li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="partners__column">
                <ul class="partners__list">
                    <?php foreach ( $partners['column_2'] as $item ) : ?>
                        <?php if ( $item['partner_name'] ) : ?>
                            <li><?php echo $item['partner_name']; ?> <span><?php if ( $item['subtitle'] ) { ?><span><?php echo $item['subtitle']; ?></span><?php } ?></li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="partners__column">
                <ul class="partners__list">
                    <?php foreach ( $partners['column_3'] as $item ) : ?>
                        <?php if ( $item['partner_name'] ) : ?>
                            <li><?php echo $item['partner_name']; ?></li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</section>

<?php endif; ?>

<?php get_footer(); ?>
