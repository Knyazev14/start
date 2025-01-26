<?php defined('ABSPATH') || exit; ?>
<?php
$image = get_field('hero_image');
$image = Image::get_image_attrs($image);
//ID страницы опций Темы
$option_id = Get::option_id();
//Перевод
$option_id = Get::lang_attr('English', 'Английский');
?>
<div class="hero">
   <img src="<?= $image['url']; ?>" srcset="<?= $image['srcset']; ?>" alt="<?= $image['alt']; ?>" sizes="<?= $image['sizes']; ?>">

   <?= $option_id; ?>
</div>

    <?php
    //Форма
    get_template_part('modules/forms/form'); ?>

    <?php
    //Слайдер
    get_template_part('modules/sliders/slider'); ?>


<!-- Вариант с ленивой загрузкой -->
<div class="hero">
   <img class="lazyload--js" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==" data-src="<?= $image['url']; ?>" data-srcset="<?= $image['srcset']; ?>" alt="<?= $image['alt']; ?>" data-sizes="<?= $image['sizes']; ?>">

   <?= $option_id; ?>
</div>