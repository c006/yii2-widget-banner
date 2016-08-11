<?php

/** @var $id String */
/** @var $class String */
/** @var $array array */

$func_name = str_replace('-', '_', $id);
?>
<style>
    <?= $array['banner']['css'] ?>
</style>


<div id="<?= $id ?>" class="<?= $class ?>" item_type="<?= $array['banner']['type'] ?>" item_transition="<?= $array['banner']['transition'] ?>"
     item_duration="<?= $array['banner']['transition_time'] ?>">
    <?php foreach ($array['items'] as $index => $item) : ?>
        <div class="<?= $class ?>-item item-<?= $index ?>" style="opacity: <?= ($index > 0) ? '0' : '1' ?>;"
             item_id="<?= $index ?>"
             item_on="<?= ($index > 0) ? '0' : '1' ?>"
             item_pause="<?= $item['pause'] ?>"
             item_ratio="<?= $array['banner']['height'] / $array['banner']['width'] ?>"
        >
            <?php if ($item['url']) : ?>
            <a href="<?= $item['url'] ?>">
                <?php endif ?>
                <img src="/images/widget/banner/<?= $item['file']['file'] ?>" alt="<?= $item['alt_text'] ?>">
                <?php if ($item['url']) : ?>
            </a>
        <?php endif ?>
        </div>
    <?php endforeach ?>
    <?php if ($array['banner']['show_arrows']) : ?>
        <div class="icon arrow-left"></div>
        <div class="icon arrow-right"></div>
    <?php endif; ?>
    <div class="icon-pause"></div>
    <div class="icon-play"></div>
</div>


<script type="text/javascript">
    jQuery(function () {
        var wb_<?= $func_name ?> = new WidgetBanner();
        wb_<?= $func_name ?>.set_container_id('#<?= $id ?>');
        wb_<?= $func_name ?>.setup();
    });
</script>