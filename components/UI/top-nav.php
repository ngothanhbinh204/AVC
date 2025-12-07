<?php
$terms = $args['terms'];
$currentID = $args['currentID'];
$type = $args['type'];
$tabslet = $args['tabslet'] ?: false;
?>
<?php if ($terms) : ?>
    <nav class="top-nav <?= $type ?>">
        <ul <?php if ($tabslet) : ?>class="tabslet-tab" <?php endif; ?>>
            <?php $key = 0; ?>
            <?php foreach ($terms as $term) : ?>
                <?php $key++; ?>
                <li <?php if ($tabslet) : ?><?php if ($key === 1) : ?>class="active" <?php endif; ?><?php elseif ($currentID === $term->term_id) : ?>class="active" <?php endif; ?>>
                    <a href="<?php if ($tabslet) : ?>#tab-<?= $key ?><?php else : ?><?= get_term_link($term->term_id) ?><?php endif; ?>">
                        <?= $term->name ?>
                    </a>
                </li>

            <?php endforeach; ?>
        </ul>
    </nav>
<?php endif; ?>