</main>

<?php $footer = get_field('footer_options', 'options'); 
$col1 = $footer['column_1'] ?? [];
$col2 = $footer['column_2'] ?? [];
$col3 = $footer['column_3'] ?? [];
?>
<footer class="pt-12 pb-5" setbackground="<?php bloginfo("template_directory"); ?>/img/footer/bg.webp">
    <div class="container">
        <div class="wrapper relative">
            <!-- Cột 1: Thông tin công ty -->
            <div class="footer-column">
                <?php if (!empty($col1['title'])) : ?>
                <div class="title subheader-24 font-bold text-white"><?= $col1['title'] ?></div>
                <?php endif; ?>
                <?php if (!empty($col1['description'])) : ?>
                <div class="desc text-18px font-normal">
                    <?= $col1['description'] ?>
                </div>
                <?php endif; ?>
                <?php if (!empty($col1['socials'])) : ?>
                <div class="footer-social">
                    <ul>
                        <?php foreach ($col1['socials'] as $social) : ?>
                        <li>
                            <a href="<?= $social['link']['url'] ?? 'javascript:;' ?>" target="_blank">
                                <?= $social['icon'] ?>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>
            </div>

            <!-- Cột 2: Liên hệ -->
            <div class="footer-column">
                <?php if (!empty($col2['title'])) : ?>
                <div class="title subheader-24 font-bold text-white"><?= $col2['title'] ?></div>
                <?php endif; ?>
                <?php if (!empty($col2['contacts'])) : ?>
                <div class="footer-contact">
                    <ul>
                        <?php foreach ($col2['contacts'] as $contact) : ?>
                        <li>
                            <a href="<?= $contact['link']['url'] ?? 'javascript:;' ?>">
                                <div class="icon"><?= $contact['icon'] ?></div>
                                <span><?= $contact['text'] ?></span>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>
            </div>

            <!-- Cột 3: Liên kết nhanh -->
            <div class="footer-column">
                <?php if (!empty($col3['title'])) : ?>
                <div class="title subheader-24 font-bold text-white"><?= $col3['title'] ?></div>
                <?php endif; ?>
                <?php if (!empty($col3['menu'])) : ?>
                <ul class="footer-menu">
                    <?php foreach ($col3['menu'] as $menu_item) : ?>
                    <li>
                        <a href="<?= $menu_item['link']['url'] ?? 'javascript:;' ?>"><?= $menu_item['title'] ?></a>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
                <?php if (!empty($col3['download_file'])) : ?>
                <div class="dowload-file">
                    <a href="<?= $col3['download_file']['url'] ?>" target="_blank">
                        <div class="icon"><i class="fa-regular fa-file-pdf"></i></div>
                        <span><?= $col3['download_text'] ?? __('Tải hồ sơ năng lực (PDF)', 'canhcamtheme') ?></span>
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="footer-bottom flex items-center justify-between mt-10">
            <div class="footer-copyright text-14px">
                <?= $footer['copyright'] ?? '' ?>
            </div>
            <?php if (!empty($footer['policy_links'])) : ?>
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