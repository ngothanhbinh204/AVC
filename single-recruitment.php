<?php
/**
 * Single template for Recruitment post type
 */
get_header();
?>

<?php
global $post;

// Get ACF fields
$overview_items = get_field('overview_items', $post->ID) ?: [];
$job_description = get_field('job_description', $post->ID) ?: '';
$requirements = get_field('requirements', $post->ID) ?: '';
$benefits = get_field('benefits', $post->ID) ?: '';
$apply_file = get_field('apply_file', $post->ID) ?: '';
$shortcodeRecruitment = get_field('shortcode_recruitment', 'option') ?: '';

// Get thumbnail
$thumbnail_id = get_post_thumbnail_id($post->ID);
?>

<section class="recruitment-detail section xl:py-20">
    <div class="container">
        <h2 class="text-40px text-primary-500 font-extrabold mb-6"><?= get_the_title() ?></h2>
        <div class="wrapper grid md:grid-cols-2 gap-10">
            <?php if ($thumbnail_id): ?>
            <div class="img">
                <span class="img-ratio ratio:pt-[509_680]">
                    <?= get_image_attrachment($thumbnail_id, 'image') ?>
                </span>
            </div>
            <?php endif; ?>
            <div class="content">
                <div class="title rem:text-[24px] text-primary-500 font-bold border-b border-b-Utility-100 pb-6">
                    <?= __( 'Overview', 'canhcamtheme' ) ?>
                </div>
                <div class="recruitment-detail-tab-left flex flex-col max-lg:w-full">
                    <?php if (!empty($overview_items)):
                        foreach ($overview_items as $item):
                            $label = $item['label'] ?? '';
                            $value = $item['value'] ?? '';
                            ?>
                    <div class="recruitment-detail-tab-item">
                        <div class="recruitment-location"><?= esc_html($label) ?></div>
                        <div class="recruitment-location-position"><?= esc_html($value) ?></div>
                    </div>
                    <?php endforeach;
                    endif; ?>
                </div>
            </div>
        </div>

        <div class="recruitment-detail-main flex gap-10 max-lg:flex-col mt-10">
            <div class="col-left lg:w-9/12 w-full flex flex-col gap-10">
                <?php if ($job_description): ?>
                <div class="content xl:p-10 p-5 bg-neutral-50">
                    <h3 class="text-lg text-primary-500 font-bold">
                        <?= __( 'Mô tả công việc', 'canhcamtheme' ) ?>
                    </h3>
                    <div class="format-content mt-5 text-lg font-medium flex flex-col gap-3">
                        <?= wp_kses_post($job_description) ?>
                    </div>
                </div>
                <?php endif; ?>

                <?php if ($requirements): ?>
                <div class="content xl:p-10 p-5 bg-neutral-50">
                    <h3 class="text-lg text-primary-500 font-bold">
                        <?= __( 'Yêu cầu công việc', 'canhcamtheme' ) ?>
                    </h3>
                    <div class="format-content mt-5 text-lg font-medium flex flex-col gap-3">
                        <?= wp_kses_post($requirements) ?>
                    </div>
                </div>
                <?php endif; ?>

                <?php if ($benefits): ?>
                <div class="content xl:p-10 p-5 bg-neutral-50">
                    <h3 class="text-lg text-primary-500 font-bold">
                        <?= __( 'Quyền lợi được hưởng', 'canhcamtheme' ) ?>
                    </h3>
                    <div class="format-content mt-5 text-lg font-medium flex flex-col gap-3">
                        <?= wp_kses_post($benefits) ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <div class="col-right lg:w-3/12 w-full">
                <div class="button flex flex-col gap-3 xl:rem:p-[34px] p-5 bg-neutral-50">
                    <a class="btn btn-primary" href="#form-requirement" data-fancybox>
                        <span><?= __( 'Apply', 'canhcamtheme' ) ?></span>
                        <div class="icon"><i class="fa-solid fa-arrow-right"></i></div>
                    </a>
                    <?php if ($apply_file): ?>
                    <a class="btn btn-primary" href="<?= esc_url($apply_file['url']) ?>" target="_blank" download>
                        <span><?= __( 'TẢI HỒ SƠ ỨNG TUYỂN', 'canhcamtheme' ) ?></span>
                        <div class="icon"><i class="fa-regular fa-file-arrow-down"></i></div>
                    </a>
                    <?php endif; ?>
                </div>

                <?php
                // Query other recruitment posts
                $other_args = array(
                    'post_type' => 'recruitment',
                    'posts_per_page' => 4,
                    'post_status' => 'publish',
                    'post__not_in' => array($post->ID),
                    'orderby' => 'date',
                    'order' => 'DESC'
                );
                $other_query = new WP_Query($other_args);

                if ($other_query->have_posts()): ?>
                <div class="box-info mt-10 max-lg:border max-lg:border-neutral-300 border border-Neutral-100">
                    <h2
                        class="box-info-heading lg:px-3 lg:py-4 p-3 bg-primary-500 text-white font-bold rem:text-[24px]">
                        <?= __( 'Other positions', 'canhcamtheme' ) ?></h2>
                    <?php while ($other_query->have_posts()): $other_query->the_post();
                            $other_deadline = get_field('deadline', get_the_ID()) ?: '';
                            ?>
                    <div class="box-info-item">
                        <h3><a href="<?= get_permalink() ?>"><?= get_the_title() ?></a></h3>
                        <div class="box-info-date">
                            <i class="fa-regular fa-calendar-star"></i>
                            <span class="title"><?= __( 'Hạn nộp hồ sơ', 'canhcamtheme' ) ?></span>
                        </div>
                        <div class="date body-2 font-medium">
                            <span class="date"><?= esc_html($other_deadline) ?></span>
                        </div>
                    </div>
                    <?php endwhile;
                        wp_reset_postdata(); ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<div id="form-requirement" style="display: none;" data-fancybox-modal>
    <div class="popup-content w-full relative z-50">
        <h3 class="title-job text-5xl text-Neutral-Black font-light mb-10"><?= get_the_title() ?></h3>
        <?php 
        if ($shortcodeRecruitment) {
            echo do_shortcode($shortcodeRecruitment);
        }
         ?>
    </div>
</div>

<?php get_footer(); ?>