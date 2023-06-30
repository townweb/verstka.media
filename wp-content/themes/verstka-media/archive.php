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


<?php 
echo func_archive_news();
echo func_shrt_more_button();
?>


<?php
get_footer();
