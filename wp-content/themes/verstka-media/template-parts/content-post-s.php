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
if ($args['format'] == 'code') {
    $html = '
<li class="wp-block-post post-' . $post_id . ' post type-post status-publish post-style-s format-standard has-post-thumbnail hentry category-article">
    <div class="wp-container-50 wp-block-group">
        <a href="' . $permalink . '" class="post-list-background" style="background-image: url(' . $thumbnail_url . ')"></a>
        <h3  class="has-text-align-left verstka-index-header wp-block-post-title"><a href="' . $permalink . '" target="_self" rel="">' . $title .$delimiter. ' '.get_the_excerpt().'</a></h3>
        <div class="wp-block-template-part">
            <div class="wp-block-group">
                <div class="is-content-justification-left d-flex wp-block-group post-meta">
                    <div style="font-size: var(--wp--custom--font-sizes--x-small);" class="taxonomy-category wp-block-post-terms">' . $term_list . '</div>
                    <div class="mid-dote">·</div>
                    <div style="font-size: var(--wp--custom--font-sizes--x-small);" class="wp-block-post-date"><time datetime="' . $datec . '"><span>' . (calc_publish_date($post)? calc_publish_date($post) : $date  ) . '</span></time></div>
                </div>
            </div>
        </div>
    </div>
</li>';

    echo $html;
    return;
}

?>
<li class="wp-block-post post-<?php echo $post_id; ?> post type-post status-publish post-style-s format-standard has-post-thumbnail hentry category-article">
    <div class="wp-container-50 wp-block-group">
        <a href="<?php echo $permalink; ?>" class="post-list-background" style="background-image: url('<?php echo $thumbnail_url ?>')"></a>
        <h3  class="has-text-align-left verstka-index-header wp-block-post-title"><a href="<?php echo $permalink ?>" target="_self" rel=""><?php  echo $title .$delimiter. ' '.get_the_excerpt() ?></a></h3>
        <div class="wp-block-template-part">
            <div class="wp-block-group">
                <div class="is-content-justification-left d-flex wp-block-group post-meta">
                    <div style="font-size: var(--wp--custom--font-sizes--x-small);" class="taxonomy-category wp-block-post-terms"><?php echo $term_list ?></div>
                    <div class="mid-dote">·</div>
                    <div style="font-size: var(--wp--custom--font-sizes--x-small);" class="wp-block-post-date"><time datetime="<?php echo $datec ?>"><span><?php echo (calc_publish_date($post)? calc_publish_date($post) : $date  ) ?></span></time></div>
                </div>
            </div>
        </div>
    </div>
</li>