/**
 * Custom Date Picker in theme
 */
(function ($) {
    "use strict";
    $(window).on('load',function () {
        $(".red-datepicker").each(function () {
            var $this = $(this),
                datepicker_id = $this.attr('id'),
                datepicker_settings = sunix_datetimepicker[datepicker_id];
                datepicker_settings['icons'] = {
                    time    : "fa fa-clock-o",
                    date    : "fa fa-calendar",
                    up      : "fa fa-angle-up",
                    down    : "fa fa-angle-down",
                    previous: 'fa fa-chevron-left',
                    next    : 'fa fa-chevron-right',
                    today   : 'fa fa-calendar-day',
                    clear   : 'fa fa-trash-alt',
                    close   : 'fa fa-times'
                };
            $this.datetimepicker(datepicker_settings);
        });
    });
})(jQuery)