<?php
// use Modules\CTA;
$homepage_group = get_field('homepage', 'option');
$intro_description = $homepage_group['intro_description'];
$capabilities = $homepage_group['capabilities'];

get_header();
?>

    <?php
    // featured work
    $featured_work = $homepage_group['featured_work'];
    ?>

    <?php if ( isset($featured_work) && !empty($featured_work) ) : ?>
        <section class="work">
            <div class="work__inner l-container">
                <div class="work__list">
                    <?php foreach ( $featured_work as $item ) : ?>
                        <?php
                        $post = $item;
                        $post = get_post( $item->ID );
                        setup_postdata( $post );
                        $terms = wp_get_post_terms( get_the_ID(), 'work-type', array('fields=all') );
                        $work_flyout_terms = wp_get_post_terms( get_the_ID(), 'work-type', array('fields=all') );
                        $description = get_field('work_description');
                        $long_description = get_field('long_description');
                        $metrics = get_field('metrics');
                        $team = get_field('team');
                        $images = get_field('media');
                        $website = get_field('website_url');
                        ?>

                        <div class="work__item" id="<?php echo get_post_field( 'post_name', get_post() ); ?>">
                            <div class="work__item__content work__item__row">
                                <div class="work__item__title">
                                    <h2><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?> <?php echo file_get_contents( get_stylesheet_directory() . '/images/icon-arrow-right.svg' ); ?></a></h2>
                                </div>
                                
                                <div class="work__item__description"><?php echo $description; ?></div>
                                
                                <?php if ( !empty($terms) ): ?>
                                    <ul class="work__item__terms">
                                        <?php foreach ( $terms as $term ): ?>
                                            <?php /*<li><a class="c-button" href="<?php echo get_home_url(); ?>/work-type/<?php echo $term->slug; ?>"><span><?php echo $term->name; ?></span></a></li>*/?>
                                            <li><a class="c-button" href="#"><span><?php echo $term->name; ?></span></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                                <div class="work__item__links">
                                    <?php if ( $website ) : ?>
                                        <div class="work__item__link">
                                            <a target="_blank" href="<?php echo $website; ?>">Visit Website</a>
                                        </div>
                                    <?php endif; ?>
                                    <div class="work__item__link work__item__link--more-info">
                                        <?php /*<a href="#<?php echo get_post_field( 'post_name', get_post() ); ?>-credits">More Info</a>*/?>
                                        <a class="c-button" href="<?php echo get_permalink(); ?>">View Project</a>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="work__item__description"><?php echo $description; ?></div>
                            
                            <?php if ( !empty($terms) ): ?>
                                <ul class="work__item__terms">
                                    <?php foreach ( $terms as $term ): ?>
                                        <?php /*<li><a class="c-button" href="<?php echo get_home_url(); ?>/<?php echo $term->tax; ?>/<?php echo $term->slug; ?>"><span><?php echo $term->name; ?></span></a></li>*/?>
                                        <li><a class="c-button" href="#"><span><?php echo $term->name; ?></span></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                            <div class="work__item__links">
                                <?php if ( $website ) : ?>
                                    <div class="work__item__link">
                                        <a target="_blank" href="<?php echo $website; ?>">Visit Website</a>
                                    </div>
                                <?php endif; ?>
                                <div class="work__item__link work__item__link--more-info">
                                    <a href="#<?php echo get_post_field( 'post_name', get_post() ); ?>-credits">More Info</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <?php wp_reset_postdata(); ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
<?php get_footer(); ?>
    
