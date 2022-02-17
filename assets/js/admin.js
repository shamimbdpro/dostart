/**
 * File active.js
 * Preloader, back to top scroll, mobile menu navigiation, keyboard navigation.
 */
 (function ($) {

    "use strict";

    $('#hideDostarNotice').on('click', function(){
       
        $.ajax(
            {
                url: dostart_admin_notice_ajax_object.dostart_admin_notice_ajax_url,
                type: 'post',
                dataType: 'json',
                data: {
                    action: 'dostart_admin_notice_ajax_object_save', data: 1,
                    _ajax_nonce: dostart_admin_notice_ajax_object.nonce,
                },
                success: function (data) {
                    console.log(data.data.message);
                    if (data.success == true) {
                        $('.hideThemeNotice').hide('fast');
                    }
                },
                error: function (error) {
                    console.log(error);

                }
            }

        )


    });


})(jQuery);