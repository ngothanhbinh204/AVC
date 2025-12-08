</main>

<?php $footer = get_field('footer_options', 'options'); ?>
<footer class="pt-12 pb-5" setbackground="<?php bloginfo("template_directory"); ?>/img/footer/bg.webp">
    <div class="container">
        <div class="wrapper relative">
            <?php if ($footer['columns']) : ?>
            <?php foreach ($footer['columns'] as $column) : ?>
            <div class="footer-column">
                <?php if ($column['title']) : ?>
                <div class="title subheader-24 font-bold text-white"><?= $column['title'] ?></div>
                <?php endif; ?>
                <?php if ($column['description']) : ?>
                <div class="desc text-18px font-normal">
                    <?= $column['description'] ?>
                </div>
                <?php endif; ?>
                <?php if ($column['socials']) : ?>
                <div class="footer-social">
                    <ul>
                        <?php foreach ($column['socials'] as $social) : ?>
                        <li>
                            <a href="<?= $social['url'] ?>" target="_blank">
                                <?= $social['icon'] ?>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>
                <?php if ($column['contacts']) : ?>
                <div class="footer-contact">
                    <ul>
                        <?php foreach ($column['contacts'] as $contact) : ?>
                        <li>
                            <a href="<?= $contact['url'] ?? 'javascript:;' ?>">
                                <div class="icon"><?= $contact['icon'] ?></div>
                                <span><?= $contact['text'] ?></span>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>
                <?php if ($column['menu']) : ?>
                <ul class="footer-menu">
                    <?php foreach ($column['menu'] as $menu_item) : ?>
                    <li>
                        <a href="<?= $menu_item['url'] ?? 'javascript:;' ?>"><?= $menu_item['title'] ?></a>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
                <?php if ($column['download_file']) : ?>
                <div class="dowload-file">
                    <a href="<?= $column['download_file']['url'] ?>" target="_blank">
                        <div class="icon"><i class="fa-regular fa-file-pdf"></i></div>
                        <span><?php _e('Tải hồ sơ năng lực (PDF)', 'canhcamtheme') ?></span>
                    </a>
                </div>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
            <?php else : ?>
            <!-- Fallback to old structure -->
            <div class="title subheader-24 font-bold text-white"><?= $footer['title'] ?></div>
            <div class="description text-18px text-white mt-3"><?= $footer['description'] ?></div>
            <?php endif; ?>
        </div>
        <div class="footer-bottom flex items-center justify-between mt-10">
            <div class="footer-copyright text-14px">
                <?= $footer['copyright'] ?>
            </div>
            <?php if ($footer['policy_links']) : ?>
            <div class="footer-policy">
                <ul>
                    <?php foreach ($footer['policy_links'] as $link) : ?>
                    <li>
                        <a href="<?= $link['url'] ?? 'javascript:;' ?>"><?= $link['title'] ?></a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>
        </div>
    </div>
</footer>

<div id="overlay"></div>
<div class="select-none" id="fixed-tool">
    <?php $tools = get_field('sticky_tool', 'options')['repeater']; ?>
    <?php if ($tools) : ?>
    <?php foreach ($tools as $value) : ?>
    <a class="item block border border-white rounded-4px xl:rounded-3 bg-primary-800 px-2 py-6px transition-all duration-300"
        href='<?= $value['url'] ?? 'javascript:;' ?>'>
        <div class="flex items-center">
            <div class="icon text-center">
                <?php if ($value['image']) : ?>
                <?= custom_lozad_image($value['image']) ?>
                <?php else : ?>
                <?= $value['icon'] ?>
                <?php endif; ?>
            </div>
            <div class="ctn ml-1 xl:ml-2 pl-1 xl:pl-2 border-l border-white text-14px font-bold text-white">
                <?= $value['label'] ?></div>
        </div>
    </a>
    <?php endforeach; ?>
    <?php endif; ?>
    <div class="mobile-show">
        <div
            class="item scrollToTop cursor-pointer border border-white rounded-4px xl:rounded-3 bg-primary-800 px-2 py-6px transition-all duration-300">
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
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-T4J8Z6V7" height="0" width="0"
        style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
</body>


</html>