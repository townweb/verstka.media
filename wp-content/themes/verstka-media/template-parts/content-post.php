<?php
if($args['post']){
setup_postdata($args['post']);
$post = $args['post'];
}
$permalink = get_permalink();
$title = get_the_title();
$datec = get_the_date('c');
$date = get_the_date('d F, Y');


$term_list = '';
$post_id = $post->ID;
$thumbnail_url = get_the_post_thumbnail_url();
foreach (wp_get_post_terms($post->ID, 'category') as $term) {
$term_list .= '<a href="' . get_term_link($term) . '">' . $term->name . '</a>';
}
$delimiter = '.';
if(substr($title, -1) == '?' ||
substr($title, -1) == '!' ||
substr($title, -1) == '.'){
$delimiter = '';
}

?>
<li class="wp-block-post post-<?php the_ID();?> post type-post status-publish format-standard has-post-thumbnail hentry category-article">
    <div class="wp-container-50 wp-block-group">
        <h3 style="margin-bottom: calc(2 * var(--wp--style--block-gap)); font-size: 40px;" class="has-text-align-left verstka-index-header wp-block-post-title"><a href="<?php echo get_permalink()?>" target="_self" rel=""><?php the_title();?></a></h3>
        <div style="line-height: 1.4;" class="serif-font highlighter verstka-index-lead wp-block-post-excerpt"><p class="wp-block-post-excerpt__excerpt"><?php the_excerpt(); ?></p></div>
        <div class="wp-block-template-part"><div class="wp-block-group"><div class="is-content-justification-left d-flex wp-block-group post-meta"><div style="font-size: var(--wp--custom--font-sizes--x-small);" class="wp-block-post-date"><time datetime="<?php echo get_the_date('c'); ?>"><a href="<?php echo get_permalink()?>"><?php echo (calc_publish_date($post)? calc_publish_date($post) :get_the_date( 'd F, Y' )  )?></a></time></div><div class="mid-dote">·</div><div style="font-size: var(--wp--custom--font-sizes--x-small);" class="taxonomy-category wp-block-post-terms"><?php foreach (wp_get_post_terms( $post->ID, 'category') as $term){?><a href="<?php echo get_term_link($term)?>"><?php echo $term->name?></a><?php }?></div></div></div></div>
    </div>
</li>