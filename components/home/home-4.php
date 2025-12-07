<?php
global $post;

$idPageIntroduce = get_id_translate('templates/Introduce.php');
?>
<?php if ($idPageIntroduce) : ?>
    <?php
    $fields = $args['fields'] ?? get_field('group_5', $idPageIntroduce);
    ?>
    <section class="home-4 section xl:pt-20 pb-0">
        <div class="container">
            <div data-aos="zoom-in-up">
                <h2 class="block-title text-center"><?= $fields['title'] ?></h2>
            </div>
            <?php $repeater = $fields['repeater']; ?>
            <?php if ($repeater) : ?>
                <div class="row mt-10 2xl:mt-16 justify-center">
                    <?php $key = 0;
                    $animation = ['fade-left', 'fade-up', 'fade-right'];
                    $animationDelay = ['400', '0', '400'];
                    ?>
                    <?php foreach ($repeater as $value) : ?>
                        <?php $animationId = $key % 3; ?>
                        <?php $key++; ?>

                        <div class="col-lg-4 col-sm-6" data-aos="<?= $animation[$animationId] ?>" data-aos-delay="<?= $animationDelay[$animationId] ?>">
                            <div class="item">
                                <div class="img max-w-clamp-120px mx-auto w-full"><a><?= custom_lozad_image($value['logo']) ?></a>
                                </div>
                                <h3 class="title subheader-24 font-bold text-primary-5 mt-3 text-center"><?= $value['title'] ?></h3>
                                <div class="description mt-1 text-18px text-primary-5 text-center"><?= $value['description'] ?></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <?php if ($fields['url']) : ?>
                <div data-aos="flip-up" data-aos-delay="400">
                    <?= get_template_part('/components/UI/button', null, array(
                        'text' => __('Tìm hiểu thêm', 'canhcamtheme'),
                        'className' => 'btn-primary mx-auto mt-8 xl:mt-10',
                        'href' => $fields['url']
                    )) ?>
                </div>
            <?php endif; ?>

        </div>
    </section>
<?php endif; ?>