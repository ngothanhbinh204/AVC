<?php
/*
Template name: Template - Tuyển dụng
*/
?>

<?php get_header(); ?>

<?php
global $post;

// Section 1: Banner
$group_1 = get_field('group_1', $post->ID);
$banner_bg = $group_1['background'] ?? '';
$banner_title = $group_1['title'] ?? '';
$banner_desc = $group_1['description'] ?? '';
$banner_bg_url = $banner_bg ? get_image_attrachment($banner_bg, 'url') : '';
?>

<?php get_template_part('./modules/breadcrumb/breadcrumb'); ?>

<section class="recruitment-1 rem:min-h-[680px] flex flex-col justify-center"
    <?php if ($banner_bg_url): ?>setBackground="<?= esc_url($banner_bg_url) ?>" <?php endif; ?>>
    <div class="container">
        <div class="content rem:max-w-[600px] w-full flex flex-col gap-6">
            <?php if ($banner_title): ?>
            <h2 class="header-48"><?= esc_html($banner_title) ?></h2>
            <?php endif; ?>
            <?php if ($banner_desc): ?>
            <div class="format-content">
                <?= wp_kses_post($banner_desc) ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php
// Section 2: Môi trường làm việc
$group_2 = get_field('group_2', $post->ID);
$env_title = $group_2['title'] ?? '';
$env_items = $group_2['items'] ?? [];
?>
<?php if (!empty($env_items)): ?>
<section class="recruitment-2 section xl:py-20">
    <div class="container">
        <?php if ($env_title): ?>
        <div class="h2 text-center header-48 mb-10"><?= esc_html($env_title) ?></div>
        <?php endif; ?>
        <div class="wrapper grid lg:grid-cols-4 grid-cols-2 gap-10">
            <?php foreach ($env_items as $item):
                    $icon = $item['icon'] ?? '';
                    $title = $item['title'] ?? '';
                    $desc = $item['description'] ?? '';
                    $icon_url = $icon ? get_image_attrachment($icon, 'url') : '';
                    ?>
            <div class="item py-10 px-5 border border-Neutral-200 flex flex-col items-center justify-center">
                <?php if ($icon_url): ?>
                <div class="icon rem:w-[70px]">
                    <span class="img-ratio">
                        <?= get_image_attrachment($icon, 'image') ?>
                    </span>
                </div>
                <?php endif; ?>
                <div class="content text-center mt-3">
                    <?php if ($title): ?>
                    <div class="top">
                        <div class="title text-xl font-bold text-Primary-New-1 mb-3"><?= esc_html($title) ?></div>
                    </div>
                    <?php endif; ?>
                    <?php if ($desc): ?>
                    <div class="bottom">
                        <div class="desc"><?= esc_html($desc) ?></div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php
// Section 3: Job Listings
$group_3 = get_field('group_3', $post->ID);
$job_title = $group_3['title'] ?? __('THAM GIA ĐỘI NGŨ CỦA CHÚNG TÔI', 'canhcamtheme');
$job_button_text = $group_3['button_text'] ?? __('XEM THÊM', 'canhcamtheme');
$posts_per_page = $group_3['posts_per_page'] ?? 6;
$initial_posts = 1; // Initial posts to show
$load_more_posts = 3; // Fixed posts to load more each time

