<?php get_header(); ?>
<?php if ( have_posts() ) : ?>
    <section class="work">
        <div class="work__inner l-container">
            <div class="work__list">
                <?php while ( have_posts() ) : the_post(); ?>
                    <?php
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
                                        <?php /*<li><a class="c-button" href="<?php echo get_home_url(); ?>/<?php echo $term->tax; ?>/<?php echo $term->slug; ?>"><span><?php echo $term->name; ?></span></a></li>*/?>
                                        <li class="c-button"><span><?php echo $term->name; ?></span></li>
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
                        <div class="work__item__images work__item__row splide" aria-label="Splide Basic HTML Example">
                            <?php 
                            $loading_gif = get_stylesheet_directory_uri() . '/images/icon__loading.gif';
                            if ( get_field( 'loading-gif', 'option' ) ) {
                                $loading_gif = get_field( 'loading-gif', 'option');
                                $loading_gif = $loading_gif['url'];
                            }
                            ?>
                            <div class="work__item__images-loader">
                                <?php echo file_get_contents(get_stylesheet_directory() . '/images/icon-loading-spinner.svg'); ?>
                            </div>
                            <div class="splide__track">
                                <div class="splide__list">
                                    <?php if($images): ?>
                                        <?php foreach ( $images as $image ) : ?>
                                            <div class="work__item__image splide__slide">
                                                <?php if ( $image['type'] == 'image' ) : ?>
                                                    <?php
                                                    $image_src = wp_get_attachment_image_url($image['ID'], 'work-thumbnail');
                                                    $image_src_set = wp_get_attachment_image_srcset( $image['ID'], 'work-thumbnail' );
                                                    ?>
                                                    <?php if($image['subtype'] == 'gif'): ?>
                                                        <img data-src="<?php echo $image['url']; ?>" src="<?php echo $image['url']; ?>"  alt="">
                                                    <?php else: ?>
                                                        <img data-src="<?php echo $image['url']; ?>" src="<?php echo esc_url($image_src) ?>" srcset="<?php echo esc_attr( $image_src_set ); ?>" alt="<?php echo $image['title']; ?>">
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <div class="work__item__video">
                                                        <video src="<?php echo $image['url']; ?>" autoplay muted playsinline loop></video>
                                                        <?php if ( get_field( 'has_audio', $image['id'] ) ): ?>
                                                            <div class="work__item__video__volume-up"><?php echo file_get_contents(get_stylesheet_directory() . '/images/icon__volume-up.svg'); ?></div>
                                                            <div class="work__item__video__volume-down active"><?php echo file_get_contents(get_stylesheet_directory() . '/images/icon__volume.svg'); ?></div>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="work__flyout" id="<?php echo get_post_field( 'post_name', get_post() ); ?>-credits">
                        <div class="work__flyout__inner">
                            <div class="work__flyout__close"><?php echo file_get_contents(get_stylesheet_directory() . '/images/icon__work-flyout-close.svg'); ?></div>
                            <div class="work__flyout__header">
                                <h3 class="work__flyout__title"><?php echo get_the_title(); ?></h3>
                                <div class="work__flyout__long-description">
                                    <?php
                                    if ( $long_description ) {
                                        echo $long_description;
                                    } else {
                                        echo $description;
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php if ( $metrics ) : ?>
                                <div class="work__flyout__metrics">
                                    <h4 class="work__flyout__metrics-title">Results</h3>
                                    <div class="work__flyout__metrics-table">
                                        <div class="work__flyout__metrics-row">
                                            <div class="work__flyout__metrics-item">Metric</div>
                                            <div class="work__flyout__metrics-item">Before</div>
                                            <div class="work__flyout__metrics-item">After</div>
                                        </div>
                                        <?php foreach ( $metrics as $metric ) : ?>
                                            <div class="work__flyout__metrics-row">
                                                <div class="work__flyout__metrics-item"><?php echo $metric['metric_name']; ?></div>
                                                <div class="work__flyout__metrics-item"><?php echo $metric['before']; ?></div>
                                                <div class="work__flyout__metrics-item"><?php echo $metric['after']; ?></div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if ( $team ): ?>
                                <div class="work__flyout__team">
                                    <h4 class="work__flyout__team-title">Team</h3>
                                    <?php foreach ( $team as $item ): ?>
                                        <div class="work__flyout__team-member"><?php echo $item['team_member']; ?></div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                            <?php if ( !empty($work_flyout_terms) ): ?>
                                <ul class="work__flyout__terms work__item__terms">
                                    <?php foreach ( $work_flyout_terms as $term ): ?>
                                        <?php /*<li><a class="c-button" href="<?php echo get_home_url(); ?>/<?php echo $term->tax; ?>/<?php echo $term->slug; ?>"><span><?php echo $term->name; ?></span></a></li>*/?>
                                        <li class="c-button"><span><?php echo $term->name; ?></span></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                            <?php if ( $website ) : ?>
                                <div class="work__flyout__link">
                                    <a target="_blank" href="<?php echo $website; ?>">Visit Website</a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php get_footer(); ?>
    