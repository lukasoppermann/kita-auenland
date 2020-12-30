<?php
/**
 * Created by PhpStorm.
 * User: markusdittrich
 * Date: 30.05.17
 * Time: 17:03
 */

/*
	Template Name: PopUp-Content
*/
?>


<div id="contents">

    <?php
    if (have_posts()) {
        while (have_posts()) {
            the_post();
            //
            // Post Content here
            the_title();
            the_content();
            //
        } // end while
    } // end if
    ?>


</div>