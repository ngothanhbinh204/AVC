<?php
// File: components/home/home-3.php
// Section: Tabs Sản phẩm
global $post;

$fields = get_field('group_3', $post->ID);
$tabs = $fields['tabs'] ?? [];
?>
<?php if ($tabs) : ?>
<section class="home-3 pb-0 xl:py-20 lg:pt-35px py-10 bg-neutral-50" data-aos="fade-up" data-aos-delay="100">
    <div class="container">
        <div class="wrap-main" data-toggle="tabslet">
            <?php foreach ($tabs as $index => $tab) : ?>
            <?php
                    $tab_id = 'tab' . ($index + 1);
                    $is_active = $index === 0 ? 'active' : '';
                    $tab_title = $tab['tab_title'] ?? '';
                    $tab_description = $tab['tab_description'] ?? '';
                    $tab_button = $tab['tab_button'] ?? '';
                    ?>
            <div class="tabslet-content <?= $is_active ?>" id="<?= $tab_id ?>">
                <div class="wrapper grid xl:grid-cols-[35.2857%_1fr] grid-cols-1 xl:rem:gap-[226px] gap-5">
                    <div class="col-left">
                        <?php if ($tab_title) : ?>
                        <h2 class="md:text-80px text-32px font-bold text-black"><?= $tab_title ?></h2>
                        <?php endif; ?>
                    </div>
                    <div class="col-right">
                        <?php if ($tab_description) : ?>
                        <div class="desc text-18px text-neutral-900 font-normal mb-6">
                            <?= $tab_description ?>
                        </div>
                        <?php endif; ?>
                        <?php if ($tab_button && $tab_button['url']) : ?>
                        <div class="button">
                            <a class="btn btn-primary" href="<?= $tab_button['url'] ?>">
                                <span><?= $tab_button['title'] ?: __('XEM THÊM', 'canhcamtheme') ?></span>
                            </a>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>

            <div class="wrapper-list xl:rem:mt-[140px] mt-10">
                <ul class="tabslet-tab grid md:grid-cols-3 grid-cols-1 lg:gap-10 gap-4">
                    <?php foreach ($tabs as $index => $tab) : ?>
                    <?php
                            $tab_id = 'tab' . ($index + 1);
                            $is_active = $index === 0 ? 'active' : '';
                            $tab_title = $tab['tab_title'] ?? '';
                            $tab_image = $tab['tab_image'] ?? '';
                            ?>
                    <li class="<?= $is_active ?>">
                        <div class="item">
                            <?php if ($tab_image) : ?>
                            <div class="img img-ratio ratio:pt-[293_440]">
                                <?= get_image_attrachment($tab_image, 'image') ?>
                            </div>
                            <?php endif; ?>
                            <div class="content mt-6">
                                <?php if ($tab_title) : ?>
                                <h3><?= $tab_title ?></h3>
                                <?php endif; ?>
                            </div>
                        </div>
                        <a class="stretched-link" href="#<?= $tab_id ?>"></a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>