// Query recruitment posts - initial load
$args = array(
    'post_type' => 'recruitment',
    'posts_per_page' => $initial_posts,
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC'
);
$recruitment_query = new WP_Query($args);
?>
<section class="recruitment-3 section xl:py-20">
    <div class="container">
        <?php if ($job_title): ?>
        <h2 class="header-48 mb-10 font-extrabold text-center"><?= esc_html($job_title) ?></h2>
        <?php endif; ?>
        <div class="career-table table-responsive">
            <table>
                <thead>
                    <tr>
                        <td class="text-center rem:w-[80px]"><?= __('STT', 'canhcamtheme') ?></td>
                        <td class="lg:rem:w-[595px] w-auto"><?= __('Vị trí tuyển dụng', 'canhcamtheme') ?></td>
                        <td class="text-center"><?= __('Khu vực', 'canhcamtheme') ?></td>
                        <td class="text-center"><?= __('Hạn nộp', 'canhcamtheme') ?></td>
                        <td class="text-center"></td>
                    </tr>
                </thead>
                <tbody id="recruitment-posts">
                    <?php if ($recruitment_query->have_posts()):
                        $count = 1;
                        while ($recruitment_query->have_posts()): $recruitment_query->the_post();
                            $recruitment_id = get_the_ID();
                            $area = get_field('area', $recruitment_id) ?: '';
                            $deadline = get_field('deadline', $recruitment_id) ?: '';
                            ?>
                    <tr>
                        <td class="text-center p-3"><?= str_pad($count, 2, '0', STR_PAD_LEFT) ?></td>
                        <td>
                            <a class="recruitment-link" href="<?= get_permalink() ?>"><?= get_the_title() ?></a>
                        </td>
                        <td class="text-center"><?= esc_html($area) ?></td>
                        <td class="text-center"><?= esc_html($deadline) ?></td>
                        <td class="text-center text-Primary-New-1">
                            <div class="dowload flex items-center gap-3 justify-center">
                                <a class="font-medium"
                                    href="<?= get_permalink() ?>"><?= __('Xem thêm', 'canhcamtheme') ?></a>
                                <i class="fa-solid fa-arrow-right"></i>
                            </div>
                        </td>
                    </tr>
                    <?php
                            $count++;
                        endwhile;
                        wp_reset_postdata();
                    else: ?>
                    <tr>
                        <td colspan="5" class="text-center p-5">
                            <?= __('Hiện chưa có vị trí tuyển dụng nào.', 'canhcamtheme') ?></td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php if ($recruitment_query->found_posts > $initial_posts): ?>
        <div class="more flex items-center justify-center mt-10 relative z-50">
            <button class="btn-primary load-more-btn btn-primary" data-offset="<?= $initial_posts ?>"
                data-posts-per-page="<?= $load_more_posts ?>" data-total-posts="<?= $recruitment_query->found_posts ?>">
                <a class="btn-primary" id="load-more-text"><?= __('TẢI THÊM', 'canhcamtheme') ?></a>
            </button>
        </div>
        <?php elseif ($recruitment_query->found_posts > 0): ?>
        <div class="more flex items-center justify-center mt-10 relative z-50">
            <a class="btn-primary" href="#"><span><?= esc_html($job_button_text) ?></span></a>
        </div>
        <?php endif; ?>
    </div>
</section>

<script>
jQuery(document).ready(function($) {
    $('.load-more-btn').on('click', function(e) {
        e.preventDefault();

        var button = $(this);
        var offset = parseInt(button.data('offset'));
        var postsPerPage = parseInt(button.data('posts-per-page'));
        var totalPosts = parseInt(button.data('total-posts'));
        var tbody = $('#recruitment-posts');

        // Show loading state
        button.prop('disabled', true);
        $('#load-more-text').text('<?= __('ĐANG TẢI...', 'canhcamtheme') ?>');

        $.ajax({
            url: '<?= admin_url('admin-ajax.php') ?>',
            type: 'POST',
            data: {
                action: 'load_more_recruitment',
                offset: offset,
                posts_per_page: postsPerPage
            },
            success: function(response) {
                if (response.success) {
                    tbody.append(response.data.html);

                    // Update offset
                    var newOffset = offset + postsPerPage;
                    button.data('offset', newOffset);

                    // Check if there are more posts
                    if (newOffset >= totalPosts) {
                        button.hide();
                    } else {
                        $('#load-more-text').text('<?= __('TẢI THÊM', 'canhcamtheme') ?>');
                        button.prop('disabled', false);
                    }
                } else {
                    console.error('AJAX Error:', response);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
                $('#load-more-text').text('<?= __('LỖI. THỬ LẠI', 'canhcamtheme') ?>');
                button.prop('disabled', false);
            }
        });
    });
});
</script>

<?php get_footer(); ?>