<?php get_header() ?>
<?php $key = isset($_GET['s']) && $_GET['s'] ? $_GET['s'] : ''; ?>


<section class="search-page section">
    <div class="container max-w-screen-2xl">
        <div class="wrapper">
            <h1 class="block-title select-none text-center text-image"><?php _e("Tìm kiếm", "canhcamtheme"); ?></h1>
            <div class="search-form mt-8">
                <form class="searchbox w-full" action="<?php bloginfo('url') ?>/" method="GET" role="form">
                    <input class="w-full" name="s" type="text" placeholder="<?php _e('Tìm kiếm', 'canhcamtheme'); ?>">
                    <button type="submit" class="flex items-center justify-center">
                        <em class="fa-regular fa-magnifying-glass"></em>
                    </button>
                </form>
            </div>
            <div class="search-query"><?php _e("Kết quả tìm kiếm tin tức với từ khóa", "canhcamtheme"); ?>: "<span><?php echo get_search_query() ?></span>"</div>
            <div class="list grid-cols-2 lg:grid-cols-4 grid gap-x-3 gap-y-4 sm:gap-4 xl:gap-10 xl:mt-10 mt-6">
                <!-- Search only title -->
                <?php $paged = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1; ?>
                <?php
                $args = array(
                    'posts_per_page' => 8,
                    'post_type'      => array(
                        'product',
                        'post',
                    ),
                    's'              => $key,
                    'order'          => 'ASC',
                    'orderby'        => 'date',
                    'paged'          => $paged,
                    'sentence'       => true,
                    'fields'         => 'ids', // Retrieve only post IDs to improve performance
                );

                add_filter('posts_search', 'search_title_filter', 10, 2);
                $the_query = new WP_Query($args);
                remove_filter('posts_search', 'search_title_filter', 10, 2);

                function search_title_filter($search, $wp_query)
                {
                    if (!empty($search) && $wp_query->is_search) {
                        global $wpdb;
                        $search = " AND {$wpdb->posts}.post_title LIKE '%" . esc_sql($wp_query->get('s')) . "%'";
                    }
                    return $search;
                };
                ?>
                <?php if ($the_query->have_posts()) : ?>
                    <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                        <div class="item">
                            <?php get_template_part("./components/boxNews/boxNews-1", null, array(
                                'id' => get_the_ID(),
                            )); ?>
                        </div>
                    <?php endwhile; ?>
                <?php else : ?>
                    <div class="found-nothing text-center col-span-full"></div>
                    <div class="found-nothing-title col-span-full text-center">
                        <?php _e("Không có kết quả nào", "canhcamtheme"); ?>
                    </div>
                <?php endif; ?>
            </div>
            <?php echo wp_bootstrap_pagination(array("custom_query" => $the_query)); ?>
        </div>

    </div>
</section>
<?php get_footer() ?>