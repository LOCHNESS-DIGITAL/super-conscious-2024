<?php
// use Modules\Hero;

get_header();

// the_post();
?>

<main class="main">
  <div class="l-container l-container--small">
    <div class="main__inner entry-content">
      <h2><?php echo get_the_title(); ?></h2>
      <?php the_content(); ?>
    </div>
  </div>
</main>


<?php
get_footer();
