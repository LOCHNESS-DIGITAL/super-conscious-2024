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
  $global_options = get_field('global_options', 'option');
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

  $logo = file_get_contents(get_stylesheet_directory() . '/images/super-conscious-logo-2024.svg');
  if ( $global_options['logo'] ) {
    $logo = $global_options['logo'];
    $logo = $logo['url'];
    $logo = '<img src="'.$logo.'" alt="Super Conscious Logo" />';
  }
  $logo_hover = get_stylesheet_directory_uri('/images/logo__hover-state.gif');
  if ( $global_options['logo_hover_gif'] ) {
    $logo_hover = $global_options['logo_hover_gif'];
    $logo_hover = $logo_hover['url'];
  }
  ?>
</head>

<body <?php if ( !isset($_COOKIE['firstVisit']) ) { body_class('loading'); } ?>>
<div class="site-container">
  <?php if ( !isset($_COOKIE['firstVisit']) ) : ?>
    <div class="icon-loading" <?php if($global_options['loading_background_color']){ echo 'style="background-color:'. $global_options['loading_background_color'] . ';"';}?>>
      <?php 
      $loading_gif = get_stylesheet_directory_uri() . '/images/icon__loading.gif';
      if ( $global_options['loading_gif'] ) {
        $loading_gif = $global_options['loading_gif'];
        $loading_gif = $loading_gif['url'];
      }
      ?>
      <img src="<?php echo $loading_gif; ?>" alt="">
    </div>
  <?php endif; ?>
  <nav class="l-navigation">
    <div class="l-navigation__inner l-container">
      <ul>
        <li><a <?php if (!is_page_template( 'template-reel.php' )){ echo 'class="active"'; } ?> href="<?php echo get_home_url(); ?>">Work</a></li>
        <li><a <?php if (is_page_template( 'template-reel.php' )){ echo 'class="active"'; } ?> href="<?php echo get_home_url(); ?>/reel">Reel</a></li>
      </ul>
    </div>
  </nav>
  <header class="header">
    <div class="header__inner l-container">
      <div class="header__row">
        <div class="header__logo">
          <a href="<?php echo get_home_url(); ?>"class="header__logo__link">
            <img class="header__logo--hover" src="<?php echo $logo_hover; ?>" alt="Super Conscious Studio" />
            <?php echo $logo; ?>
          </a>
        </div>
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
      <?php if ( is_post_type_archive('work') || is_tax( 'work-type' ) && !is_single() || is_front_page() ) : ?>
        <div class="work-navigation">
          <ul>
            <li>View:</li>
            <li><a class="c-button <?php if ( is_post_type_archive('work') ) { echo 'active'; } ?>" href="<?php echo get_home_url(); ?>/work">all</a></li>
            <li><a class="c-button <?php if ( is_tax('work-type', 'product-design')  ) { echo 'active'; } ?>" href="<?php echo get_home_url(); ?>/work-type/product-design">Product</a></li>
            <li><a class="c-button <?php if ( is_tax('work-type', 'brand-identity')  ) { echo 'active'; } ?>" href="<?php echo get_home_url(); ?>/work-type/brand-identity">Brand</a></li>
            <li><a class="c-button <?php if ( is_tax('work-type', 'animation')  ) { echo 'active'; } ?>" href="<?php echo get_home_url(); ?>/work-type/animation">Animation</a></li>
          </ul>
        </div>
      <?php endif; ?>
    </div>
  </header>