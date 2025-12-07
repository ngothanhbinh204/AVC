<?php
global $post;
$fields = get_field('group_2', $post);
?>
<section class="home-2 section pb-0 relative z-2 pt-4 lg:pt-12">
    <div class="container relative z-2">
        <div data-aos="fade-up">
            <h2 class="big-title text-45px md:text-60px xl:text-96px font-black leading-normal text-center text-image">
                <?= $fields['title'] ?>
            </h2>
        </div>
        <div data-aos="fade-up" data-aos-delay="300">
            <h3 class="description subheader-24 font-bold text-neutral-900 text-center mt-4 xl:mt-10"><?= $fields['sub_title'] ?></h3>
        </div>
        <div data-aos="fade-up" data-aos-delay="500">
            <h4 class="content text-18px text-neutral-900 text-center mt-3"><?= $fields['description'] ?>
        </div>
    </div>
    <?php if ($fields['url']['url']) : ?>
        <div data-aos="fade-up" data-aos-delay="700">
            <?= get_template_part('/components/UI/button', null, array(
                'text' => __('Tìm hiểu thêm', 'canhcamtheme'),
                'className' => 'btn-primary mx-auto xl:mt-10 mt-8',
                'href' => $fields['url']['url']
            )) ?>
        </div>
    <?php endif; ?>
    </div>
    <?php if ($fields['background']) : ?>
        <div class="background" style="position:relative; z-index:-1">
            <a href="javascript:;" rel="nofollow">
                <?= custom_lozad_image($fields['background']) ?>
            </a>
        </div>
    <?php endif; ?>
</section>