<?php
global $post;
$fields = get_field('group_4', $post);
?>
<section class="introduce-4 intro_page section xl:pt-20 pb-0" id="section-4">
    <div class="container">
        <div data-aos="fade-up">
            <h2 class="block-title text-center"><?= $fields['title'] ?></h2>
            <div class="sub-title subheader-24 font-bold text-black mt-3 text-center"><?= $fields['description'] ?>
            </div>
            <?php $repeater = $fields['repeater']; ?>
            <?php if ($repeater) : ?>
            <?php
                $item_count = count($repeater);
                // Determine grid columns based on item count
                if ($item_count <= 2) {
                    $grid_class = 'grid-cols-1 sm:grid-cols-2';
                } elseif ($item_count == 3) {
                    $grid_class = 'grid-cols-1 sm:grid-cols-3';
                } elseif ($item_count == 4) {
                    $grid_class = 'grid-cols-2 lg:grid-cols-4';
                } elseif ($item_count == 5) {
                    $grid_class = 'grid-cols-2 sm:grid-cols-3 lg:grid-cols-5';
                } elseif ($item_count == 6) {
                    $grid_class = 'grid-cols-2 sm:grid-cols-3 ';
                } else {
                    $grid_class = 'grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 ';
                }
                ?>
            <div class="grid <?= $grid_class ?> gap-x-3 xl:gap-x-10 mt-3 gap-y-4">
                <?php foreach ($repeater as $value) : ?>
                <div class="item flex flex-col items-center">
                    <div class="title text-18px font-normal">
                        <?= $value['title'] ?></div>
                    <div class="value flex items-baseline gap-3 mt-3">
                        <div class="number counter block-title font-black text-primary-800"
                            data-count="<?= $value['number'] ?>">0</div>
                        <div class="unit subheader-20 font-bold text-primary-800"><?= $value['unit'] ?></div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
    <?php if ($fields['background']) : ?>
    <div class="image mt-8">
        <div data-aos="zoom-in-down" data-aos-delay=300 data-aos-easing="ease-in-sine">
            <a href="javascript:;" rel="nofollow">
                <?= custom_lozad_image($fields['background']) ?>
            </a>
        </div>
    </div>
    <?php endif; ?>
</section>