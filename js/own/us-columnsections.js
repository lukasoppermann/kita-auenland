function Us_columnsections() {

    // initially set
    this.elementArray = [];

    this.reset = function () {
        var elementArray = this.elementArray;
        if (typeof elementArray != 'undefined'){
            for (var i = 0; i < elementArray.length; i++) {
                var $this = elementArray[i];
                $this.css('min-height', '');
            }
        }

    };

    this.layout = function () {
        var $sections = $('section.two-column.full-width, section.three-column.full-width'),
            windowWidth = window.innerWidth,
            breakpoint = 900,//TODO: Is there an easy way to parse this value from the stylesheet?
            elementArray = this.elementArray;

        // reset elements that have been stretched by former executions of this function
        this.reset();

        // empty the array afterwards
        elementArray = [];

        if (windowWidth >= breakpoint) {
            $sections.each(function () {
                var $this = $(this),
                    sectionHeight = $this.outerHeight(),
                    $columns = $('.column', $this);

                $columns.each(function () {
                    var $column = $(this),
                        allSubsectionsHeight = 0,
                        $subsections = $('.column-section', $column);

                    $subsections.each(function () {
                        var $this = $(this);
                        allSubsectionsHeight += $this.outerHeight();

                    });

                    var differenceToBridge = sectionHeight - allSubsectionsHeight;

                    if (sectionHeight > allSubsectionsHeight) {
                        var $stretchableSubsections = $('.column-section.image', $column);

                        // if there are subsections containing an image stretch out those
                        if ($stretchableSubsections.length != 0) {

                            var count = $stretchableSubsections.length,
                                heightToAdd = differenceToBridge / count;

                            $stretchableSubsections.each(function () {
                                var $this = $(this),
                                    newHeight = $this.outerHeight() + heightToAdd,
                                    $columnSectionBody = $('.column-section-body', $this);

                                $this.css('min-height', newHeight + 'px');
                                $columnSectionBody.css('min-height', newHeight + 'px');

                                // store these elements, so we can reset them when we want to to recalculate the layout
                                elementArray.push($this);
                                elementArray.push($columnSectionBody);
                            });
                        } else { // if there are no image-subsection just stretch the last one
                            var $stretchableSubsection = $('.column-section', $column).last(),
                                newHeight = $stretchableSubsection.outerHeight() + differenceToBridge;
                            //$columnSectionBody = $('.column-section-body', $stretchableSubsection);

                            // substract the .inset padding (necessary for all columns that  aren't '.column-section.image')
                            var paddingBottom = parseInt($('.inset', $stretchableSubsection).css('padding-bottom'));
                            var paddingTop = parseInt($('.inset', $stretchableSubsection).css('padding-top'));


                            //newHeight = newHeight - paddingBottom - paddingTop;

                            $stretchableSubsection.css('min-height', newHeight + 'px');
                            //$columnSectionBody.css('min-height', newHeight + 'px');

                            // store these elements, so we can reset them when we want to to recalculate the layout
                            elementArray.push($stretchableSubsection);
                            //elementArray.push($columnSectionBody);
                        }
                    }
                })
            });

            // make sure to store the whole array in the object
            this.elementArray = elementArray;

        } else {

        }
    }
}