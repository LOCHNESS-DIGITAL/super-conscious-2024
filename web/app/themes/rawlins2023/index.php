<?php
// use Modules\CTA;


get_header();
?>

<main class="main">
	<div class="l-container">
		<?php if( have_posts() ): ?>

			<?php while( have_posts() ): the_post(); ?>
				<article class="article">
					<div class="article__inner">
						<h2><?php the_title(); ?></h2>
						<div><?php the_excerpt(); ?></div>
					</div>
				</article>
			<?php endwhile; ?>

			<?php else: ?>

			<?php echo 'No articles found.'; ?>

		<?php endif; ?>
	</div>
</div>


<?php
get_footer();
