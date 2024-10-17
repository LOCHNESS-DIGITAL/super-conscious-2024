<?php
// Template Name: Reel Template
global $post;
$reel = get_field('reel_template', 'option');

get_header();
?>

<main class="main reel">
    <div class="reel__controls">
        <div class="reel__play"><?php echo file_get_contents( get_stylesheet_directory() . '/images/icon__play.svg' ); ?></div>
        <div class="reel__pause active"><?php echo file_get_contents( get_stylesheet_directory() . '/images/icon__pause.svg' ); ?></div>
    </div>
    <?php 
    $reel = $reel['oembed'];
    // Use preg_match to find iframe src.
    preg_match('/src="(.+?)"/', $reel, $matches);
    $src = $matches[1];

    // Add extra parameters to src and replace HTML.
    $params = array(
        'controls'  => 0,
        'autoplay' => 1,
        'muted' => 1,
        '#t' => '0m3s'
    );
    $new_src = add_query_arg($params, $src);
    $reel = str_replace($src, $new_src, $reel);

    // Add extra attributes to iframe HTML.
    $attributes = 'muted hd controls="false" frameborder="0"';
    $reel = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $reel);

    // Display customized HTML.
    echo $reel;
    ?>
    
    <div class="reel__volume">
        <a href="#" class="c-button"><span>Sound On</span></a>
    </div>
</main>

<?php get_footer(); ?>
