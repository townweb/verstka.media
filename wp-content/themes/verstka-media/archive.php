<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package verstka.media
 */

get_header();
?>
<div class="breadcrumbs " typeof="BreadcrumbList" vocab="https://schema.org/">
 <?php
if(function_exists('bcn_display'))
{
    bcn_display();
}
?>
    </div>
    <main class="wp-block-group is-layout-flow single-post verstka-post-content" id="wp--skip-link--target">
        <h1 style="margin-bottom:calc(2 * var(--wp--style--block-gap));" class="has-text-align-left wp-block-post-title has-x-large-font-size"><?php echo str_replace('Рубрика:', '',get_the_archive_title()); ?></h1>

    </main>
<?php 
echo func_archive_news();
echo func_shrt_more_button();
?>


<?php
get_footer();
