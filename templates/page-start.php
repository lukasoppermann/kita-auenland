<?php 
/*
	Template Name: Startseite
*/
?>

<?php get_header(); ?>
    

<?php

// Custom Function //

function formatSizeUnits($bytes) {
		if ($bytes >= 1073741824) { $bytes = number_format($bytes / 1073741824, 2) . ' GB'; }
		elseif ($bytes >= 1048576) { $bytes = number_format($bytes / 1048576, 2) . ' MB'; }
		elseif ($bytes >= 1024) { $bytes = number_format($bytes / 1024, 2) . ' KB'; }
		elseif ($bytes > 1) { $bytes = $bytes . ' bytes'; }
		elseif ($bytes == 1) { $bytes = $bytes . ' byte'; }
		else { $bytes = '0 bytes'; }
		return $bytes;
}

function isFullWidth()
{
    $fullWidth = get_sub_field('full-width');

    if ($fullWidth) {
        return 'full-width';
    } else {
        return '';
    }
}

function createColumn($columnName, $postion, $widthData)
{
    if (have_rows($columnName)) {

        echo('<div class="column ' . $columnName . ' ' . $postion . '">');

        while (have_rows($columnName)) {

            $row = the_row();
            //print_r(array_values($row));

            // check current row layout
            $type = get_row_layout();

            // generate different content sections
            if ($type == 'basic') {

                //data
                $style = get_sub_field('style');
                $styleplus = get_sub_field('additional_styles');
                $header = get_sub_field('header');
                $content = get_sub_field('content');
                $footer = get_sub_field('footer');
                $link = get_sub_field('clickable_section');
                $icon = get_sub_field('section_icon');
                $iconcolors = get_sub_field('section_icon_coloring');
                $hlevel = get_sub_field('headline_level');
                $classes = get_sub_field('additional_classes');

                if ($link) {
                    $goto = 'goto-true';
                } else {
                    $goto = 'goto-false';
                }

                //structure
                echo('<div class="column-section ' . $type . ' ' . $style . ' ' . $styleplus . ' ' . $goto . ' ' . $classes . '"><div class="inset">');

                if ($link) {
                    echo('<a href="' . $link . '" class="clickable-column-section-wrapper">');
                }
                if ($icon) {
					if ($iconcolors) {
						echo('<div class="column-section-icon"><div class="badge-icon colored-icon"><img src="' . $icon . '" class="svg" /></div></div>');
					}
					else {
						echo('<div class="column-section-icon"><div class="badge-icon"><img src="' . $icon . '" class="svg" /></div></div>');	
					}
                }
                if ($header) {
                    echo('<div class="column-section-header">');
                    if ($hlevel) {
                        echo('<' . $hlevel . '>');
                    } else {
                        echo('<h2>');
                    }
                    echo($header);
                    if ($hlevel) {
                        echo('</' . $hlevel . '>');
                    } else {
                        echo('</h2>');
                    }
                    echo('</div>');
                }
                if ($content) {
                    echo('<div class="column-section-body">' . $content . '</div>');
                }
                if ($footer) {
                    echo('<div class="column-section-footer">' . $footer . '</div>');
                }
                if ($link) {
                    echo('<div class="section-goto-icon"><i us-icon="large-goto-arrow"></i></div></a>');
                }

                echo('</div></div>');

            } else if ($type == 'image') {

                //data
                $style = "style-image";
                $image = get_sub_field('image');
                $classes = get_sub_field('additional_classes');
                $galleryimage = get_sub_field('gallery_image');

                //structure
                echo('<div class="column-section ' . $type . ' ' . $style . ' ' . $classes . '"><div class="inset">');

                if (!$widthData) {
                    echo('<div class="column-section-body">');
                    if ($galleryimage) {
                        echo('<a href="' . $image['url'] . '" data-rel="lightbox" class="expandable-image">');
                    }
                    echo('<img src="' . $image['url'] . '" class="sub-section-image" alt="' . $image['alt'] . '" title="' . $image['title'] . '" />');
                    if ($galleryimage) {
                        echo('<div class="expand-image-icon"><i us-icon="expand-image"></i></div></a>');
                    }
                    echo('</div>');
                } else {
                    echo('<div class="column-section-body" style="height: 100%; background-image: url(' . $image['url'] . ');">');
                    if ($galleryimage) {
                        echo('<a href="' . $image['url'] . '" data-rel="lightbox" class="expand-image-button"><i us-icon="expand-image"></i></a>');
                    }
                    echo('</div>');
                }

                echo('</div></div>');

            } else if ($type == 'download') {

                //data
                $style = "style-download";
                $file = get_sub_field('file');
				$file_id = $file[ID];
				$file_filename = $file[filename];
				$file_modified = $file[modified];
				$file_type = $file[mime_type];
				$file_icon = $file[icon];
				$file_url = $file[url];
				$home_url = home_url( '/' );
				$file_relative_url = str_replace($home_url, "", $file_url);
				$file_title = $file[title];
				$bytes = filesize($file_relative_url);
				$file_size = formatSizeUnits($bytes);
				
				$userbuttontext = get_sub_field('button_text');
                if ($userbuttontext) { $buttontext = $userbuttontext; } else { $buttontext = $file_filename; }
				
				$classes = get_sub_field('additional_classes');
								
                //structure
                echo('<div class="column-section ' . $type . ' ' . $style . ' ' . $classes . '"><div class="inset">');
					echo('<a href="' . $file_url . '" class="download-button file-id-' . $file_id . '" us-filetype="' . $file_type . '">' . $buttontext . ' <span class="filesize-info">' . $file_size . '</span></a>');
                echo('</div></div>');

            } else {
                $style = "style-basic";
            }


        }

        echo('</div>');

    }
}

function get_numerics($str)
{
    preg_match_all('/\d+/', $str, $matches);
    return $matches[0];
}

?>
<?php


the_post();

$pageID = get_the_ID();
$pageType = get_post_type();
$pageTemplate = get_post_meta($post->ID, '_wp_page_template', true);

echo('<div id="id-' . $pageID . '" class="page-id-' . $pageID . ' page-type-' . $pageType . ' page-template-start"><div id="contents">');


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

<?php get_footer() ?>