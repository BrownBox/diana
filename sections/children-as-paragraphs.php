<?php
/**
 * Section for displaying children as paragraphs
 */

global $post;

$children = bb_get_children($post);
?>
<aside class="small-24 medium-5 large-5 column">
    <?php get_sidebar('children-as-paragraphs'); ?>
</aside>
<div class="small-24 medium-19 large-19 column">
<?php
foreach ($children as $child) {
    $id = $child->ID;
    $slug = get_the_slug($child->ID);
    $title = $child->post_title;
    $content = apply_filters('the_content', $child->post_content);
    $read_more_label = get_theme_mod(ns_ . 'read_more_label', __( 'Read more on this topic'), ns_);
    $read_more_link = bb_has_children($child->ID) ? '<p><a href="' . $slug . '">' . $read_more_label . '</a></p>' : '';
?>
    <article id="<?php echo $slug; ?>">
        <h2><?php echo $title; ?></h2>
        <?php echo $content; ?>
        <?php echo $read_more_link; ?>
    </article>
<?php
}
?>
</div>
