var Steps = function() {
    return {
        init: function() {
            $('.step__title_hasContent').click(function() {
                $(this).find('.angle').toggleClass('fa-angle-right fa-angle-down');
                $(this).parent().children('.step__content').toggle();
                $(this).parent().toggleClass('step_expanded');
            });
            $('.attachment-row').click(function() {
                $(this).find('.angle').toggleClass('fa-angle-right fa-angle-down');
                $(this).parent().children('.attachment-row__preview').toggle();
            });

            $('body').on('click', '#history-btn', function(e) {
                e.preventDefault();
                var el = $('#history');
                var url = $(this).attr("data-url");
                var error = $(this).attr("data-error-display");
                if (url) {
                    App.blockUI({
                        target: el,
                        animate: true,
                        overlayColor: 'none'
                    });
                    $.ajax({
                        type: "GET",
                        cache: false,
                        url: url,
                        dataType: "html",
                        success: function(res) {
                            App.unblockUI(el);
                            el.html(res);
                            App.initAjax() // reinitialize elements & plugins for newly loaded content
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            App.unblockUI(el);
                            var msg = 'Error on reloading the content. Please check your connection and try again.';
                            if (error == "toastr" && toastr) {
                                toastr.error(msg);
                            } else if (error == "notific8" && $.notific8) {
                                $.notific8('zindex', 11500);
                                $.notific8(msg, {
                                    theme: 'ruby',
                                    life: 3000
                                });
                            } else {
                                alert(msg);
                            }
                        }
                    });
                } else {
                    // for demo purpose
                    App.blockUI({
                        target: el,
                        animate: true,
                        overlayColor: 'none'
                    });
                    window.setTimeout(function() {
                        App.unblockUI(el);
                    }, 3000);
                }
            });
        }
    }
}();

jQuery(document).ready(function() {
    Steps.init();
});