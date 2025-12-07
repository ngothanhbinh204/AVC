<?php
global $post;
$fields = get_field('group_3', $post);
?>
<?php $repeater = $fields['repeater']; ?>
<?php if ($repeater) : ?>
    <section class="home-3 pb-0 xl:pt-20 lg:pt-35px" data-toggle="tabslet" data-auto-change="true">
        <div data-aos="fade-up">
            <div class="container">
                <div class="big-wrapper bg-primary-800 lg:px-50px p-4 lg:pb-10px lg:pt-16">
                    <div class="wrapper flex justify-between lg:flex-row flex-col gap-y-4">
                        <div class="col-left w-full" data-aos="fade-left" data-aos-delay="400">
                            <div class="tab-content">
                                <?php if ($repeater): ?>
                                    <?php foreach ($repeater as $key => $value) : ?>
                                        <?php
                                        $key = $key + 1;
                                        $category = $value['select_category'];
                                        $gallery = $value['gallery'];
                                        $acf_key = $category->taxonomy . '_' . $category->term_id;
                                        // $image = get_field('image', $acf_key);
                                        $gallery = $value['gallery'];
                                        $depthParentID = get_term_depth($category->taxonomy, 0, $category->term_id);
                                        
                                        // Fix: Check if get_term_link returns a valid URL
                                        $term_link = get_term_link($depthParentID);
                                        if (is_wp_error($term_link)) {
                                            $term_link = get_term_link($category->term_id, $category->taxonomy);
                                        }
                                        $custom_url = is_wp_error($term_link) ? '#' : $term_link . '#' . sanitize_title($category->name);
                                        ?>
                                        <div class="tabslet-content" id="tab-<?= $key ?>">
                                            <div class="flex lg:flex-col flex-row justify-between gap-2 items-center lg:items-start">
                                                <div class="title text-32px sm:text-60px lg:text-128px font-black text-white lg:leading-0.5"><?= $category->name ?></div>
                                                <?php if ($gallery[0]) : ?>
                                                    <div class="img lg:mt-10 xl:mt-60px w-full">
                                                        <a href="<?= $custom_url ?>" rel="nofollow">
                                                            <?= custom_lozad_image($gallery[0]) ?>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-right w-full" data-aos="fade-right" data-aos-delay="400">
                            <div class="tab-content h-full">
                                <?php if ($repeater): ?>
                                    <?php foreach ($repeater as $key => $value) : ?>
                                        <?php
                                        $key = $key + 1;
                                        $category = $value['select_category'];
                                        $gallery = $value['gallery'];
                                        // $acf_key = $category->taxonomy . '_' . $category->term_id;
                                        // $image = get_field('image', $acf_key);
                                        $gallery = $value['gallery'];
                                        $depthParentID = get_term_depth($category->taxonomy, 0, $category->term_id);
                                        
                                        // Fix: Check if get_term_link returns a valid URL
                                        $term_link = get_term_link($depthParentID);
                                        if (is_wp_error($term_link)) {
                                            $term_link = get_term_link($category->term_id, $category->taxonomy);
                                        }
                                        $custom_url = is_wp_error($term_link) ? '#' : $term_link . '#' . sanitize_title($category->name);
                                        ?>
                                        <div class="tabslet-content-other h-full" id="tab-<?= $key ?>">
                                            <div class="flex flex-col h-full justify-between">
                                                <div class="top">
                                                    <div class="description text-18px font-normal text-white space-y-6"><?= $category->description ?></div>
                                                    <?= get_template_part('/components/UI/button', null, array(
                                                        'text' => __('Tìm hiểu thêm', 'canhcamtheme'),
                                                        'className' => 'btn-secondary mt-3 lg:mt-6',
                                                        'href' => $custom_url
                                                    )) ?>
                                                </div>
                                                <?php if ($gallery && count($gallery) > 1) : ?>
                                                    <div class="bottom grid grid-cols-2 gap-10px lg:mt-0 mt-10px">
                                                        <?php foreach ($gallery as $image_key => $image) : ?>
                                                            <?php $image_key++; ?>
                                                            <?php if ($image_key > 1) : ?>
                                                                <div class="img">
                                                                    <a href="<?= getImageUrl($image) ?>" rel="nofollow" data-fancybox="<?= "popup_gallery_" . $category->term_id ?>">
                                                                        <?= custom_lozad_image($image) ?>
                                                                    </a>
                                                                </div>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="nav-list mt-4 lg:mt-6">
                        <ul class="tabslet-tab flex items-center justify-between gap-3">
                            <?php if ($repeater): ?>
                                <?php foreach ($repeater as $key => $value) : ?>
                                    <?php
                                    $key = $key + 1;
                                    $category = $value['select_category'];
                                    ?>
                                    <li>
                                        <h2><a href="#tab-<?= $key ?>"><?= $category->name ?></a></h2>
                                    </li>
                                <?php endforeach; ?>
                            <?php endif;
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>