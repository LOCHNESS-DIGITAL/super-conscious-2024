<?php
global $post;
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
  <link rel="dns-prefetch" href="https://fonts.googleapis.com">

	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_stylesheet_directory_uri(); ?>/favicons/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_stylesheet_directory_uri(); ?>/favicons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_stylesheet_directory_uri(); ?>/favicons/favicon-16x16.png">
  <link rel="manifest" href="<?php echo get_stylesheet_directory_uri(); ?>/favicons/site.webmanifest">
  <link rel="mask-icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicons/safari-pinned-tab.svg" color="#000000">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="theme-color" content="#ffffff">

	<?php wp_head(); ?>

  <?php
  $homepage_group = get_field('homepage', 'option');
  $intro_description = $homepage_group['intro_description'];
  // $capabilities = $homepage_group['capabilities'];
  // the query
  $args = array(
      'post_type' => 'work',
      'showposts' => -1,
      'orderby' => 'menu_order'
  );
  $work_query = new WP_Query( $args );
  ?>
</head>
<body <?php body_class('loading'); ?>>
<?php if ( !post_password_required( $post ) ): ?>
  <div class="site-container">
    <?php if ( is_front_page() ) : ?>
      <div class="icon-loading">
        <?php 
        $loading_gif = get_stylesheet_directory_uri() . '/images/icon__loading.gif';
        if ( get_field( 'loading-gif', 'option' ) ) {
          $loading_gif = get_field( 'loading-gif', 'option');
          $loading_gif = $loading_gif['url'];
        }
        ?>
        <img src="<?php echo $loading_gif; ?>" alt="">
      </div>
    <?php endif; ?>

    <header class="header">
      <div class="header__inner l-container">
        <div class="header__row">
          <a href="<?php echo get_home_url(); ?>" class="header__logo"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo__hover-state.gif" alt="Super Conscious Studio" /><?php echo file_get_contents(get_stylesheet_directory() . '/images/super-conscious-logo-2024.svg'); ?></a>
          <div class="intro__description">
              <div class="intro__description__inner">
                  <?php echo $intro_description; ?>
              </div>
          </div>
          <div class="intro__capabilities">
              <?php if ( $work_query->have_posts() ) : ?>
                  <ul class="intro__capabilities__list">
                  <li>Clients:</li>
                  <?php while ( $work_query->have_posts() ) : $work_query->the_post(); ?>
                      <li><a href="#<?php echo get_post_field( 'post_name', get_post() ); ?>"><?php echo get_the_title(); ?></a></li>
                  <?php endwhile; ?>
                  </ul>
              <?php endif; ?>
              <?php wp_reset_postdata(); ?>
          </div>
          <nav class="header__nav">
            <li class="header__nav__item">New projects: <a href="mailto:info@super-conscious.studio" class="header__nav__link">info@super-conscious.studio</a></li>
            <li class="header__nav__item">Careers: <a href="mailto:Careers@super-conscious.studio" class="header__nav__link">Careers@super-conscious.studio</a></li>
          </nav>
          <div class="header__icon">
            <?php echo file_get_contents(get_stylesheet_directory() . '/images/icon-noggin.svg'); ?>
          </div>
        </div>
      </div>
    </header>
<?php else: ?>
  <div class="coming-soon">
    <div class="l-container">
      <div class="header__logo">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo__hover-state.gif" alt="Super Conscious Studio" /><?php echo file_get_contents(get_stylesheet_directory() . '/images/super-conscious-logo-2024.svg'); ?>
      </div>
      <div class="pw-protection">
          <span class="pw-protection__label">what's the password?</span>
          <div class="pw-protection__row">
              <?php echo get_the_password_form(); ?>
              <a href="#" class="pw-protection__button c-button"><span>Enter Site</span></a>
          </div>
      </div>
    </div>
  </div>
<?php endif; ?>