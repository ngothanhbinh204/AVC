<?php
global $post;
$fields = get_field('group_1', $post);
?>

<section class="introduce-1 section xl:py-20" id="section-1">
    <div class="container">
        <div class="grid xl:grid-cols-2 gap-y-4 xl:items-center">
            <div class="col-left" data-aos='fade-left'>
                <div class="img">
                    <a href="javascript:;" rel="nofollow">
                        <?= custom_lozad_image($fields['image']) ?>
                    </a>
                </div>
            </div>
            <div class="col-right">
                <div class="wrapper xl:max-w-clamp-579px xl:ml-auto">
                    <div data-aos="fade-up">
                        <h1 class="title text-32px sm:text-40px lg:text-64px font-bold text-primary-800"><?= $fields['big_title'] ?></h1>
                    </div>
                    <div data-aos="fade-up" data-aos-delay=300>
                        <h2 class="text-image block-title font-black mt-3"><?= $fields['title'] ?></h2>
                    </div>
                    <div data-aos="fade-up" data-aos-delay=500>
                        <div class="description mt-6 space-y-3 text-18px font-normal text-neutral-900">
                            <?= $fields['description'] ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>