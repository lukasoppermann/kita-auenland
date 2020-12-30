<?php


////////////////////////////////////////////////////////////////////////
/////////////////////////////// SECTIONS ///////////////////////////////
////////////////////////////////////////////////////////////////////////

// check if the flexible content field has rows of data
if (have_rows('section')) {
    // loop through the rows of data
    while (have_rows('section')) {
        $row = the_row();


        ////////////// MULTI-COLUMN-SECTION //////////////
        if (get_row_layout() == 'multi-column-section') {

            get_template_part('partials/partial', 'multi-column-section');

            //////////////  TEASER SECTION //////////////
        } elseif (get_row_layout() == 'teaser_section') {

            get_template_part('partials/partial', 'teaser_section');

            //////////////  IMAGE DIVIDER SECTION //////////////
        } elseif (get_row_layout() == 'image_divider') {

            get_template_part('partials/partial', 'image_divider');

            //////////////  GALLERY SECTION //////////////
        } elseif (get_row_layout() == 'gallery_section') {

            get_template_part('partials/partial', 'gallery_section');

            //////////////  NEWS SECTION (latest blog posts) //////////////
        } elseif (get_row_layout() == 'news_section') {

            get_template_part('partials/partial', 'news_section');

        } else {

            // If none of the above applies, check the partial-additional.php which might hold other possible values for get_row_layout()
            get_template_part('partials/partial', 'additional');

        }

    }
} else {

    // no layouts found

}
$content = get_the_content();
$title = get_the_title();
if ($content) {
    echo('<section id="" class="one-column the_content">
            <div class="inset">
                <div class="section-header">
                    <h1>' . $title . '</h1>
                </div>
                <div class="section-columns">
                    <div class="column column_one first">
                        <div class="column-section basic style-basic style-additional-basic goto-false ">
                            <div class="inset">
                                <div class="column-section-header">
                                </div>
                                <div class="column-section-body">');
    the_content();
    echo('
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </section>');
}


echo('</div></div>'); // closes content-div

?>