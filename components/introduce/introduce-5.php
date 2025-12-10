<?php
global $post;
// $fields = get_field('group_5', $post);
$description  = get_field('description_partner', $post) ?? '';
?>



<?php
$idHomePage = get_option('page_on_front');
$fields = get_field('group_8', $idHomePage);
$title = $fields['title'] ?? '';
$partners = $fields['partners'] ?? [];
?>
<?php if ($partners) : ?>
<section class="home-8 xl:pt-20 pt-10 pb-0 introduce-5 section pt-0 xl:pb-20" data-aos="fade-up" data-aos-delay="600">
    <div class="container mb-6">
        <div class="wrapper max-w-clamp-1230px mx-auto space-y-6 px-3 xl:p-0">
            <?php if ($title) : ?>
            <h2 class="header-48 text-center"><?= $title ?></h2>
            <?php endif; ?>

        </div>
    </div>
    <div class="wrap-coop-slide mb-6">
        <div class="swiper">
            <div class="swiper">
                <div class="swiper-wrapper">
                    <?php foreach ($partners as $partner) : ?>
                    <?php
                            $partner_logo = $partner['partner_logo'] ?? '';
                            $partner_link = $partner['partner_link'] ?? 'javascript:;';
                            ?>
                    <div class="swiper-slide">
                        <a class="item-logo" href="<?= $partner_link ?>"
                            <?= ($partner_link && $partner_link !== 'javascript:;') ? 'target="_blank"' : '' ?>>
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
    <div class="container ">
        <div class="wrapper max-w-clamp-1230px mx-auto space-y-6 px-3 xl:p-0">
            <div class="description space-y-3 text-18px font-normal text-neutral-900">
                <?= $description ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>