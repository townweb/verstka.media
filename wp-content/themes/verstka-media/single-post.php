<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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

		<?php
		while ( have_posts() ) :
			the_post();
        ?>
            <h1 style="margin-bottom:calc(2 * var(--wp--style--block-gap));" class="has-text-align-left wp-block-post-title has-x-large-font-size"><? the_title(); ?></h1>
           
			<?php if(is_user_logged_in()){
			?>
			<div class="post-info">
				<div class="post-info_author"><?php
                   echo (get_field('author_name') ? get_field('author_name') : the_author_posts_link()); ?></div>
				<div class="post-info_date">  <time datetime="<?php echo get_the_date('c');?>">
                        <a href="<?php echo get_permalink(); ?>"><?php echo get_the_date('d F, Y');?></a>
                    </time></div>
				<div class="post-info_spacer">|</div>
				<?php 
				$themes = get_the_terms( get_the_ID(),'post_themes' );
				if($themes[0]){
				
				?>
					<div class="post-info_theme"><a href="<? echo get_term_link($themes[0]->term_id)?>"><?php echo $themes[0]->name; ?></a></div><?
						}
				?>
				<div class="post-info_reading_time"><?php echo get_field('time_to_read'); ?></div>
			</div>
			<?
			}?>
			<div class="lead wp-block-post-excerpt"><p class="wp-block-post-excerpt__excerpt"><?php the_excerpt();?></p></div>
            <?
            echo get_the_post_thumbnail(get_the_ID(), 'full', ['class'	=> 'main-post-image']);

            the_content(
                sprintf(
                    wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                        __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'verstka-media' ),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    wp_kses_post( get_the_title() )
                )
            );
		?>
            <div class="wp-block-group post-meta is-content-justification-left is-layout-flex wp-container-8">
                <div style="font-size:var(--wp--custom--font-sizes--x-small);" class="wp-block-post-date">
                    <time datetime="<?php echo get_the_date('c');?>">
                        <a href="<?php echo get_permalink(); ?>"><?php echo get_the_date('d F, Y');?></a>
                    </time>
                </div>
                <?php
                global $post;
                $cat = get_the_category($post->ID);
                ?>
                <div style="font-size:var(--wp--custom--font-sizes--x-small)" class="taxonomy-category wp-block-post-terms">
                    <a href="<?php echo get_term_link($cat[0])?>" rel="tag"><?php echo $cat[0]->name; ?></a>
                </div>


                <div class="likely">
                    <div class="telegram"></div>
                    <div class="facebook"></div>
                    <div class="vkontakte"></div>
                    <div class="twitter"></div>
                </div>
            </div>
        <?php
		endwhile; // End of the loop.
		


		?>
	</main><!-- #main -->

<?php
echo func_shrt_relinks();
get_footer();
