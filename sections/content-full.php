<?php
while (have_posts()) {
    the_post();
?>
    <article <?php post_class('small-24 medium-24 large-24 column'); ?>>
        <h1><?php the_title(); ?></h1>
        <?php the_content(); ?>
    </article>
<?php
}
?>
