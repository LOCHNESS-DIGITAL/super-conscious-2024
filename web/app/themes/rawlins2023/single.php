<?php
// use Modules\Hero;

get_header();

$terms = wp_get_post_terms( get_the_ID(), 'work-type', array('fields=all') );
$work_flyout_terms = wp_get_post_terms( get_the_ID(), 'work-type', array('fields=all') );
$description = get_field('work_description');
$long_description = get_field('long_description');
$metrics = get_field('metrics');
$team = get_field('team');
$images = get_field('media');
$website = get_field('website_url');
$sidebar_jumplinks = array();
$flex_content = get_field('main_content');

if ( $flex_content ) :
  $i = 0;
  foreach ( $flex_content as $item ):
    
    if ( $item['acf_fc_layout'] == 'content_block' && !empty($item['section_title'] ) ) {
      $sidebar_jumplinks[$i]['title'] = $item['section_title'];
      $sidebar_jumplinks[$i]['slug'] = preg_replace('/\W+/', '-', strtolower(trim($item['section_title'])));
      $i++;
    }
  endforeach;
endif;

?>

<section class="work-single">
  <div class="work-single__inner">
      <div class="work-single__column work-single__column--info">
        <div class="work__item__content">
          <div class="work__item__title">
            <h2><?php the_title(); ?></h2>
          </div>
          
          <div class="work__item__description"><?php echo $description; ?></div>
          
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
          <?php if ( !empty($sidebar_jumplinks) ): ?>
              <ul class="work__item__terms">
                  <?php foreach ( $sidebar_jumplinks as $item ): ?>
                      <li><a class="work__item__link work__item__link--term <?php echo $item['slug']; ?>" href="#<?php echo $item['slug']; ?>"><?php echo $item['title']; ?></a></li>
                  <?php endforeach; ?>
              </ul>
          <?php endif; ?>
        </div>
      </div>
      <div class="work-single__column work-single__column--content">
        <?php if ( have_rows('main_content') ) : ?>
          <main class="work-single__main">
            <?php $current_section = false; ?>
            <?php while ( have_rows('main_content') ) : the_row(); ?>
              <?php if ( get_row_layout() == 'one_column_media_block' ) : ?>
                <?php
                $media = get_sub_field('item');
                $media = $media[0];
                if ( $media['type'] == 'video' ) {
                  $media_src = $media['url'];
                } else {
                  $image_src = wp_get_attachment_image_url($media['ID'], 'work-thumbnail');
                  $image_src_set = wp_get_attachment_image_srcset( $media['ID'], 'work-thumbnail' );
                }
                ?>
                <div class="work-single__block one-column-media" <?php if($current_section) { echo 'data-section="'.$current_section.'"'; } ?>>
                  <?php if ( $media['type'] == 'video' ) : ?>
                    <?php
                    $aspect_ratio = $media['width'] . '/' . $media['height'];
                    $aspect_ratio_type = 'landscape';
                    if ( $media['width'] < $media['height'] ) {
                      $aspect_ratio = $media['height'] . '/' . $media['width'];
                      $aspect_ratio_type = 'portrait';
                    }
                    ?>
                    <div class="one-column-media__video">
                      <video data-aspect-ratio="<?php echo $aspect_ratio_type; ?>" style="aspect-ratio: <?php echo $aspect_ratio; ?>" src="<?php echo $media['url']; ?>" autoplay muted playsinline loop></video>
                      <?php if ( get_field( 'has_audio', $media['id'] ) ): ?>
                          <div class="work__item__video__volume-up"><?php echo file_get_contents(get_stylesheet_directory() . '/images/icon__volume-up.svg'); ?></div>
                          <div class="work__item__video__volume-down active"><?php echo file_get_contents(get_stylesheet_directory() . '/images/icon__volume.svg'); ?></div>
                      <?php endif; ?>
                    </div>
                  <?php else: ?>
                    <img src="<?php echo $image_src; ?>" srcset="<?php echo $image_src_set; ?>" alt="">
                  <?php endif; ?>
                </div>
              <?php elseif ( get_row_layout() == 'two_column_media_block' ): ?>
                <?php $medias = get_sub_field('items'); ?>
                <?php if ( $medias ): ?>
                  <div class="work-single__block two-column-media" <?php if($current_section) { echo 'data-section="'.$current_section.'"'; } ?>>
                    <div class="two-column-media__row">
                      <?php foreach ( $medias as $media ) : ?>
                        <?php
                        if ( $media['type'] == 'video' ) {
                          $media_src = $media['url'];
                        } else {
                          $image_src = wp_get_attachment_image_url($media['ID'], 'work-thumbnail');
                          $image_src_set = wp_get_attachment_image_srcset( $media['ID'], 'work-thumbnail' );
                        }
                        ?>
                        <?php if ( $media['type'] == 'video' ) : ?>
                          <?php
                          $aspect_ratio = $media['width'] . '/' . $media['height'];
                          $aspect_ratio_type = 'landscape';
                          if ( $media['width'] < $media['height'] ) {
                            $aspect_ratio = $media['height'] . '/' . $media['width'];
                            $aspect_ratio_type = 'portrait';
                          }
                          ?>
                          <div class="two-column-media__item">
                            <video data-aspect-ratio="<?php echo $aspect_ratio_type; ?>" style="aspect-ratio: <?php echo $aspect_ratio; ?>" src="<?php echo $media['url']; ?>" autoplay <?php if ( !get_field( 'has_audio', $media['id'] ) ) { echo 'muted'; } ?> playsinline loop></video>
                            <?php if ( get_field( 'has_audio', $media['id'] ) ): ?>
                                <div class="work__item__video__volume-up"><?php echo file_get_contents(get_stylesheet_directory() . '/images/icon__volume-up.svg'); ?></div>
                                <div class="work__item__video__volume-down active"><?php echo file_get_contents(get_stylesheet_directory() . '/images/icon__volume.svg'); ?></div>
                            <?php endif; ?>
                          </div>
                        <?php else: ?>
                          <div class="two-column-media__item">
                            <img src="<?php echo $image_src; ?>" srcset="<?php echo $image_src_set; ?>" alt="">
                          </div>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </div>
                  <?php endif; ?>
                </div>
              <?php elseif ( get_row_layout() == 'content_block' ): ?>
                <?php $current_section = preg_replace('/\W+/', '-', strtolower(trim(get_sub_field('section_title')))); ?>
                <div id="<?php echo $current_section; ?>" class="work-single__block content-block" <?php if($current_section) { echo 'data-section="'.$current_section.'"'; } ?>>
                  <div class="content-block__content">
                    <?php if ( get_sub_field('section_title') ): ?>
                      <span class="content-block__title"><?php echo get_sub_field('section_title'); ?></span>
                    <?php endif; ?>
                    <?php echo get_sub_field('content'); ?>
                  </div>
                </div>
              <?php endif; ?>
            <?php endwhile; ?>
          </main>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <nav class="work-single__nav">
    <?php
    $next_post = get_previous_post();
    $prev_post = get_next_post();
    $next_inactive = true;
    $prev_inactive = true;
    $next_post_link = '#';
    $prev_post_link = '#';
    if ( is_a( $prev_post , 'WP_Post' ) ) {
      $prev_inactive = false;
      $prev_post_link = get_permalink( $prev_post->ID );
    }
    if ( is_a( $next_post , 'WP_Post' ) ) {
      $next_inactive = false;
      $next_post_link = get_permalink( $next_post->ID );
    }
    ?>

      <a href="<?php echo $prev_post_link; ?>" class="work-single__nav-item work-single__nav-item--back <?php if($prev_inactive){ echo 'work-single__nav-item--inactive';} ?>"><?php echo file_get_contents(get_stylesheet_directory() . '/images/icon-arrow-right.svg'); ?> Back</a>
      <a href="<?php echo get_home_url(); ?>/work" class="work-single__nav-item work-single__nav-item--all">All</a>
      <a href="<?php echo $next_post_link; ?>" class="work-single__nav-item work-single__nav-item--next <?php if($next_inactive){ echo 'work-single__nav-item--inactive';} ?>">Next <?php echo file_get_contents(get_stylesheet_directory() . '/images/icon-arrow-right.svg'); ?></a>
  </nav>

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
                      <li><a class="c-button" href="#"><span><?php echo $term->name; ?></span></a></li>
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
</section>

<?php
get_footer();
