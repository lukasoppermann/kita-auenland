<?php
/**
 * Created by PhpStorm.
 * User: markusdittrich
 * Date: 24.04.17
 * Time: 16:39
 */



$newsheadline = get_sub_field('news_section_headline');
$classes = get_sub_field('additional_classes');

$postamount = get_sub_field('post_amount');
$postcategories = get_sub_field('post_categories');
$hideNewsSection = get_sub_field('hide_news_section');

if (!$hideNewsSection) {

    echo('<section class="news-section ' . $classes . '"><div class="inset">');

    if ($newsheadline): echo('<div class="news-section-header"><h2>' . $newsheadline . '</h2></div>'); endif;

    echo('<div class="news-section-body">');

    $args = array(
        'post_status' => 'publish',
        'post_type' => 'post',
        'posts_per_page' => $postamount
    );

    $the_query = new WP_Query($args);

    if ($the_query->have_posts()) {
        while ($the_query->have_posts()) {
            $the_query->the_post();
            echo('<div class="news-section-item">');
            echo('<div class="news-section-item-header">');
            echo('<div class="news-section-item-date">' . get_the_date() . '</div>');
            echo('<div class="news-section-item-title"><h3>' . get_the_title() . '</h3></div>');
            echo('</div>');
            echo('<div class="news-section-item-body">' . get_the_content() . '</div>');
            echo('</div>');
        }
        /* Restore original Post Data */
        wp_reset_postdata();
    } else {
        // no posts found
    }


    echo('</div>');

    //////////////// SECTION - FOOTER //////////////////////
    $sectionFooter = get_sub_field('section_footer');

    if ($sectionFooter) {
        echo('<div class="section-footer">');
        echo($sectionFooter);
        echo('</div>');
    }


    echo('</div></section>');
}