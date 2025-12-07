<?php
$text = $args['text'] ?: __("Tìm hiểu thêm", "canhcamtheme");
$className = $args['className'];
$href = autoRenderHref($args['href']);
$target = $args['target'] ?: "_self";
?>
<div class="button">
    <a target="<?= $target ?>" <?php if ($href) : ?>href="<?= $href ?>" <?php else : ?>href="javascript:;" <?php endif; ?> class="btn <?= $className ?>">
        <?= $text ?>
    </a>
</div>