<?php
global $post;
$fields = get_field('group_2', $post);
?>


<section class="introduce-2" id="section-2">
    <div class="container">
        <div class="background section xl:py-20 overflow-hidden rounded-tl-12 xl:rounded-tl-16 rounded-br-12 xl:rounded-br-16" setbackground="<?= getImageUrl($fields['background']) ?>">
            <div class="wrapper max-w-clamp-1230px mx-auto space-y-6 px-3 xl:p-0">
                <div data-aos="flip-right">
                    <div class="img max-w-clamp-152px mx-auto w-full">
                        <a href="javascript:;" rel="nofollow">
                            <?= custom_lozad_image($fields['logo']) ?>
                        </a>
                    </div>
                </div>
                <div data-aos="flip-up" data-aos-delay=300>
                    <h2 class="title block-title font-bold text-white text-center"><?= $fields['title'] ?></h2>
                </div>
                <div data-aos="flip-up" data-aos-delay=500>
                    <div class="description text-18px font-normal text-white text-center"><?= $fields['description'] ?></div>
                </div>
            </div>
        </div>
    </div>
</section>