! function($) {
    $.fn.EF5ImageZoom = function() {
        return this.each(function() {
            var $this = $(this),
                src = $this.attr("data-zoom"),
                alt = $this.attr("alt"),
                zoom_image = '<img src="'+src+'" alt="'+alt+'" class="zoomImg" />';
            $this.wrap('<div class="red-zoom-wrapper"></div>').parent().zoom({
                //duration: 500,
                url: src,
                onZoomIn: function() {
                    $this.width() > $(this).width() && $this.trigger("zoom.destroy").attr("data-zoom", "").unwrap().EF5ImageZoom()
                },
            })
        }), this
    }, "function" != typeof window.vc_image_zoom && (window.ef5_image_zoom = function(model_id) {
        var selector = "[data-zoom]";
        void 0 !== model_id && (selector = '[data-model-id="' + model_id + '"] ' + selector), $(selector).EF5ImageZoom()
    }), $(document).ready(function() {
        !window.vc_iframe && ef5_image_zoom()
    })
}(jQuery);