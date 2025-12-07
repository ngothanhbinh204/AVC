</main>

<?php $footer = get_field('footer_options', 'options'); ?>
<footer class="pt-12" setbackground="<?php bloginfo("template_directory"); ?>/img/footer/bg.webp">
    <div class="container">
        <div class="wrapper relative">
            <div class="title subheader-24 font-bold text-white"><?= $footer['title'] ?></div>
            <div class="description text-18px text-white mt-3"><?= $footer['description'] ?></div>
            <div class="flex flex-wrap items-center justify-between gap-3 mt-15px pb-5 border-b-8 border-b-primary-500">
                <div class="col-left">
                    <div class="text-18px text-white">
                        <?= $footer['copyright'] ?>
                    </div>
                </div>
                <?php $socials = $footer['socials']; ?>
                <div class="col-right">
                    <?php if ($socials) : ?>
                        <div class="socials flex items-center gap-3">
                            <?php foreach ($socials as $value) : ?>
                                <a class="w-50px h-50px rounded-full bg-primary-500 flex items-center justify-center" href="<?= $value['url'] ?>" target="_blank"><?= $value['icon'] ?></a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="desktop-show">
                <div class="scrollToTop w-20 h-20 bg-primary-500 rounded-tl-6 rounded-br-6 absolute right-0 top-0 xl:-top-12 flex items-center justify-center cursor-pointer">
                    <i class="fa-light fa-arrow-up text-32px text-white leading-normal"></i>
                </div>
            </div>
        </div>
    </div>
</footer>

<div id="overlay"></div>
<div class="select-none" id="fixed-tool">
    <?php $tools = get_field('sticky_tool', 'options')['repeater']; ?>
    <?php if ($tools) : ?>
        <?php foreach ($tools as $value) : ?>
            <a class="item block border border-white rounded-4px xl:rounded-3 bg-primary-800 px-2 py-6px transition-all duration-300" href='<?= $value['url'] ?? 'javascript:;' ?>'>
                <div class="flex items-center">
                    <div class="icon text-center">
                        <?php if ($value['image']) : ?>
                            <?= custom_lozad_image($value['image']) ?>
                        <?php else : ?>
                            <?= $value['icon'] ?>
                        <?php endif; ?>
                    </div>
                    <div class="ctn ml-1 xl:ml-2 pl-1 xl:pl-2 border-l border-white text-14px font-bold text-white"><?= $value['label'] ?></div>
                </div>
            </a>
        <?php endforeach; ?>
    <?php endif; ?>
    <div class="mobile-show">
        <div class="item scrollToTop cursor-pointer border border-white rounded-4px xl:rounded-3 bg-primary-800 px-2 py-6px transition-all duration-300">
            <div class="flex items-center">
                <div class="icon text-center">
                    <i class="fa-light fa-arrow-up"></i>
                </div>
                <div class="ctn ml-1 xl:ml-2 pl-1 xl:pl-2 border-l border-white text-14px font-bold text-white">
                    <?php _e('Back to top', 'canhcamtheme'); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php wp_footer(); ?>
<?= get_field('custom_code', "options")['footer']; ?>
<?php do_action('wp_adding_script') ?>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-T4J8Z6V7"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
</body>


</html>