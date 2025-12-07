<?php $href = $args['href']; ?>
<?php if ($href) : ?>
    <div class="play-btn">
        <div class="icon image-svg image-absolute absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-2">
            <a href="<?= $href ?>" data-fancybox="" data-type="iframe">
                <img class="lozad" data-src="<?php bloginfo("template_directory"); ?>/img/icon/play.svg" /></a>
        </div>
    </div>
<?php endif; ?>