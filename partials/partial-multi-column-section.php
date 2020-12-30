<?php
/**
 * Created by PhpStorm.
 * User: markusdittrich
 * Date: 30.05.17
 * Time: 12:57
 */


$sectionId = get_sub_field('section_id');
$classes = get_sub_field('additional_classes');

$sectionStyle = '';
if (get_sub_field('section-style')) {
    $sectionStyle = get_sub_field('section-style');
}

// vars
$numberOfColumns = get_sub_field('number_of_columns');

$order = get_sub_field('order_three-columns');
if ($numberOfColumns != 'one-column' && $numberOfColumns != 'three-column') {
    $order = get_sub_field('order_two-columns');
}
if (empty($order)) {
    $order = '1';
}

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

// Apply $order to array before iterating over it
$tempArray = array();
$order = get_numerics($order); // returns array that converted '2 - 1' into [2,1]
$j = -1;
foreach ($order as $position) {
    // now we'll go ahead and reorder the subsection array by creating a new array who's values
    // are derived from $subSections_array:
    // $order [2,3,1] accesses $subSections_array [2], $subSections_array[3], etc.
    // and stores these values in a new array
    $j++;
    $tempArray[$j] = $subSections_array[$position - 1];
}
$subSections_array = $tempArray;

echo('<section id="' . $sectionId . '" class="' . $numberOfColumns . ' ' . isFullWidth() . ' ' . $sectionStyle . ' ' . $classes . '">'); //////////////////////////////////////////////
echo('<div class="inset">'); /////////////////////////////////////////////////////////////////////

//////////////// SECTION - HEADER //////////////////////
$sectionHeader = get_sub_field('section-header');
$sectionIcon = get_sub_field('section_header_icon');
$sectionIconColoring = get_sub_field('section_header_icon_coloring');
$shlevel = get_sub_field('section-headline-level');

if ($sectionHeader or $sectionIcon) {
    echo('<div class="section-header">');
    if ($sectionIcon) {
        if ($sectionIconColoring) {
            echo('<div class="section-header-icon"><div class="badge-icon colored-icon"><img src="' . $sectionIcon . '" class="svg" /></div></div>');
        } else {
            echo('<div class="section-header-icon"><div class="badge-icon"><img src="' . $sectionIcon . '" class="svg" /></div></div>');
        }
    }

    if ($sectionHeader) {
        echo('<' . $shlevel . '>' . $sectionHeader . '</' . $shlevel . '>');
    }
    echo('</div>');
}


//////////////// SECTION - COLUMN //////////////////////

echo('<div class="section-columns">');

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

echo('</div>');

//////////////// SECTION - FOOTER //////////////////////
$sectionFooter = get_sub_field('section_footer');

if ($sectionFooter) {
    echo('<div class="section-footer">');
    echo($sectionFooter);
    echo('</div>');
}

echo('</div>'); /////////////////////////////////////////////////////////////////////////////////
echo('</section>'); /////////////////////////////////////////////////////////////////////////////