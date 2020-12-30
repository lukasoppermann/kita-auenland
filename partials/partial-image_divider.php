<?php
/**
 * Created by PhpStorm.
 * User: markusdittrich
 * Date: 30.05.17
 * Time: 12:54
 */

$image = get_sub_field('image');
$fx = get_sub_field('parallax_effect');
$height = get_sub_field('section_height');
$classes = get_sub_field('additional_classes');

if ($fx) {
    $fxClass = "parallax-window";
} else {
    $fxClass = "";
}

echo('<section class="image-divider ' . $classes . ' ' . $fxClass . '" ');
if ($fx) {
    echo('data-image-src="' . $image['url'] . '"');
} else {
    echo('style="background-image: url(' . $image['url'] . ');"');
}
echo(' us-height="' . $height . '">');
echo('</section>');