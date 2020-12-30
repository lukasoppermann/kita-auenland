<?php get_header(); ?>
    <style>
        /* temporary inline styles */
    </style>
<?php

// Custom Function //

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
				if ($link) { $goto = 'goto-true'; } else { $goto = 'goto-false'; }
				
				//structure
				echo('<div class="column-section ' . $type . ' ' . $style . ' ' . $styleplus . ' ' . $goto . '"><div class="inset">');
				
				if ($link) { echo('<a href="' . $link . '" class="clickable-column-section-wrapper">'); }
				if ($icon != "none") {
					echo('<div class="column-section-icon"><div class="badge-icon"><i us-icon="' . $icon . '"></i></div></div>');
				}
                if ($header) {
                    echo('<div class="column-section-header"><h2>' . $header . '</h2></div>');
                }
                if ($content) {
                    echo('<div class="column-section-body">' . $content . '</div>');
                }
                if ($footer) {
                    echo('<div class="column-section-footer">' . $footer . '</div>');
                }
				if ($link) { echo('<div class="section-goto-icon"><i us-icon="large-goto-arrow"></i></div></a>'); }
				
				echo('</div></div>');
				
			} else if ($type == 'image') {
				
				//data
				$style = "style-image";
				$image = get_sub_field('image');
				
				//structure
				echo('<div class="column-section ' . $type . ' ' . $style . '"><div class="inset">');
				
				if (! $widthData) {
					echo('<div class="column-section-body"><img src="' . $image['url'] . '" class="sub-section-image" alt="' . $image['alt'] . '" title="' . $image['title'] . '" /></div>');
				} else {
					echo('<div class="column-section-body" style="height: 100%; background-image: url(' . $image['url'] . ');"></div>');
				}			
				
				echo('</div></div>');
				
			} else {
				$style = "style-basic";
			}
			
			
        }

        echo('</div>');

    }
}

?>
<?php
if (have_posts()) {

    echo('<div id="contents">');

    while (have_posts()) {

        the_post();

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
			if ($pageBackground) { echo(' style="background-image: url(' . $pageBackground . ');"'); }
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

                // MULTI-COLUMN-SECTION
                if (get_row_layout() == 'multi-column-section') {

                    // vars
                    $numberOfColumns = get_sub_field('number_of_columns');

                    $order = get_sub_field('order_three-columns');
                    if ($numberOfColumns != '1' && $numberOfColumns != '3') : $order = get_sub_field('order_two-columns');endif;

                    $subSection1 = get_sub_field('column_one');
                    $subSection2 = get_sub_field('column_two');
                    $subSection3 = get_sub_field('column_three');

                    $subSections_array = array(); // create an array to iterate over

                    if ($subSection1) {
                        array_push($subSections_array, 'column_one');
                    }
                    if ($subSection2 && $numberOfColumns != 'one-column') {
                        array_push($subSections_array, 'column_two');
                    }
                    if ($subSection3 && $numberOfColumns == 'three-column') {
                        array_push($subSections_array, 'column_three');
                    }

                    // TODO: Apply $order to array before iterating over it

                    echo($numberOfColumns);


                    echo('<section class="' . $numberOfColumns . ' ' . isFullWidth() . '">'); //////////////////////////////////////////////
                    echo('<div class="inset">'); /////////////////////////////////////////////////////////////////////

                    $i = -1;
                    foreach ($subSections_array as $subSection_in_row) {
                        $i++;
                        if ($i == 0) {
                            $postion = 'first';
                        } else if ($i == (sizeof($subSections_array) - 1)) {
                            $postion = 'last';
                        } else {
                            $postion = 'between';
                        }
						
						$widthData = get_sub_field('full-width');
						
						//echo($widthData);
						
                        createColumn($subSection_in_row, $postion, $widthData);
                    }

                    echo('</div>'); /////////////////////////////////////////////////////////////////////////////////
                    echo('</section>'); /////////////////////////////////////////////////////////////////////////////

                } elseif (get_row_layout() == 'teaser_section') {
					
					$sectionLink = get_sub_field('section_link');
					$sectionLinkName = get_sub_field('section_link_name');
					$addSectionLink = get_sub_field('add_section_link');
					
					echo('<section class="teaser');
					if($addSectionLink): echo(' with-section-link'); endif;
					echo('"><div class="inset">');
					echo('<div class="teaser-list">');
					
					if( have_rows('teaser') ):
						
						while( have_rows('teaser') ): the_row();
							
							$title = get_sub_field('teaser_title');
							$text = get_sub_field('teaser_text');
							$image = get_sub_field('teaser_image');
							$target = get_sub_field('teaser_target');
							
							
							
							echo('<a class="teaser-item');
							if ($image): echo(' teaser-with-image'); endif;
							echo('" href="' . $target . '">');
								if ($image): echo('<div class="teaser-image" style="background-image: url(' . $image['url'] . ');"></div>'); endif;
								echo('<div class="teaser-header"><h3>' . $title . '</h3></div>');
								echo('<div class="teaser-body"><div class="teaser-text">' . $text . '</div><div class="section-goto-icon"><i us-icon="large-goto-arrow"></i></div></div>');
							echo('</a>');
							
					
							
					
						endwhile;
					
					endif;
					
					echo('</div>');
					
					if($addSectionLink):
					echo('<div class="teaser-section-link">');
						echo('<a class="teaser-section-link-button" href="' . $sectionLink . '">' . $sectionLinkName . '</a>');
					echo('</div>');	
					endif;
					
					echo('</div></section>');

                } elseif (get_row_layout() == 'image_divider') {

                    $image = get_sub_field('image');
					$fx = get_sub_field('parallax_effect');
					$height = get_sub_field('section_height');
					
					echo('<section class="image-divider" ');
					if ($fx) {
						echo('data-parallax="scroll" data-image-src="' . $image['url'] . '"');
					} else {
						echo('style="background-image: url(' . $image['url'] . ');"');
					}
					echo(' us-height="' . $height . '">');
					echo('</section>');
					
                }

            }
        } else {

            // no layouts found

        }
    }

    echo('</div>'); // closes content-div
}
?>

<?php get_footer()?>