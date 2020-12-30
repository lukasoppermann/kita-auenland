function UsIcons(){
	/* SVG IMAGES */
	this.init_svgimages = function(callback) {

		console.log('init_svgimages called');

		/* Replace all SVG images with inline SVG */
		jQuery('img.svg, .column-section.svg img').each(function(){
			var $img = jQuery(this);
			var imgID = $img.attr('id');
			var imgClass = $img.attr('class');
			var imgURL = $img.attr('src');

			jQuery.get(imgURL, function(data) {
				// Get the SVG tag, ignore the rest
				var $svg = jQuery(data).find('svg');

				//console.log('$svg', $svg);

				// Add replaced image's ID to the new SVG
				$svg.removeAttr('id'); // 1. remove IDs from SVG
				if(typeof iconID !== 'undefined') { // 2. then add new ID if there is one
					$svg = $svg.attr('id', imgID);
				}
				// Add replaced image's classes to the new SVG
				if(typeof imgClass !== 'undefined') {
					$svg = $svg.attr('class', imgClass+' replaced-svg');
				}

				// Remove any invalid XML tags as per http://validator.w3.org
				$svg = $svg.removeAttr('xmlns:a');

				// Check if the viewport is set, if the viewport is not set the SVG wont't scale.
				if(!$svg.attr('viewBox') && $svg.attr('height') && $svg.attr('width')) {
					$svg.attr('viewBox', '0 0 ' + $svg.attr('height') + ' ' + $svg.attr('width'))
				}

				// Replace image with new SVG
				$img.replaceWith($svg);

				// execute callback
				callback();
			});
		});
	};

	/* CREATE / GET ICONS */
	this.init_createsvgicons = function(callback) {

		console.log('init_createsvgicons called');

		/* Replace all SVG images with inline SVG */
		jQuery('i').each(function(){

			var stylesheetUrl = object_name.stylesheetUrl;
			var $icon = jQuery(this);
			//console.log('$icon', $icon);
			var iconID = $icon.attr('id');
			var iconClass = $icon.attr('class');
			var iconAttr = $icon.attr('us-icon');
			
			if (typeof iconAttr !== 'undefined') {
			
				//console.log('attr', $icon.attr('us-icon'));
				//console.log('$icon', $icon.get(0));

				var iconURL = stylesheetUrl + "/img/icons/icon-" + iconAttr + ".svg";
				var classData = $(this).attr("class");

				if (classData == "large") {
					var iconURL = stylesheetUrl + "/img/icons/icon-" + $icon.attr('us-icon') + "-large.svg";
				}

				jQuery.get(iconURL, function(data) {
					// Get the SVG tag, ignore the rest
					var $svg = jQuery(data).find('svg');
					var svgClass = $svg.attr('class');

					// Add replaced image's ID to the new SVG
					if(typeof iconID !== 'undefined') {
						$svg = $svg.attr('id', iconID);
					}
					// Add replaced image's classes to the new SVG
					if(typeof iconClass !== 'undefined') {
						$svg = $svg.attr('class', iconClass + ' ' + svgClass + ' replaced-svg');
					}

					// Remove any invalid XML tags as per http://validator.w3.org
					$svg = $svg.removeAttr('xmlns:a');

					// Check if the viewport is set, if the viewport is not set the SVG wont't scale.
					if(!$svg.attr('viewBox') && $svg.attr('height') && $svg.attr('width')) {
						$svg.attr('viewBox', '0 0 ' + $svg.attr('height') + ' ' + $svg.attr('width'))
					}

					// Replace image with new SVG
					$icon.replaceWith($svg);

					// execute callback
					callback();

				}, 'xml');

			}	
				
		});

	};
}
