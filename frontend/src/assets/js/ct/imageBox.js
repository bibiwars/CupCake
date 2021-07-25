(function ($) {
    "use strict";

    $(document).ready(function () {

        $('.ct-imageBox').each(function(){
            var $this = $(this);
            var $bg_image = $this.attr("data-bg-image");
            $this.css('background-image', 'url("' + $bg_image + '")');
        })

    })
}(jQuery));