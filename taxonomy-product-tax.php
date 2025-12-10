<?php get_header(); ?>


<?php
get_template_part('./modules/banner/page-banner');
?>


<?php
$queried = get_queried_object();
$taxonomy = isset($queried->taxonomy) ? $queried->taxonomy : '';
$taxonomyID = isset($queried->term_taxonomy_id) ? $queried->term_taxonomy_id : 0;
$post_type = $taxonomy ? get_taxonomy($taxonomy)->object_type[0] : 'post';
$postTemplate = '/components/boxProduct/boxProduct-1';


if (is_tax() && isset($queried->term_id)) {
    if (empty($queried->parent)) {
        // on parent term page
        $parent_term = $queried;
        $children = get_terms(array(
            'taxonomy' => $taxonomy,
            'hide_empty' => false,
            'parent' => $queried->term_id,
        ));
    } else {
        // on a child term page - only show this term
        $parent_term = get_term($queried->parent, $taxonomy);
        $children = array($queried);
    }
} 
?>


<section class="product-list section xl:pt-20 pb-0">
    <?php if ($children) : ?>
    <div class="container">
        <div class="spy-nav-menu normal-nav sticky-nav">
            <nav class="justify-center flex items-center">
                <ul>
                    <?php foreach ($children as $key => $value) : ?>
                    <li>
                        <a href="#section-<?= $key + 1 ?>"><?= $value->name ?></a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </nav>
        </div>
    </div>
    <?php endif; ?>
    <div class="list">
        <?php foreach ($children as $key => $value) : ?>
        <?php
            $default_query =  array(
                'taxonomy' => $taxonomy,
                'field' => 'term_id',
                'terms' => array($value->term_id),
            );
            $args = array(
                'post_type' => $post_type,
                'posts_per_page' => -1,
                'paged' => 1,
                'tax_query' => array(
                    'relation' => 'AND',
                    $default_query,
                ),
            );
            $the_query = new WP_Query($args);
            ?>
        <?php if ($the_query->have_posts()) : ?>
        <div id="<?= sanitize_title($value->name) ?>">
            <section class="category-item section xl:py-20" id="section-<?= $key + 1 ?>">
                <div class="category-info">
                    <div class="container">
                        <?php
                                $acf_key = $taxonomy . '_' . $value->term_id;
                                // $image = get_field('image', $acf_key);
                                $gallery = get_field('gallery', $acf_key);
                                $url = get_field('url', $acf_key) ?? "javascript:;";
                                ?>
                        <div class="grid lg:grid-cols-2 gap-y-4 items-center">
                            <div class="col-left" data-aos='fade-left'>
                                <?php if ($gallery) : ?>
                                <div class="max-w-clamp-690px w-full">
                                    <div class="images relative h-0 overflow-hidden">
                                        <div class="image-wrapper absolute inset-0">
                                            <div class="image-container relative w-full h-full">
                                                <?php if ($gallery[0]) : ?>
                                                <div class="main-img absolute w-full top-0 left-0">
                                                    <a href="javascript:;" rel="nofollow">
                                                        <?= custom_lozad_image($gallery[0]) ?>
                                                    </a>
                                                </div>
                                                <?php endif; ?>
                                                <?php if (count($gallery) > 1) : ?>
                                                <div class="boards absolute w-full bottom-0 right-0">
                                                    <div class="wrapper relative h-0 overflow-hidden">
                                                        <div class="absolute swiper-column-auto allow-touchMove auto-play inset-0 swiper-loop"
                                                            data-time=2000>
                                                            <div class="swiper w-full h-full">
                                                                <div class="swiper-wrapper w-full h-full">
                                                                    <?php 
                                                                                $key_image = 0; 
                                                                                $gallery_swiper = array_slice($gallery, 1); // Cắt bỏ ảnh đầu tiên
                                                                                ?>
                                                                    <?php foreach ($gallery_swiper as $image) : ?>
                                                                    <?php if ($key_image < 3) : ?>
                                                                    <!-- Hiển thị tối đa 3 ảnh -->
                                                                    <div class="swiper-slide w-full h-full">
                                                                        <div class="img w-full h-full">
                                                                            <a href="javascript:;" rel="nofollow">
                                                                                <?= custom_lozad_image($image) ?>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                    <?php endif; ?>
                                                                    <?php $key_image++; ?>
                                                                    <?php endforeach; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php endif; ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                            <div class="col-right lg:pl-3" data-aos='fade-right'>
                                <div class="wrapper lg:max-w-clamp-640px lg:ml-auto">
                                    <h2 class="title block-title">
                                        <a href="<?= $url ?>">
                                            <?= $value->name ?>
                                        </a>
                                    </h2>
                                    <?= edit_link_term($value->term_id) ?>
                                    <div class="description mt-3 md:mt-8 text-18px text-neutral-900 space-y-6">
                                        <?= $value->description ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if ($the_query->have_posts()) : ?>
                <div class="child-category auto-scroll-nav border-y border-primary-500 my-8 lg:my-10"
                    id="child-category">
                    <div class="container">
                        <div data-aos="fade-up">
                            <nav class="flex items-center justify-center">
                                <ul class="flex items-center overflow-auto">
                                    <?php if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>
                                    <li>
                                        <a class="text-18px sm:subheader-24 font-bold text-neutral-900 transition-all relative flex items-center py-3 sm:py-5 whitespace-nowrap"
                                            href="javascript:;"><?= get_the_title(get_the_ID()) ?></a>
                                    </li>
                                    <?php endwhile;
                                                    endif;
                                                    wp_reset_postdata(); ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>

                <div class="category-item" id="list-post">
                    <div class="container">
                        <div class="relative">
                            <div class="loading-container">
                                <div class="loading-wrapper">
                                    <span></span>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-center">
                            <?php $key = 0; ?>
                            <?php if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>
                            <?php $key++; ?>
                            <?php $id = get_the_ID(); ?>
                            <div class="col-6 col-lg-4" data-aos="fade-left" data-aos-delay='<?= $key++ ?>00'>
                                <?= get_template_part($postTemplate, null, array(
                                                        'id' => $id,
                                                    )) ?>
                            </div>
                            <?php endwhile;
                                        endif;
                                        wp_reset_postdata(); ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </section>
        </div>
        <?php endif; ?>
        <?php endforeach; ?>
    </div>
