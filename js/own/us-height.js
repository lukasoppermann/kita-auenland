/* ADJUST section HEIGHT */
function UsHeight(){
    this.init_height = function() {

        var windowHeight = $(window).height();

        $("[us-height]").each(function() {
            var $this = $(this);
            var heightData = $this.attr("us-height");
            var sectionHeight = (windowHeight / 100) * heightData;
            $this.height(sectionHeight);
        });

    }
}