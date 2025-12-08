<!DOCTYPE html>
<html <?php language_attributes(); ?>>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- Style-->
    <?php wp_head(); ?>
    <!-- Script-->
    <?php $headerCode = get_field('custom_code', "options")['header']; ?>
    <?php if (!is_null($headerCode)) : ?> <?= $headerCode ?> <?php endif; ?>
</head>

<body <?php
        $body_class = isset($GLOBALS['CANHCAM']['bg_body']) ? $GLOBALS['CANHCAM']['bg_body'] : ''; ?>
    <?php echo body_class($body_class); ?>>
    <?php $header = get_field('header_options', 'options'); ?>
    <header class="z-[150] fixed top-0 left-0 w-full transition-all duration-300 h-[70px]  undefined">
        <?php
        $default_log_id = get_theme_mod('custom_logo');
        $default_logo_img = wp_get_attachment_image_url($default_log_id, 'full');
        $activeLogo = get_theme_mod('active_logo');
        ?>
        <div class="container h-full">
            <div class="header-wrapper flex items-center justify-between gap-3 h-full">
                <div class="col-left w-full h-full">
                    <div class="logo h-full flex items-center xl:py-0 py-2">
                        <?php
                        if (function_exists('the_custom_logo')) {
                            the_custom_logo();
                        }; ?>
                    </div>
                </div>
                <div class="col-right py-9px flex flex-col items-end">
                    <div class="top flex items-center gap-3 xl:gap-6">
                        <div class="search-wrapper">
                            <div class="search-overlay" id="search-overlay">
                                <form class="searchbox flex" id="searchForm" action="<?php bloginfo('url') ?>/"
                                    method="GET" role="form">
                                    <input placeholder="<?php _e('Tìm kiếm', 'canhcamtheme'); ?>" type="text"
                                        name="s" />
                                    <button><i
                                            class="fa-light fa-magnifying-glass text-16px text-primary-5"></i></button>
                                </form>
                            </div>
                            <div class="mobile-show">
                                <div class="search-icon"><a href="javascript:;">
                                        <i class="fa-light fa-magnifying-glass"></i></a></div>
                            </div>
                        </div>
                        <div id="autoClone-HeaderLanguage">
                            <div class="language relative">
                                <?php do_action('wpml_add_language_selector'); ?>
                            </div>
                        </div>
                        <div class="desktop-show">
                            <div id="autoClone-HeaderHotline" class="flex items-center gap-1">
                                <?php if ($header['hot_line']) : ?>
                                <a class="hotline flex items-center gap-2"
                                    href="tel:<?= preg_replace('/[^0-9]/', '', strip_tags($header['hot_line'])) ?>">
                                    <i
                                        class="fa-light fa-phone-volume text-16px -rotate-45"></i>Hotline:<strong><?= strip_tags($header['hot_line']) ?></strong>
                                </a>
                                <?php endif; ?>
                                <?php if ($header['download_url']) : ?>
                                <a class="download flex items-center gap-2 rounded-tl-6 rounded-br-6 bg-primary-1 text-white text-16px leading-1.25 py-3 xl:py-6px px-6 text-center justify-center"
                                    href="<?= $header['download_url'] ?>" target="_blank">
                                    <i class="fa-solid fa-download"></i>
                                </a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="mobile-show">
                            <div class="relative" id="burger"><svg viewBox="0 0 32 32">
                                    <path class="line line-top-bottom"
                                        d="M27 10 13 10C10.8 10 9 8.2 9 6 9 3.5 10.8 2 13 2 15.2 2 17 3.8 17 6L17 26C17 28.2 18.8 30 21 30 23.2 30 25 28.2 25 26 25 23.8 23.2 22 21 22L7 22">
                                    </path>
                                    <path class="line" d="M7 16 27 16"></path>
                                </svg></div>
                        </div>
                    </div>
                    <div class="bottom mt-10px xl:block hidden">
                        <div id="autoClone-NavMenu">
                            <?php wp_nav_menu([
                                'theme_location' => 'main-menu',
                                'container' => 'nav',
                                'container_class' => 'nav',
                                'walker' => new Custom_Walker_Nav_Menu()
                            ]); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="nav-mobile max-w-clamp-375px z-3 bg-white fixed w-full right-0 overflow-hidden">
            <div class="wrapper h-full flex flex-col px-3 pt-4">
                <div id="autoCloneHere-HeaderHotline"></div>
                <div class="nav-on-mobile flex-1 h-full overflow-auto flex flex-col">
                    <div id="autoCloneHere-NavMenu"></div>
                </div>
            </div>
        </div>
    </header>
    <main>