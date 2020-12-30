<?php
$slideshow = get_sub_field('slideshow');
$classes = get_sub_field('additional_classes');
$height = get_sub_field('slideshow_height');
$autoplay = get_sub_field('autoplay');
$direction = get_sub_field ('direction');
$animation = get_sub_field('animation_type');
$loop = get_sub_field('loop');

echo('<section class="gallery-section ' . $classes);
if ($slideshow) {
    echo(' slideshow-gallery-section');
}
echo('"><div class="inset">');


if ($slideshow) {
	
	
	echo('<div class="slideshow-wrapper swiper-container" us-height="' . $height . '" data-direction="' . $direction . '" data-animation="' . $animation . '" ');
    if ($autoplay == 1) {
        echo('data-autoplay="true"');
    }
    if ($loop == 1) {
        echo('data-loop="true"');
    }
    echo('">');
		
		// slides wrapper
		echo('<div class="swiper-wrapper">');

			if (have_rows('gallery_image')):

				while (have_rows('gallery_image')): the_row();

					$image = get_sub_field('image');
					$title = get_sub_field('image_title');
					$caption = get_sub_field('image_caption');
					$link = get_sub_field('image_link');
					
					// slides
					
					echo('<div class="swiper-slide gallery-item slide-gallery-item" style="background-image: url(' . $image['url'] . ')" us-height="' . $height . '"><div class="inset"><div class="slide-gallery-contents">');
						if ($link) {
							echo('<a href="' . $link . '" class="slide-gallery-image-link">');
						} else {
							echo('<div class="slide-gallery-image-box">');
						}
						if ($title) {
							echo('<h2 class="slide-gallery-image-title">' . $title . '</h2>');
						}
						if ($caption) {
							echo('<div class="slide-gallery-image-caption">' . $caption . '</div>');
						}
						if ($link) {
							echo('</a>');
						} else {
							echo('</div>');
						}
					echo('</div></div></div>');

				endwhile;		

			endif;

		echo('</div>');
		
		//	pagination
		echo('<div class="swiper-pagination"></div>');
		
		// navigation buttons
		echo('<div class="swiper-button-prev"></div>
		<div class="swiper-button-next"></div>');
	
		// scrollbar
		//echo('<div class="swiper-scrollbar"></div>');
	
    echo('</div>');
	
	
	/*
    echo('<div class="slideshow-wrapper" us-height="' . $height . '" animation-type="' . $animation . '" slide-autoplay="');
    if ($autoplay == 1) {
        echo('true');
    } else {
        echo('false');
    }
    echo('">');
    echo('<ul>');

    if (have_rows('gallery_image')):

        while (have_rows('gallery_image')): the_row();

            $image = get_sub_field('image');
            $title = get_sub_field('image_title');
            $caption = get_sub_field('image_caption');
            $link = get_sub_field('image_link');

            echo('<li class="gallery-item slide-gallery-item" style="background-image: url(' . $image['url'] . ')" us-height="' . $height . '"><div class="inset"><div class="slide-gallery-contents">');
            if ($link) {
                echo('<a href="' . $link . '" class="slide-gallery-image-link">');
            } else {
                echo('<div class="slide-gallery-image-box">');
            }
            if ($title) {
                echo('<h2 class="slide-gallery-image-title">' . $title . '</h2>');
            }
            if ($caption) {
                echo('<div class="slide-gallery-image-caption">' . $caption . '</div>');
            }
            if ($link) {
                echo('</a>');
            } else {
                echo('</div>');
            }
            echo('</div></div></li>');

        endwhile;

    endif;

    echo('</ul>');
    echo('</div>');
	*/
	
	
	
} else {
    echo('<div class="thumbnail-gallery-wrapper">');
    echo('<ul>');

    if (have_rows('gallery_image')):

        while (have_rows('gallery_image')): the_row();

            $image = get_sub_field('image');
            $caption = get_sub_field('image_caption');

            // thumbnail
            $thumb = $image['sizes']['thumbnail'];

            echo('<li class="gallery-item thumbnail-gallery-item"><a href="' . $image['url'] . '" data-rel="lightbox"><img class="' . $image['alt'] . '" title="' . $image['title'] . '" src="' . $thumb . '" /><div class="expand-image-icon"><i us-icon="expand-image"></i></div></a></li>');

        endwhile;

    endif;

    echo('</ul>');
    echo('</div>');
}

echo('</div></section>');