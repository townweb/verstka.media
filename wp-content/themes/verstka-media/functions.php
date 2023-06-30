<?php
/**
 * verstka.media functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package verstka.media
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}


if ( function_exists( 'add_theme_support' ) ) add_theme_support( 'post-thumbnails' );


add_action('wp_enqueue_scripts', 'themeAjax_data', 99);
function themeAjax_data()
{

    wp_localize_script('verstka-media-js', 'themeAjax',
        array(
            'url' => admin_url('admin-ajax.php')
        )
    );


}
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function verstka_media_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on verstka.media, use a find and replace
		* to change 'verstka-media' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'verstka-media', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );


	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );


	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'verstka-media' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'verstka_media_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'verstka_media_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function verstka_media_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'verstka_media_content_width', 640 );
}
add_action( 'after_setup_theme', 'verstka_media_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function verstka_media_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'verstka-media' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'verstka-media' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'verstka_media_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function verstka_media_scripts() {
    wp_enqueue_style( 'verstka-media-style', get_stylesheet_uri(), array(),  filemtime(dirname(__FILE__).'/style.css') );

    wp_enqueue_style('verstka-media-ponyfill', get_template_directory_uri() . '/assets/ponyfill.css', array(),
        filemtime(dirname(__FILE__).'/assets/ponyfill.css'));
    wp_enqueue_style('verstka-media-theme', get_template_directory_uri() . '/assets/theme.css', array(),
        filemtime(dirname(__FILE__).'/assets/theme.css'));

    wp_enqueue_script( 'verstka-media-js', get_template_directory_uri() . '/assets/theme.js', array(),  filemtime(dirname(__FILE__).'/assets/theme.js'), true );
    wp_enqueue_script( 'verstka-media-view-modal', '/wp-includes/blocks/navigation/view-modal.min.js?ver=f51363b18f0497ec84da', array(), 1, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'verstka_media_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

add_filter( 'posts_search', function( $search, \WP_Query $q )
{
    if( ! is_admin() && empty( $search ) && $q->is_search() && $q->is_main_query() ){
        $search .=" AND 0=1 ";
    }

    return $search;
}, 10, 2 );

function message_search_result(){



    $allsearch = get_posts("s=".$_REQUEST['s']."&showposts=-1");
    if(count($allsearch) == 0){
        $html = <<<HTML
<div class="wp-block-post-template">
<h3 class="search-not-found-title">К сожалению, мы ничего не нашли.</h3>
</div> 
HTML;
        return $html;
    }

}
add_shortcode('search_result','message_search_result');

function load_template_part($template_name, $part_name=null,$params = null) {
    ob_start();
    get_template_part($template_name, $part_name,$params);
    $var = ob_get_contents();
    ob_end_clean();
    return $var;
}

function getExlcudePostsfromFirstTwoPages(){
    $exludesPost = array_merge(buildMainPageNews(1,2,'xl',NULL,'array'),
        buildMainPageNews(1,8,'m',NULL,'array'),
        buildMainPageNews(1,12,'s',NULL,'array'));
    return $exludesPost;
}

//формирование html новостей
function buildMainPageNews($page,$post_count,$format = '',$term_id=NULL,$answerType = 'html'){

    $args = array(
        'page' => $page,
        'paged' => $page,
        'posts_per_page' => $post_count,
        'category__not_in' => array(12),
        'post_status'=>'publish'
    );

    if ($page < 3){
        $args['meta_query'] = array(
            array(
                'key' => 'news_format',
                'value' => $format,
                'compare' => 'LIKE',
            ),
        );
    }else{
        $args['page'] = ($page-2);
        $args['paged'] = ($page-2);
        $args['post__not_in'] = getExlcudePostsfromFirstTwoPages();
    }


    if($term_id){
        $args['cat']=$term_id;
    }

    $query = new WP_Query($args);

    $response=array();
    $posts_ex = array();
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            setup_postdata($query->the_post());
            if($answerType == 'array'){
                $posts_ex[] = get_the_ID();
                continue;
            }


            // This is where the post's data is set up
            $response[$format][] = load_template_part('template-parts/content-post'.($format?'-'.$format:''),null, array('format'=>'code'));
            wp_reset_postdata();
        }
    }
    if($answerType == 'array'){
        return $posts_ex;
    }
    return $response;

}

function build_newsblock($page = 1){
    $args = array(
        'paged' => $page,
        'posts_per_page' => 5,
        'category__in' => array(12),
        'post_status' => 'publish',
    );
    $news = get_posts($args);
    $news_html = '
    <div class="main_news_block">
        <div class="last_new">
    ';
    foreach ($news as $new_key => $new_value){

        $news_html .= '
        <div class="main_new_block">
            <a href="'.get_permalink($new_value->ID).'" class="new-title" href="">'.$new_value->post_title.'</a>
            <span class="new-date">'. (calc_publish_date($new_value)? calc_publish_date($new_value) :get_the_date( 'd F, Y',$new_value->ID )  ).'</span>
        </div>';

        if($new_key == 0){
            $news_html .= '
<a href="https://verstka.media/category/news/" class="read_all_news">Читать все новости</a>
</div>
        <div class="last_news">';
        }

    }

    return $news_html.'</div>
    </div>';

}

// шорт код вывода новостей на главной

function func_news_list($page = 1){
    $page = 1;
    $page = (isset($_POST['page']) ? intval($_POST['page']) : $page);

    $args = array(
        'page' => 1,
        'posts_per_page' => 1,
        'category__not_in' => array(12),
        'post_status' => 'publish',
        'meta_query' => array(
            'relation' => 'OR',
            array(
                'key' => 'news_format',
                'value' => 'm'
            ),
            array(
                'key' => 'news_format',
                'value' => 's'
            ),
        )
    );
    $postFormat = get_post_meta(get_posts($args)[0]->ID,'news_format',true);

    $response='';

    $posts_array = array();
    $term_id = NULL;
    if($_POST['term_id']){
        $term_id=$_POST['term_id'];
    }

    $postmap =
        array(
            1 => array(0,'s'),
            2 => array(1,'s'),
            3 => array(2,'s'),
            4 => array(0,'xl'),
            5 => array(0,'m'),
            6 => array(1,'m'),
            7 => array(3,'s'),
            8 => array(4,'s'),
            9 => array(5,'s'),
            10 => array(2,'m'),
            11 => array(3,'m')
        );

    if($postFormat =='m'){
        $postmap =
            array(

                1 => array(0,'m'),
                2 => array(1,'m'),
                3 => array(0,'xl'),
                4 => array(0,'s'),
                5 => array(1,'s'),
                6 => array(2,'s'),
                7 => array(2,'m'),
                8 => array(3,'m'),
                9 => array(3,'s'),
                10 => array(4,'s'),
                11 => array(5,'s')

            );
    }


    if(wp_is_mobile()){

        $posts_array = buildMainPageNews($page,15,'',$term_id);
        foreach ($posts_array[''] as $post_key => $post_value){
            $response .= $post_value;
            if ($post_key == 0 ) {
                $response .= build_newsblock($page);
            }
        }
    }
    elseif ($page < 3){

        $posts_array = array_merge(buildMainPageNews($page,1,'xl',$term_id),
            buildMainPageNews($page,4,'m',$term_id),
            buildMainPageNews($page,6,'s',$term_id));


        foreach ($postmap as $post_key => $post_value) {

            $response .= $posts_array[$post_value[1]][$post_value[0]];

            if ($post_key == 2 && $postFormat =='m') {
                $response .= build_newsblock($page);
            }

            if ($post_key == 3 && $postFormat =='s') {
                $response .= build_newsblock($page);
            }
        }

    }
    else{

        $posts_array = buildMainPageNews($page,15,'s',$term_id);
        $i=0;
        foreach ($posts_array['s'] as $post_value){
            $i++;
            $response .= $post_value;

            if($i == 3)
                $response .= build_newsblock($page);
        }
    }

    if($page==1){
        $response = '
    <main class="wp-block-query serif-font" id="wp--skip-link--target">
        <ul class="wp-container-custom wp-block-post-template">
'.$response.'</ul>
<div class="wp-container-custom"><div class="more_button_main" data-term-id="'.$term_id.'" data-page="1">Ещё 15 историй</div></div>
</main>';
    }
    if($page > 1){
        echo $response;
    }
    else{
        return $response;
    }



    if($page!=1) {
        wp_die();
    }
}

add_action('wp_ajax_getPostsPerPageMain', 'func_news_list');
add_action('wp_ajax_nopriv_getPostsPerPageMain', 'func_news_list');
add_shortcode('news_list','func_news_list');

function calc_publish_date($post){

    $date_now = current_time('mysql');
    $post_publish_date = get_the_date('Y-m-d H:i:s',$post);
    $to_time = strtotime($date_now);
    $from_time = strtotime($post_publish_date);
    $time_diff = ((($to_time - $from_time)/60));
    if($time_diff < 60){
        return intval($time_diff).' минут назад';
    }elseif ($time_diff > 59 && $time_diff < 1440){
        return intval($time_diff/60).' часов назад';
    }else{
        return false;
    }
}

function func_shrt_relinks()
{
    global $post;

    $post_main = $post;

    $html = '<div class="wp-container-10 is-layout-constrained wp-block-group">
<div style="height:48px" aria-hidden="true" class="wp-block-spacer"></div>';

    if (get_field('h2_before_news', $post->ID)) {
        $html .= '<h2 class="verstka-telegram-link" style="max-width:100%;width:1245px">' . get_field('h2_before_news', $post->ID) . '</h2> <div style="height:48px" aria-hidden="true" class="wp-block-spacer"></div>';
    }

    if (get_field('relink_news', $post->ID)) {


        $html .= '<ul class="wp-container-custom wp-block-post-template">';

        foreach (get_field('relink_news', $post->ID) as $new) {

            setup_postdata($new);
            $post=$new;
            //var_dump($new);
            $html .= load_template_part('template-parts/content-post-s',null, array('format'=>'code'));

            wp_reset_postdata();
            $post = $post_main;
        }
        $html .= '</ul>';
    }

    $html .= '</div>
<style>
.wp-block-post-template,
.wp-block-query-loop {
 margin-top:0;
 margin-bottom:0;
 list-style:none;
 padding:0
}
.wp-block-post-template.wp-block-post-template,
.wp-block-query-loop.wp-block-post-template {
 background:none
}
.wp-block-post-template.is-flex-container,
.wp-block-query-loop.is-flex-container {
 flex-direction:row;
 display:flex;
 flex-wrap:wrap;
 gap:1.25em
}
.wp-block-post-template.is-flex-container li,
.wp-block-query-loop.is-flex-container li {
 margin:0;
 width:100%
}
@media (min-width:600px) {
 .wp-block-post-template.is-flex-container.is-flex-container.columns-2>li,
 .wp-block-query-loop.is-flex-container.is-flex-container.columns-2>li {
  width:calc(50% - .625em)
 }
 .wp-block-post-template.is-flex-container.is-flex-container.columns-3>li,
 .wp-block-query-loop.is-flex-container.is-flex-container.columns-3>li {
  width:calc(33.33333% - .83333em)
 }
 .wp-block-post-template.is-flex-container.is-flex-container.columns-4>li,
 .wp-block-query-loop.is-flex-container.is-flex-container.columns-4>li {
  width:calc(25% - .9375em)
 }
 .wp-block-post-template.is-flex-container.is-flex-container.columns-5>li,
 .wp-block-query-loop.is-flex-container.is-flex-container.columns-5>li {
  width:calc(20% - 1em)
 }
 .wp-block-post-template.is-flex-container.is-flex-container.columns-6>li,
 .wp-block-query-loop.is-flex-container.is-flex-container.columns-6>li {
  width:calc(16.66667% - 1.04167em)
 }
}

</style>';


    return $html.
        '<div class="verstka-telegram-link mt-3"></div>'.func_news_list();

}

add_shortcode('relinks', "func_shrt_relinks");

function func_archive_news(){


    $args = array(
        'posts_per_page' => 15,
        'post_status'=>'publish',
        'cat' => get_queried_object_id()
    );

    if(is_author()){
        unset($args['cat']);
        $args['author'] = get_queried_object_id();
    }

    global $query_string;
    //$posts = query_posts($query_string);

    $posts =   get_posts($args);
    $post_html = '<main class="is-layout-constrained">
<ul '.((get_queried_object_id() == '12')? 'style="list-style:none"' :'').' 
class="'.((get_queried_object_id() == '12')?'':'wp-container-custom').' wp-block-post-template" >';
    foreach ($posts as $post){
        wp_reset_postdata();
        setup_postdata($post);
        if(get_queried_object_id() == '12' || is_author()) {
            $post_html .= load_template_part('template-parts/content-post', null, array('format' => 'code', 'post' => $post));
        }else{
            $post_html .= load_template_part('template-parts/content-post-s', null, array('format' => 'code', 'post' => $post));

        }
        wp_reset_postdata();
    }

    return $post_html.'</ul></main>';

}


add_shortcode('archives_news','func_archive_news');

function func_shrt_more_button()
{
    $term_id = 0;

    if(get_queried_object_id()){
        $term_id = get_queried_object_id();
    }
    if(is_front_page()){
        return '<div class="more_button_main" data-term-id="'.$term_id.'" data-page="1">Ещё 15 историй</div>';
    }

    if(is_author()){
        return '<div class="more_button" data-author-id="'.$term_id.'" data-term-id="'.$term_id.'" data-page="1">Ещё 15 историй</div>';
    }

    return '<div class="more_button" data-term-id="'.$term_id.'" data-page="1">Ещё 15 историй</div>';
}

add_shortcode('more_button', 'func_shrt_more_button');

function get_postsPerPage()
{
    global $post;
    $page = intval($_POST['page']);
    $args = 'page=' . $page . '&paged=' . $page . '&posts_per_page=15';
    if(isset($_POST['author'])){
        $args .='&author='.$_POST['author'];
    }
    elseif($_POST['term_id']){
        $args .='&cat='.$_POST['term_id'];
    }
    $query = new WP_Query($args);
    $response = array();
    $response['type'] = 'have_not_post';
    $response['body'] = '';

    if ($query->have_posts()) {
        $response['type'] = 'have_post';
        while ($query->have_posts()) {
            setup_postdata($query->the_post());
            // This is where the post's data is set up

            if($_POST['term_id'] == '12' || isset($_POST['author'])){
                get_template_part('template-parts/content-post','');
            }else{
                get_template_part('template-parts/content-post-s','');
            }

        }
    } else {
        echo '408'; // нет постов
    }

    wp_die();
}

add_action('wp_ajax_getPostsPerPage', 'get_postsPerPage');
add_action('wp_ajax_nopriv_getPostsPerPage', 'get_postsPerPage');

function shrt_spoler($atts,$content){

    return <<<HTML
<span class="intextSpoiler"><span class="spoilerIcon">i</span><span style="display: none;" class="spoilerText">&nbsp;{$content}</span><span style="display: none;" class="spoilerClose">×</span></span>
HTML;

}

add_shortcode('spoilerText','shrt_spoler');

function cptui_register_my_taxes() {

    /**
     * Taxonomy: Темы для статей.
     */

    $labels = [
        "name" => esc_html__( "Темы для статей", "verstka-media" ),
        "singular_name" => esc_html__( "Тема для статей", "verstka-media" ),
    ];


    $args = [
        "label" => esc_html__( "Темы для статей", "verstka-media" ),
        "labels" => $labels,
        "public" => true,
        "publicly_queryable" => true,
        "hierarchical" => true,
        "show_ui" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "query_var" => true,
        "rewrite" => false,
        "show_admin_column" => false,
        "show_in_rest" => true,
        "show_tagcloud" => false,
        "rest_base" => "post_themes",
        "rest_controller_class" => "WP_REST_Terms_Controller",
        "rest_namespace" => "wp/v2",
        "show_in_quick_edit" => false,
        "sort" => false,
        "show_in_graphql" => false,
    ];
    register_taxonomy( "post_themes", [ "post" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes' );