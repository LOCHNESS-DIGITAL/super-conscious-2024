<?php
global $post;
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
  <link rel="dns-prefetch" href="https://fonts.googleapis.com">

	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_stylesheet_directory_uri(); ?>/favicons/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_stylesheet_directory_uri(); ?>/favicons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_stylesheet_directory_uri(); ?>/favicons/favicon-16x16.png">
  <link rel="manifest" href="<?php echo get_stylesheet_directory_uri(); ?>/favicons/site.webmanifest">
  <link rel="mask-icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicons/safari-pinned-tab.svg" color="#000000">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="theme-color" content="#ffffff">

	<?php wp_head(); ?>

</head>
<body <?php body_class('loading'); ?>>
<?php if ( !post_password_required( $post ) ): ?>
  <div class="site-container">
    <div class="icon-loading">
      <img src="<?php echo get_stylesheet_directory_uri() . '/images/icon__loading.gif'; ?>" alt="">
    </div>

    <header class="header">
      <div class="header__inner l-container">
        <div class="header__row">
          <a href="<?php echo get_home_url(); ?>" class="header__logo"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo__hover-state.gif" alt="Relative Studio" /><?php echo file_get_contents(get_stylesheet_directory() . '/images/relative-studio-2023-logo.svg'); ?></a>
          <nav class="header__nav">
            <a href="<?php echo get_home_url(); ?>" class="c-button <?php if(is_front_page()) { ?>c-button--active<?php } ?>">Work</a>
            <a href="<?php echo get_home_url(); ?>/info" class="c-button <?php if(!is_front_page()) { ?>c-button--active<?php } ?>"><span>Info</span></a>
          </nav>
        </div>
      </div>
    </header>
<?php else: ?>
  <div class="coming-soon">
    <div class="l-container">
      <div class="header__logo">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo__hover-state.gif" alt="Relative Studio" /><?php echo file_get_contents(get_stylesheet_directory() . '/images/relative-studio-2023-logo.svg'); ?>
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