</section>
<?php $videos = get_field('videos', $taxonomy . '_' . $taxonomyID); ?>
<?php if ($videos) : ?>
<section class="product-video section xl:py-20 bg-[#ECFDF7]">
    <div data-aos="zoom-in-up">
        <div class="container">
            <div class="relative swiper-column-auto allow-touchMove">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <?php foreach ($videos as $value) : ?>
                        <?php $video = $value['video']; ?>
                        <div class="swiper-slide relative <?php if ($video) : ?> has-youtube-video <?php endif; ?>"
                            <?php if ($video) : ?>data-embed="<?= $video ?>" <?php endif; ?>>
                            <?php if ($video) : ?>
                            <div class="video-toggle">
                                <div class="play-btn">
                                    <div
                                        class="icon image-svg image-absolute absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-2">
                                        <a href="javascript:;"> <img class="lozad"
                                                data-src="<?php bloginfo("template_directory"); ?>/img/icon/play.svg" /></a>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                            <div class="img"><a href="javascript:;"
                                    rel="nofollow"><?= custom_lozad_image($value['image']) ?></a>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="arrow-button">
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<?php $protocols = get_field('protocol', $taxonomy . '_' . $taxonomyID);
?>
<?php if ($protocols) : ?>
<section class="product-protocol section xl:py-20">
    <div class="container">
        <div data-aos="fade-up">
            <h3 class="block-title text-center">
                <?php _e('Quy trình sản suất', 'canhcamtheme'); ?>
            </h3>
        </div>
        <div data-aos="fade-up" data-aos-delay=300>
            <div class="auto-4-column relative swiper-column-auto allow-touchMove auto-play mt-6 xl:mt-10">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <?php foreach ($protocols as $value) : ?>
                        <div class="swiper-slide relative">
                            <div class="item py-4 lg:py-50px px-3 h-full flex items-center justify-center"
                                setbackground="<?php bloginfo("template_directory"); ?>/img/home/h-5-i-bg.webp">
                                <div class="title text-center subheader-24 font-bold text-[#BE9156] w-full">
                                    <?= $value['title'] ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="arrow-button">
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>



<?php get_footer(); ?>










<!-- <script>
    window.addEventListener('load', function() {
        let taxonomyID = "<?= $taxonomyID ?>";
        let url = new URL(window.location.href);
        const taxonomy = "<?= $taxonomy ?>";
        const post_type = "<?= $post_type ?>";
        const postTemplate = "<?= $postTemplate ?>";


        $('#child-category a').on('click', function(e) {
            taxonomyID = $(this).parent().data('category');
            e.preventDefault();
            $(this).parent().siblings().removeClass('active')
            $(this).parent().addClass('active')

            triggerAjax();
        })


        function triggerAjax() {
            $.ajax({
                type: 'POST',
                url: '/wp-admin/admin-ajax.php',
                dataType: 'json',
                data: {
                    action: 'get_product_item_callback',
                    taxonomyID,
                    taxonomy,
                    post_type,
                    postTemplate,
                },
                beforeSend: function() {
                    $('.loading-container').addClass('active')
                },
                success: function(response) {
                    ajaxComplete(response);
                },
            })
        }

        function ajaxComplete(response) {
            setTimeout(() => {
                $('.loading-container').removeClass('active')
            }, 300);
            $('#list-post .list').html('')
            // $('.wp-pagination').remove();
            // $('#list-post').append(response.pagination);
            if (response.html != null) {
                $('#list-post .list').append(response.html)
            } else {
                $('#list-post .list').append(`<div class="col-span-full"><div class="no-page no-post-found"><span class="block-title text-image text-primary-800 text-center"><?php _e('Không có bài viết nào', 'canhcamtheme'); ?></span></div></div>`)
            }


            useVariables.lozadInit()
        }
    });
</script> -->