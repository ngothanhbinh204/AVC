<?php get_header(); ?>
<?php
get_template_part('./modules/breadcrumb/breadcrumb');
?>

<?php
global $post;
$author_id = $post->post_author;
$term = wp_get_post_terms($post->ID, $taxonomy);
$cats = array_map(function ($o) {
    return $o->term_id;
}, $term);
$the_query = new WP_query(get_other_post_type($post, $cats, 5));
?>


<section class="news-detail section">
    <div class="container">
        <div class="grid grid-cols-12 xl:gap-10 gap-6">
            <div class="col-left col-span-full lg:col-span-8 xl:pr-8 relative">
                <div class="article">
                    <div class="article-header">
                        <h1 class="title header-32 font-bold"><?= the_title() ?></h1>
                        <div class="xl:absolute top-0 xl:-left-20 xl:h-full xl:mt-0 mt-6">
                            <div class="share flex xl:flex-col flex-row gap-3 sticky top-120px"><a class="w-50px h-50px flex justify-center items-center bg-[#ECFDF7] rounded-full transition-all hover:bg-primary-500 hover:scale-110 hover:shadow-md" id="facebook-share"><i class="fa-brands text-20px text-primary-800 fa-facebook-f"></i></a><a class="w-50px h-50px flex justify-center items-center bg-[#ECFDF7] rounded-full transition-all hover:bg-primary-500 hover:scale-110 hover:shadow-md" id="twitter-share"><i class="fa-brands text-20px text-primary-800 fa-twitter"></i></a></div>
                        </div>
                        <time class="relative text-18px text-neutral-500 font-normal flex items-center gap-6 mt-6"><?= dateFormatOnLayout($post->ID) ?></time>
                    </div>
                    <div class="article-content">
                        <div class="prose prose-spacing-6">
                            <article class="text-18px text-neutral-900"><?= the_content() ?></article>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-right col-span-full lg:col-span-4">
                <div class="wrapper sticky top-27">
                    <h3 class="other-title header-32 font-bold text-primary-800 relative pb-4">
                        <?php _e('Tin tức liên quan', 'canhcamtheme'); ?>
                    </h3>
                    <div class="list mt-2">
                        <?php if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>
                                <div class="item py-4 flex items-center gap-4">
                                    <div class="img w-full">
                                        <a href='<?= get_the_permalink($id); ?>' title="<?= get_the_title($id); ?>">
                                            <?= custom_get_post_thumbnail($id); ?>
                                        </a>
                                    </div>
                                    <div class="content flex-1 w-full">
                                        <time class="label-12 text-neutral-500">
                                            <?= dateFormatOnLayout($id) ?>
                                            <?= edit_link_post($id) ?>
                                        </time><a class="title text-18px font-bold mt-1 block" href='<?= get_the_permalink($id); ?>' title="<?= get_the_title($id); ?>"><span class="line-clamp-2">
                                                <?= get_the_title($id) ?>
                                            </span></a>
                                    </div>
                                </div>
                        <?php endwhile;
                        endif;
                        wp_reset_postdata(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php get_footer(); ?>


<script>
    var puWidth = 600;
    var puHeight = 400;

    var shareOptions = {
        width: puWidth,
        height: puHeight,
        left: (screen.width / 2) - (puWidth / 2),
        top: (screen.height / 2) - (puHeight / 2)
    };
    const Features = 'width=' + shareOptions.width + ',height=' + shareOptions.height + ',left=' + shareOptions.left + ',top=' + shareOptions.top;
    $('#facebook-share').on("click", function(e) {
        e.preventDefault();
        const fbShareUrl = 'https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>&title=' + encodeURIComponent('<?php echo get_the_title(); ?>') + '&description=' + encodeURIComponent('<?php echo get_the_excerpt(); ?>');
        window.open(fbShareUrl, '_blank', Features);
    });
    $('#twitter-share').on("click", function(e) {
        e.preventDefault();
        const twShareUrl = "http://twitter.com/share?text=" + encodeURIComponent('<?= the_title() ?>') + "&url=" + encodeURIComponent('<?= the_permalink() ?>');
        window.open(twShareUrl, '_blank', Features);
    });
    $('#linkedin-share').on("click", function(e) {
        e.preventDefault();
        const linkedinShareUrl = "https://www.linkedin.com/sharing/share-offsite/?url=" + encodeURIComponent('<?= the_permalink() ?>');
        window.open(linkedinShareUrl, '_blank', Features);
    });
</script>