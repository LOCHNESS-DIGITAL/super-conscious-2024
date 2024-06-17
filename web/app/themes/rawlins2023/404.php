<?php
// use Modules\CTA;

get_header();
?>



<main class="main">
	<div class="l-container">
		<article class="article">
			<div class="article__inner">
				<?php
				// NOTE
				// This theme sets up customizer options for the 404 page title and content. Check Appearance > Customize, or go to a 404 page and click Customize in the admin bar.
				// Check inc/customizer.php for more info.
				$page_title = get_theme_mod( 'rawlins_404_page_title', 'Not Found (404)' );
				$content = get_theme_mod( 'rawlins_404_content', 'The content you were looking for could not be found.' );
				?>
				<h1 class="page-title"><?php echo $page_title; ?></h1>

				<div class="entry-content">
					<?php echo $content; ?>
				</div>

			</div>
		</article>
	</div>
</div>



<?php
get_footer();
