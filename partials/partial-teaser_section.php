<?php
/**
 * Created by PhpStorm.
 * User: markusdittrich
 * Date: 30.05.17
 * Time: 12:55
 */


$sectionLink = get_sub_field('section_link');
$sectionLinkName = get_sub_field('section_link_name');
$addSectionLink = get_sub_field('add_section_link');
$classes = get_sub_field('additional_classes');

echo('<section class="teaser');
if ($addSectionLink): echo(' with-section-link'); endif;
echo(' ' . $classes . '"><div class="inset">');
echo('<div class="teaser-list">');

if (have_rows('teaser')):

    while (have_rows('teaser')): the_row();

        $pickcontents = get_sub_field('pick_contents_from_linked_page');
        $title = get_sub_field('teaser_title');
        $text = get_sub_field('teaser_text');
        $image = get_sub_field('teaser_image');
        $target = get_sub_field('teaser_target');


        if($pickcontents) {

            $title = get_the_title( $target );
            $url = get_permalink( $target );
            $excerpt = apply_filters('the_excerpt', get_post_field('post_excerpt', $target));
            $content = apply_filters('the_content', get_post_field('post_content', $target));
            if($excerpt) {
                $text = $excerpt;
            } else {
                $text = wp_trim_words($content, 30, '…');
            }


            $image = wp_get_attachment_url( get_post_thumbnail_id($target) );

            echo('<a class="teaser-item');
            if (has_post_thumbnail($target)): echo(' teaser-with-image'); endif;
            echo('" href="' . $url . '">');
            if (has_post_thumbnail($target)): echo('<div class="teaser-image" style="background-image: url(' . $image . ');"></div>'); endif;
            echo('<div class="teaser-header"><h4>' . $title . '</h4></div>');
            echo('<div class="teaser-body"><div class="teaser-text">' . $text . '</div><div class="section-goto-icon"><i us-icon="large-goto-arrow"></i></div></div>');
            echo('</a>');

        } else {

            $url = get_permalink( $target );

            echo('<a class="teaser-item');
            if ($image): echo(' teaser-with-image'); endif;
            echo('" href="' . $url . '">');
            if ($image): echo('<div class="teaser-image" style="background-image: url(' . $image['url'] . ');"></div>'); endif;
            echo('<div class="teaser-header"><h4>' . $title . '</h4></div>');
            echo('<div class="teaser-body"><div class="teaser-text">' . $text . '</div><div class="section-goto-icon"><i us-icon="large-goto-arrow"></i></div></div>');
            echo('</a>');

        }

    endwhile;

endif;

echo('</div>');

if ($addSectionLink):
    echo('<div class="teaser-section-link">');
    echo('<a class="teaser-section-link-button" href="' . $sectionLink . '">' . $sectionLinkName . '</a>');
    echo('</div>');
endif;

echo('</div></section>');