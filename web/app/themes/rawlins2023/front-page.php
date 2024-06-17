<?php
// use Modules\CTA;
$homepage_group = get_field('homepage', 'option');
$intro_description = $homepage_group['intro_description'];
$capabilities = $homepage_group['capabilities'];

get_header();
?>
<?php if ( !post_password_required( $post ) ): ?>
    <section class="intro">
        <div class="intro__inner l-container">
            <div class="intro__row">
                <div class="intro__description">
                    <div class="intro__description__inner">
                        <?php echo $intro_description; ?>
                    </div>
                </div>
                <div class="intro__capabilities">
                    <h3>Capabilities:</h3>
                    <?php if ( $capabilities ) : ?>
                        <ul class="intro__capabilities__list">
                        <?php foreach ( $capabilities as $item ): ?>
                            <li><?php echo $item['capability']; ?></li>
                        <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <?php
    // the query
    $args = array(
        'post_type' => 'work',
        'showposts' => -1,
        'orderby' => 'menu_order'
    );
    $the_query = new WP_Query( $args ); ?>

    <?php if ( $the_query->have_posts() ) : ?>
        <section class="work">
            <div class="work__inner l-container">
                <div class="work__list">
                    <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                        <?php
                        $terms = wp_get_post_terms( get_the_ID(), 'work-type', array('fields=all') );
                        $description = get_field('work_description');
                        $images = get_field('media');
                        $website = get_field('website_url');
                        ?>

                        <div class="work__item">
                            <div class="work__item__content work__item__row">
                                <div class="work__item__title">

                                    <?php if ( $website ) : ?>
                                        <a target="_blank" href="<?php echo $website; ?>" class="work__item__external-link">
                                            <h2><?php the_title(); ?></h2>
                                            <?php echo file_get_contents(get_stylesheet_directory() . '/images/icon__external-link.svg'); ?>
                                        </a>
                                    <?php else: ?>
                                        <h2><?php the_title(); ?></h2>
                                    <?php endif; ?>
                                </div>
                                <?php if ( $description ): ?>
                                    <div class="work__item__description"><?php echo $description; ?></div>
                                <?php endif; ?>
                                <?php if ( !empty($terms) ): ?>
                                    <ul class="work__item__terms">
                                        <?php foreach ( $terms as $term ): ?>
                                            <?php /*<li><a class="c-button" href="<?php echo get_home_url(); ?>/<?php echo $term->tax; ?>/<?php echo $term->slug; ?>"><span><?php echo $term->name; ?></span></a></li>*/?>
                                            <li><a class="c-button" href="#"><span><?php echo $term->name; ?></span></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </div>
                            <div class="work__item__images work__item__row splide" aria-label="Splide Basic HTML Example">
                                <div class="splide__track">
                                    <div class="splide__list">
                                        <?php foreach ( $images as $image ) : ?>
                                            <div class="work__item__image splide__slide">
                                                <?php if ( $image['type'] == 'image' ) : ?>
                                                    <?php if($image['subtype'] == 'gif'): ?>
                                                        <img data-src="<?php echo $image['url']; ?>" src="<?php echo $image['url']; ?>" alt="">
                                                    <?php else: ?>
                                                        <img data-src="<?php echo $image['url']; ?>" src="<?php echo $image['sizes']['work-thumbnail']; ?>" alt="">
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <div class="work__item__video">
                                                        <video src="<?php echo $image['url']; ?>" autoplay muted playsinline loop></video>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
<?php endif; ?>
<?php get_footer(); ?>
    
