<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package verstka.media
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="wp-site-blocks">
    <header class="wp-block-template-part">
        <div class="wp-block-group gapless-group is-layout-constrained">
            <div class="wp-block-group alignfull is-layout-constrained" style="padding-top:var(--wp--custom--gap--vertical);padding-bottom:var(--wp--custom--gap--vertical)">
                <div class="wp-block-group site-brand header is-content-justification-space-between is-layout-flex wp-container-3">
                    <div class="wp-block-site-logo">
                        <a href="/" class="custom-logo-link" rel="home" aria-current="page">
                            <img src="/wp-content/uploads/2022/08/verstka-logo.svg" class="custom-logo" alt="Вёрстка" decoding="async" width="153" height="31">
                        </a>
                    </div>
                    <nav class="has-text-color has-black-color is-responsive items-justified-left verstka-menu wp-block-navigation is-content-justification-left is-layout-flex wp-container-2" aria-label="verstka-main-menu">
                        <button aria-haspopup="true" aria-label="Открыть меню" class="wp-block-navigation__responsive-container-open" data-micromodal-trigger="modal-1">
                            <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                 aria-hidden="true" focusable="false">
                                <rect x="4" y="7.5" width="16" height="1.5"></rect>
                                <rect x="4" y="15" width="16" height="1.5"></rect>
                            </svg>
                        </button>
                        <div class="wp-block-navigation__responsive-container  has-text-color has-black-color" style="" id="modal-1">
                            <div class="wp-block-navigation__responsive-close" tabindex="-1" data-micromodal-close="">
                                <div class="wp-block-navigation__responsive-dialog" aria-label="Меню">
                                    <button aria-label="Закрыть меню" data-micromodal-close=""
                                            class="wp-block-navigation__responsive-container-close">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                             height="24" aria-hidden="true" focusable="false">
                                            <path d="M13 11.8l6.1-6.3-1-1-6.1 6.2-6.1-6.2-1 1 6.1 6.3-6.5 6.7 1 1 6.5-6.6 6.5 6.6 1-1z"></path>
                                        </svg>
                                    </button>
                                    <div class="wp-block-navigation__responsive-container-content" id="modal-1-content">
                                        <ul class="wp-block-navigation__container">
                                            <li class=" wp-block-navigation-item wp-block-navigation-link"><a
                                                        class="wp-block-navigation-item__content"
                                                        href="/category/article/"><span
                                                            class="wp-block-navigation-item__label">Истории</span></a>
                                            </li>
                                            <li class=" wp-block-navigation-item wp-block-navigation-link"><a
                                                        class="wp-block-navigation-item__content"
                                                        href="/category/news/"><span
                                                            class="wp-block-navigation-item__label">Новости</span></a>
                                            </li>
                                            <li class=" wp-block-navigation-item wp-block-navigation-link"><a
                                                        class="wp-block-navigation-item__content"
                                                        href="/category/investigations"><span
                                                            class="wp-block-navigation-item__label">Расследования</span></a>
                                            </li>
                                            <li class=" wp-block-navigation-item wp-block-navigation-link"><a
                                                        class="wp-block-navigation-item__content"
                                                        href="/category/interview/"><span
                                                            class="wp-block-navigation-item__label">Интервью</span></a>
                                            </li>
											 <li class=" wp-block-navigation-item wp-block-navigation-link"><a
                                                        class="wp-block-navigation-item__content"
                                                        href="/about"><span
                                                            class="wp-block-navigation-item__label">О нас</span></a>
                                            </li>
                                       
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </nav>
                   <div class="main-links">
                       <a class="support_button" href="https://t.me/svobodnieslova/1527" target="_blank">Поддержать</a>
                       <a class="telegram_ico" target="_blank" href="https://t.me/svobodnieslova"></a>
                       <a class="search_ico" href="https://verstka.media/?s"></a>
                   </div>
                </div>
            </div>
        </div>
        <div style="height:32px" aria-hidden="true" class="wp-block-spacer"></div>
    </header>