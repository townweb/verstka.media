<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package verstka.media
 */

get_header();
?>

    <div class="wp-block-group is-layout-constrained"><form role="search" method="get" action="/" class="wp-block-search__button-outside wp-block-search__text-button wp-block-search"><label for="wp-block-search__input-6" class="wp-block-search__label">Поиск</label><div class="wp-block-search__inside-wrapper "><input type="search" id="wp-block-search__input-6" class="wp-block-search__input" name="s" value="" placeholder="" required=""><button type="submit" class="wp-block-search__button wp-element-button">Найти</button></div></form>


        <div style="height:40px" aria-hidden="true" class="wp-block-spacer"></div>
    </div><div class="wp-block-query is-layout-constrained">
<ul class="wp-block-post-template is-layout-flow">
	<?php
while ( have_posts() ) :
    the_post();

    /**
     * Run the loop for the search to output the results.
     * If you want to overload this in a child theme then include a file
     * called content-search.php and that will be used instead.
     */
    get_template_part( 'template-parts/content', 'post' );

endwhile;

the_posts_navigation();
	?>
</ul>
</div>
<?
get_footer();

