<?php

the_post();

$pageID = get_the_ID();
$pageType = get_post_type();
$pageTemplate = get_post_meta($post->ID, '_wp_page_template', true);

echo('<div id="id-' . $pageID . '" class="page-id-' . $pageID . ' page-type-' . $pageType . ' page-template-' . $pageTemplate . '"><div id="contents">');


////////////////////////////////////////////////////////////////////////
/////////////////////////////// HEADLINE ///////////////////////////////
////////////////////////////////////////////////////////////////////////
$primaryHeadline = get_field('primary_page_headline');
$secondaryHeadline = get_field('secondary_page_headline');
$layoutStyle = get_field('page_header_layout');
$pageIntroduction = get_field('page_introduction');
$pageBackground = get_field('page_header_background_image');
$hideHeader = get_field('hide_page_header');
if ($hideHeader == 0) {
    echo('<section class="one-column ' . $layoutStyle . '" id="stage"');
    if ($pageBackground) {
        echo(' style="background-image: url(' . $pageBackground . ');"');
    }
    echo('><div class="inset"><div class="column"><div class="column-section"><div class="inset">');
    echo('<div class="stage-contents-wrapper">');
    echo('<h1>' . $primaryHeadline . '</h1>');
    echo('<h2>' . $secondaryHeadline . '</h2>');
    echo('<div class="page-introduction">' . $pageIntroduction . '</div>');
    echo('</div>');
    echo('</div></div></div></div></section>');
}

?>