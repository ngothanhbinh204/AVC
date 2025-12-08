<?php
// File: components/home/home-8.php
// Section: Đối tác - Khách hàng
global $post;

$fields = get_field('group_8', $post->ID);
$title = $fields['title'] ?? '';
$partners = $fields['partners'] ?? [];
?>
<?php if ($partners) : ?>
    <section class="home-8 xl:pt-20 pt-10 pb-0" data-aos="fade-up" data-aos-delay="600">
        <div class="container">
            <?php if ($title) : ?>
                <h2 class="header-48 text-center mb-6"><?= $title ?></h2>
            <?php endif; ?>
        </div>
        <div class="wrap-coop-slide">
            <div class="swiper">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <?php foreach ($partners as $partner) : ?>
                            <?php
                            $partner_logo = $partner['partner_logo'] ?? '';
                            $partner_link = $partner['partner_link'] ?? 'javascript:;';
                            ?>
                            <div class="swiper-slide">
                                <a class="item-logo" href="<?= $partner_link ?>" <?= ($partner_link && $partner_link !== 'javascript:;') ? 'target="_blank"' : '' ?>>
                                    <?php if ($partner_logo) : ?>
                                        <?= get_image_attrachment($partner_logo, 'image') ?>
                                    <?php endif; ?>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
